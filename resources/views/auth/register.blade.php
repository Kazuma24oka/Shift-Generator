<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="form-control mt-1" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="form-control mt-1"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" class="form-control mt-1"
                                                type="password"
                                                name="password_confirmation" required />
                            </div>

                            <div class="form-group d-flex justify-content-end mt-4">
                                <a class="text-decoration-none text-sm text-gray-600 hover:text-gray-900 mr-2" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="btn btn-primary">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-primary mr-2">ログイン画面</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>