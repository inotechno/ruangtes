<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Login extends Component
{


    public $email, $password, $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (Auth::attempt([
                'email' => $this->email,
                'password' => $this->password,
            ], $this->remember)) {
                $user = Auth::user();

                /*
                activity()
                    ->causedBy($user)
                    ->withProperties(['ip' => request()->ip()])
                    ->event('login')
                    ->log("telah melakukan login");
                */

                LivewireAlert::title('Selamat datang di dashboard Employee Management System')
                    ->success()
                    ->show();
                return redirect()->route('dashboard.index');
            }

            LivewireAlert::title('Email atau password salah!')
                ->error()
                ->show();
            return back();
        } catch (\Throwable $th) {
            report($th);
            LivewireAlert::title('Terjadi kesalahan, silakan coba lagi!')
                ->error()
                ->show();
            return back();
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.guest');
    }
}
