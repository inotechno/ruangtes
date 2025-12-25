<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\TestRepository;
use App\Repositories\ParticipantRepository;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected UserRepository $userRepository;
    protected TestRepository $testRepository;
    protected ParticipantRepository $participantRepository;

    public function __construct(
        UserRepository $userRepository,
        TestRepository $testRepository,
        ParticipantRepository $participantRepository
    ) {
        $this->userRepository = $userRepository;
        $this->testRepository = $testRepository;
        $this->participantRepository = $participantRepository;
    }

    /**
     * Contoh penggunaan repository
     */
    public function index()
    {
        // Menggunakan UserRepository
        $activeUsers = $this->userRepository->getActiveUsers();
        $superAdmins = $this->userRepository->getSuperAdmins();

        // Menggunakan TestRepository
        $publishedTests = $this->testRepository->getPublishedTests();
        $availableTests = $this->testRepository->getAvailableForCompany();

        // Menggunakan ParticipantRepository
        $activeParticipants = $this->participantRepository->getActiveParticipants();

        return view('example', compact(
            'activeUsers',
            'superAdmins',
            'publishedTests',
            'availableTests',
            'activeParticipants'
        ));
    }

    /**
     * Contoh penggunaan dengan parameter
     */
    public function showUser(Request $request, $userId)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            abort(404);
        }

        // Update last login
        $this->userRepository->updateLastLogin($user, $request->ip());

        return view('user.show', compact('user'));
    }

    /**
     * Contoh transaksi dengan repository
     */
    public function createParticipant(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string',
            'email' => 'nullable|email',
            // ... other validation rules
        ]);

        try {
            $participant = $this->participantRepository->transaction(function() use ($data) {
                // Create participant
                $participant = $this->participantRepository->createWithUniqueCode($data);

                // Log activity
                // $this->auditLogRepository->logAction('participant_created', $participant, auth()->user());

                return $participant;
            });

            return redirect()->back()->with('success', 'Participant created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create participant');
        }
    }
}
