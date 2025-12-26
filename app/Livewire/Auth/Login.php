<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember = false;

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => 'Email']),
            'email.email' => __('validation.email', ['attribute' => 'Email']),
            'password.required' => __('validation.required', ['attribute' => 'Password']),
        ];
    }

    public function login()
    {
        $this->validate();

    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.guest', ['title' => 'Login']);
    }
}
