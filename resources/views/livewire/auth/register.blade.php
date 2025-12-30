<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-6">
            <div class="card overflow-hidden">
                {{-- Header --}}
                <div class="bg-primary bg-soft ">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">{{ __('app.labels.register_now') }}</h5>
                                <p>{{ __('app.labels.signup_for_public_user') }}</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body pt-0">
                    {{-- Logo --}}
                    <div class="auth-logo">
                        <a href="#" class="auth-logo-light">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('images/logo-white.png') }}" alt="" class="rounded-circle"
                                        height="34">
                                </span>
                            </div>
                        </a>

                        <a href="#" class="auth-logo-dark">
                            <div class="avatar-md profile-user-wid mb-4">
                                <span class="avatar-title rounded-circle bg-light">
                                    <img src="{{ asset('images/logo.png') }}" alt="" class="rounded-circle" height="34">
                                </span>
                            </div>
                        </a>
                    </div>

                    <div class="p-4">
                        <form wire:submit.prevent="submit" class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.name') }}</label>
                                <input type="text" wire:model="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('app.placeholders.name') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.email') }}</label>
                                <input type="email" wire:model="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="{{ __('app.placeholders.email') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>


                            <div class="col-12">
                                <div class="row g-3">

                                    {{-- Date of Birth --}}
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('app.labels.date_of_birth') }}</label>
                                        <input type="date" wire:model="date_of_birth"
                                            class="form-control @error('date_of_birth') is-invalid @enderror">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gender --}}
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('app.labels.gender') }}</label>
                                        <select wire:model="gender"
                                            class="form-select @error('gender') is-invalid @enderror">
                                            <option value="">--
                                                {{ __('app.placeholders.choose', ['type' => __('app.labels.gender')]) }}
                                                --
                                            </option>
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender->value }}">
                                                    {{ strtoupper($gender->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('app.labels.phone') }}</label>
                                        <input type="text" wire:model="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="{{ __('app.placeholders.phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- Province --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.province') }}</label>
                                <select wire:model.live="province"
                                    class="form-select @error('province') is-invalid @enderror">
                                    <option value="">--
                                        {{ __('app.placeholders.choose', ['type' => __('app.labels.province')]) }} --
                                    </option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->code }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('province') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Regency --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.regency') }}</label>
                                <select wire:model.live="regency"
                                    class="form-select @error('regency') is-invalid @enderror" @disabled(!$province)>
                                    <option value="">--
                                        {{ __('app.placeholders.choose', ['type' => __('app.labels.regency')]) }} --
                                    </option>
                                    @foreach ($regencies as $item)
                                        <option value="{{ $item->code }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('regency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- District --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.district') }}</label>
                                <select wire:model.live="district"
                                    class="form-select @error('district') is-invalid @enderror" @disabled(!$regency)>
                                    <option value="">--
                                        {{ __('app.placeholders.choose', ['type' => __('app.labels.district')]) }} --
                                    </option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->code }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Village --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.village') }}</label>
                                <select wire:model.live="village"
                                    class="form-select @error('village') is-invalid @enderror" @disabled(!$district)>
                                    <option value="">--
                                        {{ __('app.placeholders.choose', ['type' => __('app.labels.village')]) }} --
                                    </option>
                                    @foreach ($villages as $item)
                                        <option value="{{ $item->code }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('village') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.password') }}</label>
                                <input type="password" wire:model="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.labels.password_confirmation') }}</label>
                                <input type="password" wire:model="password_confirmation" class="form-control">
                            </div>

                            {{-- Terms and Conditions --}}
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" wire:model="terms">
                                    <label class="form-check-label" for="terms">{{ __('app.labels.i_agree_to_the') }} <a href="#">{{ __('app.labels.terms_and_conditions') }}</a></label>
                                    @error('terms') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12 mt-4 d-grid">
                                <button class="btn btn-primary btn-lg">
                                    <i class="mdi mdi-account-plus me-1"></i>
                                    {{ __('app.buttons.register') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="text-center mt-4 text-muted">
                <p>
                    ©
                    <script>document.write(new Date().getFullYear())</script>
                    {{ config('app.name') }}
                </p>
            </div>
        </div>
    </div>
</div>