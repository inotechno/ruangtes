<?php

namespace App\Livewire\Auth;

use Illuminate\Validation\Rule;
use App\Enums\Gender;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $date_of_birth;
    public $gender;
    public $phone;
    public $city;
    public $password;
    public $password_confirmation;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(Gender::cases())],
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'name']),
            'date_of_birth.required' => __('validation.required', ['attribute' => 'date of birth']),
            'gender.required' => __('validation.required', ['attribute' => 'gender']),
            'phone.required' => __('validation.required', ['attribute' => 'phone']),
            'city.required' => __('validation.required', ['attribute' => 'city']),
            'password.required' => __('validation.required', ['attribute' => 'password']),
            'password.min' => __('validation.min', ['attribute' => 'password', 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => 'password']),
            'gender.enum' => __('validation.enum', ['attribute' => 'gender']),
            'phone.string' => __('validation.string', ['attribute' => 'phone']),
            'phone.max' => __('validation.max', ['attribute' => 'phone', 'max' => 255]),
            'city.string' => __('validation.string', ['attribute' => 'city']),
            'city.max' => __('validation.max', ['attribute' => 'city', 'max' => 255]),
            'password.string' => __('validation.string', ['attribute' => 'password']),
        ];
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.guest', ['title' => 'Register']);
    }
}
