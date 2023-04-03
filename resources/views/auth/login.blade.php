<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="form-control"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group mt-4">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember_me" class="form-check-label text-sm text-gray-600">{{ __('Remember me') }}</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                                <x-button class="btn btn-primary">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>
                            <a href="{{ route('register') }}" class="btn btn-primary mr-2">登録画面</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>