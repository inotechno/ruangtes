<?php

namespace App\Services;

use App\Events\PasswordReset;
use App\Events\Registered;
use App\Events\WelcomeEmail;
use App\Models\CompanyAdmin;
use App\Models\PublicUser;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\PublicUserRepository;
use App\Repositories\CompanyAdminRepository;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserStatus;
use App\Enums\AdminRole;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthenticationService
{
    protected $userRepository;
    protected $companyRepository;
    protected $companyAdminRepository;
    protected $publicUserRepository;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->companyRepository = app(CompanyRepository::class);
        $this->companyAdminRepository = app(CompanyAdminRepository::class);
        $this->publicUserRepository = app(PublicUserRepository::class);
    }

    public function authenticate(array $credentials, string $guard = 'web')
    {
        $user = $this->userRepository->findByEmail($credentials['email']);
        if (!$user) {
            return [
                'success' => false,
                'message' => __('app.messages.no_data_found'),
                'user' => null,
                'redirect_to' => null,
            ];
        }

        if ($user->status != UserStatus::ACTIVE->value) {
            return [
                'success' => false,
                'message' => __('app.status.' . $user->status),
                'user' => null,
                'redirect_to' => null,
            ];
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return [
                'success' => false,
                'message' => __('auth.password'),
                'user' => null,
                'redirect_to' => null,
            ];
        }

        // Update Last Login
        $this->userRepository->updateLastLogin($user, request()->ip());

        // Determine redirect based on user type
        $redirectTo = $this->getRedirectRoute($user);

        return [
            'success' => true,
            'message' => __('auth.authenticated'),
            'user' => $user,
            'redirect_to' => $redirectTo
        ];
    }

    /**
     * Register new company with admin user
     */
    public function registerCompany(array $companyData, array $adminData): array
    {
        try {
            \DB::beginTransaction();
            
            // 1. Create company
            $company = $this->companyRepository->create([
                'code' => $this->generateCompanyCode($companyData['name']),
                'name' => $companyData['name'],
                'email' => $companyData['email'],
                'phone' => $companyData['phone'] ?? null,
                'address' => $companyData['address'] ?? null,
                'city' => $companyData['city'] ?? null,
                'province' => $companyData['province'] ?? null,
                'country' => $companyData['country'] ?? 'Indonesia',
                'postal_code' => $companyData['postal_code'] ?? null,
                'subscription_type' => 'trial',
                'subscription_end' => now()->addDays(config('app.company_trial_days', 14)),
                'max_participants' => config('app.trial_max_participants', 5),
                'status' => 'pending', // Menunggu verifikasi
                'is_verified' => false,
                'timezone' => $companyData['timezone'] ?? 'Asia/Jakarta',
                'language' => $companyData['language'] ?? 'id',
            ]);

            // 2. Create company admin
            $companyAdmin = $this->companyAdminRepository->create([
                'company_id' => $company->id,
                'name' => $adminData['name'],
                'position' => $adminData['position'] ?? 'Administrator',
                'department' => $adminData['department'] ?? null,
                'employee_id' => $adminData['employee_id'] ?? null,
                'phone' => $adminData['phone'] ?? null,
                'avatar' => $adminData['avatar'] ?? null,
                'role' => AdminRole::ADMIN->value,
                'permissions' => [],
                'is_primary' => true,
                'is_active' => true,
                'last_login_at' => now(),
                'last_login_ip' => request()->ip(),
                'login_count' => 0,
            ]);

            // 3. Create user for admin
            $user = $this->userRepository->create([
                'email' => $adminData['email'],
                'password' => Hash::make($adminData['password']),
                'userable_id' => $companyAdmin->id,
                'userable_type' => CompanyAdmin::class,
                'status' => UserStatus::ACTIVE->value,
                'activation_token' => Str::uuid(),
                'email_verified_at' => null,
            ]);

            event(new Registered($user));

            \DB::commit();

            return [
                'success' => true,
                'message' => __('auth.registration_success'),
                'company' => $company,
                'user' => $user
            ];

        } catch (\Exception $e) {
            \DB::rollBack();

            return [
                'success' => false,
                'message' => __('auth.registration_failed', ['message' => $e->getMessage()]),
                'company' => null,
                'user' => null
            ];
        }
    }

    /**
     * Register public user
     */
    public function registerPublicUser(array $userData): array
    {
        try {
            \DB::beginTransaction();

            // 1. Create public user profile
            $publicUser = $this->publicUserRepository->create([
                'name' => $userData['name'],
                'date_of_birth' => $userData['date_of_birth'] ?? null,
                'gender' => $userData['gender'] ?? null,
                'phone' => $userData['phone'] ?? null,
                'city' => $userData['city'] ?? null,
                'is_profile_complete' => false,
            ]);

            // 2. Create user account
            $user = $this->userRepository->create([
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'phone' => $userData['phone'] ?? null,
                'userable_id' => $publicUser->id,
                'userable_type' => PublicUser::class,
                'status' => UserStatus::ACTIVE->value,
                'activation_token' => Str::random(64),
                'email_verified_at' => null,
            ]);

            event(new Registered($user));

            \DB::commit();

            return [
                'success' => true,
                'message' => __('auth.registration_success'),
                'user' => $user,
                'public_user' => $publicUser
            ];

        } catch (\Exception $e) {
            \DB::rollBack();

            return [
                'success' => false,
                'message' => __('auth.registration_failed', ['message' => $e->getMessage()]),
                'user' => null,
                'public_user' => null
            ];
        }
    }

    /**
     * Verify email address
     */
    public function verifyEmail(string $token): array
    {
        $user = $this->userRepository->findByActivationToken($token);

        if (!$user) {
            return [
                'success' => false,
                'message' => __('auth.verification_token_invalid')
            ];
        }

        if ($user->email_verified_at) {
            return [
                'success' => true,
                'message' => __('auth.email_already_verified')
            ];
        }

        $this->userRepository->update($user->id, [
            'email_verified_at' => now(),
            'activation_token' => null,
        ]);

        // Auto verify company if admin verified
        if ($user->isCompanyAdmin()) {
            $company = $user->userable->company;
            if ($company && $company->status === 'pending') {
                $this->companyRepository->update($company->id, [
                    'status' => UserStatus::ACTIVE->value,
                    'is_verified' => true,
                    'verified_at' => now(),
                ]);

                // Send company welcome email if needed
                // You can add company-specific welcome email here
            }
        }

        // Send welcome email after successful verification
        event(new WelcomeEmail($user));

        return [
            'success' => true,
            'message' => __('auth.email_verified_successfully'),
            'user' => $user
        ];
    }

    /**
     * Send password reset link
     */
    public function sendPasswordResetLink(string $email): array
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return [
                'success' => false,
                'message' => __('auth.user_not_found')
            ];
        }

        if ($user->status !== UserStatus::ACTIVE->value) {
            return [
                'success' => false,
                'message' => $this->getInactiveMessage($user->status)
            ];
        }

        // Generate reset token
        $token = Password::createToken($user);

        // Send reset email using new method
        event(new PasswordReset($user, $token));

        return [
            'success' => true,
            'message' => __('passwords.sent')
        ];
    }

    /**
     * Reset password
     */
    public function resetPassword(array $data): array
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            return [
                'success' => false,
                'message' => __('auth.user_not_found')
            ];
        }

        // Verify token
        if (!Password::tokenExists($user, $data['token'])) {
            return [
                'success' => false,
                'message' => __('auth.verification_token_invalid')
            ];
        }

        // Reset password
        $this->userRepository->update($user->id, [
            'password' => Hash::make($data['password']),
            'activation_token' => null,
        ]);

        // Delete token
        Password::deleteToken($user);

        event(new PasswordReset($user, $data['token']));

        return [
            'success' => true,
            'message' => __('passwords.reset')
        ];
    }

    /**
     * Change password for authenticated user
     */
    public function changePassword(User $user, array $data): array
    {
        // Verify current password
        if (!Hash::check($data['current_password'], $user->password)) {
            return [
                'success' => false,
                'message' => 'Password saat ini salah.'
            ];
        }

        // Update password
        $this->userRepository->update($user->id, [
            'password' => Hash::make($data['new_password']),
        ]);

        return [
            'success' => true,
            'message' => 'Password berhasil diubah.'
        ];
    }

    /**
     * Resend verification email
     */
    public function resendVerificationEmail(string $email): array
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return [
                'success' => false,
                'message' => __('auth.user_not_found')
            ];
        }

        if ($user->email_verified_at) {
            return [
                'success' => false,
                'message' => __('auth.email_already_verified')
            ];
        }

        // Generate new token if expired
        if (!$user->activation_token) {
            $this->userRepository->update($user->id, [
                'activation_token' => Str::random(64)
            ]);
            $user->refresh();
        }

        $this->sendVerificationEmail($user);

        return [
            'success' => true,
            'message' => __('auth.verification_email_sent')
        ];
    }

    /**
     * Generate unique company code
     */
    private function generateCompanyCode(string $companyName): string
    {
        $baseCode = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $companyName), 0, 6));
        $code = $baseCode;
        $counter = 1;

        while ($this->companyRepository->existsByCode($code)) {
            $code = $baseCode . str_pad($counter, 2, '0', STR_PAD_LEFT);
            $counter++;
        }

        return $code;
    }

    /**
     * Get redirect route based on user type
     */
    private function getRedirectRoute(User $user): string
    {
        return match (class_basename($user->userable_type)) {
            'SuperAdmin' => route('admin.dashboard'),
            'CompanyAdmin' => route('company.dashboard'),
            'PublicUser' => route('public.dashboard'),
            default => '/'
        };
    }

    /**
     * Get inactive user status message
     */
    private function getInactiveMessage(string $status): string
    {
        return match ($status) {
            'suspended' => __('auth.account_suspended'),
            'banned' => __('auth.account_banned'),
            default => __('auth.account_inactive')
        };
    }
}
