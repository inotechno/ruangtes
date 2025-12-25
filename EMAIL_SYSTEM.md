# RuangTes Email System Documentation

## Overview
RuangTes has a comprehensive email system with support for multiple languages (English & Indonesian) and beautiful, responsive email templates.

## Email Classes Created

### 1. EmailVerification (`App\Mail\EmailVerification`)
**Purpose:** Send email verification links to new users

**Features:**
- Signed URLs for security
- Expiration time (60 minutes default)
- Multi-language support based on user/company language
- Responsive design with modern styling

**Usage:**
```php
use App\Mail\EmailVerification;
use App\Models\User;

$user = User::find(1);
Mail::to($user->email)->send(new EmailVerification($user));
```

### 2. PasswordResetEmail (`App\Mail\PasswordResetEmail`)
**Purpose:** Send password reset links to users

**Features:**
- Secure token-based reset links
- Expiration warnings
- Security notices
- Multi-language support

**Usage:**
```php
use App\Mail\PasswordResetEmail;
use App\Models\User;

$user = User::find(1);
$token = Password::createToken($user);
Mail::to($user->email)->send(new PasswordResetEmail($user, $token));
```

### 3. WelcomeEmail (`App\Mail\WelcomeEmail`)
**Purpose:** Send welcome message after email verification

**Features:**
- Feature highlights
- Support contact information
- Call-to-action buttons
- Celebration design

**Usage:**
```php
use App\Mail\WelcomeEmail;
use App\Models\User;

$user = User::find(1);
Mail::to($user->email)->send(new WelcomeEmail($user));
```

## Email Templates

### Template Files Created:
- `resources/views/emails/verification.blade.php`
- `resources/views/emails/password_reset.blade.php`
- `resources/views/emails/welcome.blade.php`

### Design Features:
- ✅ Responsive design (mobile-friendly)
- ✅ Modern gradient headers
- ✅ Clear call-to-action buttons
- ✅ Professional typography
- ✅ Security notices and warnings
- ✅ Multi-language support
- ✅ Dark mode support

## Language Files

### Files Created:
- `lang/en/emails.php` - English email content
- `lang/id/emails.php` - Indonesian email content

### Email Types Covered:
1. **Verification Emails**
2. **Password Reset Emails**
3. **Welcome Emails**
4. **Company Verification Emails**
5. **Company Approval Emails**
6. **Participant Invitation Emails**
7. **Test Completion Emails**
8. **Test Reminder Emails**
9. **Account Status Emails**

## AuthenticationService Integration

### New Methods Added:

#### `sendVerificationEmail(User $user): bool`
```php
// Automatically called during registration
$this->sendVerificationEmail($user);
```

#### `sendWelcomeEmail(User $user): bool`
```php
// Automatically called after email verification
$this->sendWelcomeEmail($user);
```

#### `sendPasswordResetEmail(User $user, string $token): bool`
```php
// Called during password reset process
$this->sendPasswordResetEmail($user, $token);
```

## Email Flow

### 1. User Registration Flow:
```
1. User registers → EmailVerification sent
2. User clicks verification link → Email verified
3. WelcomeEmail sent automatically
```

### 2. Password Reset Flow:
```
1. User requests reset → PasswordResetEmail sent
2. User clicks reset link → Password reset form
3. Password updated → Success message
```

### 3. Company Registration Flow:
```
1. Company registers → EmailVerification sent
2. Admin verifies email → Company auto-approved
3. WelcomeEmail sent
```

## Configuration

### Email Settings (`.env`):
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@domain.com
MAIL_FROM_NAME="RuangTes"
```

### Verification Settings:
```php
// config/auth.php
'verification' => [
    'expire' => 60, // minutes
],
```

## Security Features

### 1. Signed URLs
- Email verification uses signed URLs for security
- Prevents unauthorized access

### 2. Token Expiration
- Verification links expire in 60 minutes
- Password reset tokens expire based on config

### 3. Rate Limiting
- Prevents email spam
- Built-in Laravel throttling

## Multi-Language Support

### Automatic Language Detection:
```php
// Based on user's company language preference
$language = $user->userable?->company?->language ?? 'id';

// Or fallback to app default
$language = app()->getLocale();
```

### Usage in Templates:
```blade
{{ __('emails.verification.subject') }}
{{ __('emails.welcome.greeting', ['name' => $user->name]) }}
```

## Testing Emails

### 1. Using Laravel Mail Fake:
```php
use Illuminate\Support\Facades\Mail;

Mail::fake();

// Perform action that sends email

Mail::assertSent(EmailVerification::class, function ($mail) use ($user) {
    return $mail->user->id === $user->id;
});
```

### 2. Preview Emails:
```php
// In routes/web.php for testing
Route::get('/preview-email', function () {
    $user = User::first();
    return new EmailVerification($user);
});
```

## Email Templates Customization

### Color Scheme:
- Verification: Blue gradient (#667eea to #764ba2)
- Password Reset: Orange gradient (#f59e0b to #d97706)
- Welcome: Green gradient (#10b981 to #059669)

### Fonts:
- Primary: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif
- Responsive and web-safe

### Responsive Breakpoints:
- Desktop: Default styles
- Mobile: max-width: 640px

## Future Email Types

### Planned Email Templates:
- Company approval notifications
- Test invitation emails
- Certificate delivery emails
- Payment confirmation emails
- Subscription renewal reminders
- System maintenance notifications

## Troubleshooting

### Common Issues:

1. **Emails not sending:**
   - Check SMTP configuration
   - Verify MAIL_* settings in .env
   - Check Laravel logs for errors

2. **Wrong language:**
   - Ensure user/company has correct language setting
   - Check app locale configuration

3. **Links not working:**
   - Verify APP_URL in .env
   - Check route definitions
   - Test signed URLs

### Debug Commands:
```bash
# Test email sending
php artisan tinker
Mail::to('test@example.com')->send(new EmailVerification(User::first()));

# Check mail configuration
php artisan config:list | grep mail
```

## Performance Considerations

### Queue Emails:
All email classes implement `ShouldQueue` for better performance:
```php
class EmailVerification extends Mailable implements ShouldQueue
```

### Database Optimization:
- Emails are queued by default
- Use proper indexes on email-related columns
- Monitor email queue performance

This email system provides a professional, scalable solution for all RuangTes communication needs with full internationalization support.
