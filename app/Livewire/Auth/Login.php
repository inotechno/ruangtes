<?php

namespace App\Livewire\Auth;

use App\Services\AuthenticationService;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    public $remember = false;

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => __('app.labels.email')]),
            'email.email' => __('validation.email', ['attribute' => __('app.labels.email')]),
            'password.required' => __('validation.required', ['attribute' => __('app.labels.password')]),
            'remember.boolean' => __('validation.boolean', ['attribute' => __('app.labels.remember_me')]),
        ];
    }

    public function login()
    {
        $this->validate();

        try {
            $service = app(AuthenticationService::class);
            $result = $service->authenticate([
                'email' => $this->email,
                'password' => $this->password,
                'remember' => $this->remember,
            ], 'web');

            if ($result['success']) {
                LivewireAlert::title(__('app.success'))
                    ->text($result['message'])
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();

                return redirect()->intended($result['redirect_to']);
            } else {
                LivewireAlert::title(__('app.error'))
                    ->text($result['message'])
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
            }
        } catch (\Exception $e) {
            LivewireAlert::title(__('app.error'))
                ->text($e->getMessage())
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.guest', ['title' => 'Login']);
    }
}
