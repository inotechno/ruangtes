<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Bus\Queueable;

use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;

class PasswordReset implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public User $user;
    public string $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new PasswordResetEmail($this->user, $this->token));
    }
}
