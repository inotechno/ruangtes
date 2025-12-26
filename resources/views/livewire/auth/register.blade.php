<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="bg-primary text-white p-4">
                    <h4 class="mb-1 fw-semibold">{{ __('app.buttons.signup_for_public_user') }}</h4>
                    <p class="mb-0 opacity-75">
                        {{ __('auth.sign_in_to_continue', ['app_name' => config('app.name')]) }}
                    </p>
                </div>

                {{-- Body --}}
                <div class="card-body p-4 p-lg-5">
                    <form wire:submit.prevent="submit" class="row g-3">

                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.name') }}</label>
                            <input type="text"
                                   wire:model.defer="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="{{ __('app.placeholders.name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Date of birth --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.date_of_birth') }}</label>
                            <input type="date"
                                   wire:model.defer="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.gender') }}</label>
                            <select wire:model.defer="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                <option value="">-- {{ __('app.placeholders.choose', ['type' => __('app.labels.gender')]) }} --</option>
                                @foreach (\App\Enums\Gender::cases() as $gender)
                                    <option value="{{ $gender->value }}">
                                        {{ ucfirst(strtolower($gender->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.phone') }}</label>
                            <input type="text"
                                   wire:model.defer="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="{{ __('app.placeholders.phone') }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- City --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.city') }}</label>
                            <input type="text"
                                   wire:model.defer="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   placeholder="{{ __('app.placeholders.city') }}">
                            @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.email') }}</label>
                            <input type="email"
                                   wire:model.defer="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('app.placeholders.email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.password') }}</label>
                            <input type="password"
                                   wire:model.defer="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="{{ __('app.placeholders.password') }}">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password confirmation --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ __('app.labels.password_confirmation') }}</label>
                            <input type="password"
                                   wire:model.defer="password_confirmation"
                                   class="form-control"
                                   placeholder="{{ __('app.placeholders.password_confirmation') }}">
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 mt-4">
                            <button type="submit"
                                    class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                                <i class="mdi mdi-account-plus"></i>
                                <span>{{ __('app.buttons.register') }}</span>
                            </button>
                        </div>

                    </form>
                </div>

                {{-- Footer --}}
                <div class="text-center py-3 bg-light">
                    <small class="text-muted">
                        {{ __('app.labels.already_have_account') }}
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                            {{ __('app.buttons.login') }}
                        </a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
