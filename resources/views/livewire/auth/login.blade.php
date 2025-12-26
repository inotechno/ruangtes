<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">{{ __('auth.welcome_back') }}</h5>
                                <p>{{ __('auth.sign_in_to_continue', ['app_name' => config('app.name')]) }}</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
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
                    <div class="p-2">
                        <form class="form-horizontal" wire:submit.prevent="login">

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('app.labels.email') }}</label>
                                <input wire:model="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="{{ __('app.placeholders.email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('app.labels.password') }}</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input wire:model="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('app.placeholders.password') }}" aria-label="Password"
                                        aria-describedby="password-addon" wire:model="password"
                                        autocomplete="current-password">
                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                            class="mdi mdi-eye-outline"></i></button>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <label class="form-check-label" for="remember-check">
                                        {{ __('app.labels.remember_me') }}
                                    </label>
                                </div>

                                <div class="text-center">
                                    <a href="#" class="text-muted"><i class="mdi mdi-lock me-1"></i>
                                        {{ __('app.labels.forgot_password') }}</a>
                                </div>
                            </div>

                            <div class="mt-3 d-grid">
                                <button
                                    class="btn btn-primary waves-effect waves-light d-flex align-items-center justify-content-center gap-2"
                                    type="submit">
                                    <span>{{ __('app.buttons.login') }}</span>
                                    <i class="mdi mdi-login"></i>
                                </button>
                            </div>

                            <!-- <div class="mt-4 text-center">
                                <h5 class="font-size-14 mb-3">{{ __('app.labels.sign_in_with') }}</h5>

                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-primary text-white border-primary">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-info text-white border-info">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-danger text-white border-danger">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                        </form>
                    </div>

                    <div class="mt-3">
                        <div class="text-center mb-3">
                            <p class="text-muted mb-1">
                                {{ __('app.labels.no_account_yet') }}
                            </p>
                            <small class="text-muted">
                                {{ __('app.labels.choose_account_type') }}
                            </small>
                        </div>

                        <hr class="my-4" style="border-top: 1px solid #e0e0e0;">

                        <div class="mt-3 d-grid text-center">
                            <a class="btn btn-outline-success waves-effect waves-light d-flex align-items-center justify-content-center gap-2"
                                href="{{ route('register') }}">
                                <span>{{ __('app.buttons.signup_for_public_user') }}</span>
                                <i class="mdi mdi-account-plus "></i>
                            </a>
                        </div>

                        <div class="mt-2 d-grid text-center">
                            <a class="btn btn-outline-danger waves-effect waves-light d-flex align-items-center justify-content-center gap-2"
                                href="{{ route('register.company') }}">
                                <span>{{ __('app.buttons.signup_for_company') }}</span>
                                <i class="mdi mdi-domain "></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-4 text-center">
                <div>
                    <p>©
                        <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}. Crafted with
                        <i class="mdi mdi-heart text-danger"></i> by {{ config('app.author') }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>