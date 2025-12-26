<?php

namespace App\Livewire\Auth;

use App\Services\AuthenticationService;
use Illuminate\Validation\Rule;
use App\Enums\Gender;
use App\Services\RegionService;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $date_of_birth;
    public $gender;
    public $phone;
    public $province, $regency, $district, $village;
    public $provinces = [], $regencies = [], $districts = [], $villages = [];
    public $email;
    public $password;
    public $password_confirmation;
    public $genders = [];

    public function mount()
    {
        $this->provinces = $this->getProvinces();
        $this->genders = Gender::cases();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(Gender::cases())],
            'phone' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'email' => ['email', 'required', 'unique:users,email'],
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
            'province.required' => __('validation.required', ['attribute' => 'province']),
            'regency.required' => __('validation.required', ['attribute' => 'regency']),
            'district.required' => __('validation.required', ['attribute' => 'district']),
            'village.required' => __('validation.required', ['attribute' => 'village']),
            'password.required' => __('validation.required', ['attribute' => 'password']),
            'password.min' => __('validation.min', ['attribute' => 'password', 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => 'password']),
            'gender.enum' => __('validation.enum', ['attribute' => 'gender']),
            'phone.string' => __('validation.string', ['attribute' => 'phone']),
            'phone.max' => __('validation.max', ['attribute' => 'phone', 'max' => 255]),
            'province.string' => __('validation.string', ['attribute' => 'province']),
            'province.max' => __('validation.max', ['attribute' => 'province', 'max' => 255]),
            'regency.string' => __('validation.string', ['attribute' => 'regency']),
            'regency.max' => __('validation.max', ['attribute' => 'regency', 'max' => 255]),
            'district.string' => __('validation.string', ['attribute' => 'district']),
            'district.max' => __('validation.max', ['attribute' => 'district', 'max' => 255]),
            'village.string' => __('validation.string', ['attribute' => 'village']),
            'village.max' => __('validation.max', ['attribute' => 'village', 'max' => 255]),
            'city.max' => __('validation.max', ['attribute' => 'city', 'max' => 255]),
            'password.string' => __('validation.string', ['attribute' => 'password']),
            'email.email' => __('validation.email', ['attribute' => 'email']),
            'email.unique' => __('validation.unique', ['attribute' => 'email'])
        ];
    }

    public function updatedProvince()
    {
        $this->regencies = $this->getRegencies();
    }

    public function updatedRegency()
    {
        $this->districts = $this->getDistricts();
    }

    public function updatedDistrict()
    {
        $this->villages = $this->getVillages();
    }

    public function getProvinces()
    {
        return app(RegionService::class)->getProvinces();
    }

    public function getRegencies()
    {
        return app(RegionService::class)->getRegenciesByProvince($this->province);
    }

    public function getDistricts()
    {
        return app(RegionService::class)->getDistrictsByRegency($this->regency);
    }

    public function getVillages()
    {
        return app(RegionService::class)->getVillagesByDistrict($this->district);
    }

    public function submit()
    {
        $this->validate();

        try {
            $service = app(AuthenticationService::class);
            $result = $service->registerPublicUser([
                'name' => $this->name,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender->value,
                'phone' => $this->phone,
                'province' => $this->province,
                'regency' => $this->regency,
                'district' => $this->district,
                'village' => $this->village,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            if ($result['success']) {
                LivewireAlert::title(__('app.messages.registration_success'))->success($result['message']);
                return redirect()->route('login');
            } else {
                LivewireAlert::title(__('app.messages.registration_failed'))->error($result['message']);
                return redirect()->route('register');
            }
        } catch (\Exception $e) {
            LivewireAlert::title(__('app.messages.registration_failed'))->error($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.guest', ['title' => 'Register']);
    }
}
