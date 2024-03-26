<div class="nk-block nk-block-middle nk-auth-body">
    <div class="brand-logo pb-5">
        <a href="{{ route('home') }}" class="logo-link">
            <img
                class="logo-light logo-img logo-img-lg"
                src="{{ asset('assets/images/logo.jpg') }}"
                srcset="{{ asset('assets/images/logo.jpg') }} 2x"
                alt="logo">
            <img
                class="logo-dark logo-img logo-img-lg"
                src="{{ asset('assets/images/logo.jpg') }}"
                srcset="{{ asset('assets/images/logo.jpg') }} 2x"
                alt="logo-dark">
        </a>
    </div>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Register</h5>
        </div>
    </div>
    <form wire:submit.prevent="register" method="post">
        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Name')" for="name"/>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model="name"
                    id="name"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                    type="text"
                    class="form-control-lg"
                    placeholder="Enter your name"
                />
            </div>

            <x-error :messages="$errors->get('name')" class="mt-1"/>
        </div>

        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Email')" for="email"/>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model="email"
                    id="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="email"
                    type="email"
                    class="form-control-lg"
                    placeholder="Enter your email address"
                />
            </div>

            <x-error :messages="$errors->get('email')" class="mt-1"/>
        </div>

        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Password')" for="password"/>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    autocomplete="password"
                    required
                    autofocus
                    class="form-control-lg"
                    type="password"
                    placeholder="Enter your password"
                />
            </div>

            <x-error :messages="$errors->get('password')" class="mt-1"/>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Confirm Password')" for="password_confirmation"/>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autofocus
                    autocomplete="new-password"
                    class="form-control-lg"
                    type="password"
                    placeholder="Enter your password confirmation"
                />
            </div>

            <x-error :messages="$errors->get('password')" class="mt-1"/>
        </div>
        <x-primary-button
            type="submit"
            class="btn-lg btn-outline-primary btn-dim btn-block rounded"
            wire:target=""
        >
            Register
        </x-primary-button>
    </form>
    <div class="form-note-s2 pt-4">
        <a href="{{ route('login') }}" wire:navigate>Already registered?</a>
    </div>
    <div class="text-center pt-4 pb-3">
        <h6 class="overline-title overline-title-sap">
            <span>OR</span>
        </h6>
    </div>
    <x-auth-social/>
</div>

