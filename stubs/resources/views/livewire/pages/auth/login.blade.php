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
            <h5 class="nk-block-title">Sign-In</h5>
        </div>
    </div>
    <form wire:submit="login">
        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Email')" for="email"/>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model.live="email"
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
                <a
                    class="link link-primary link-sm"
                    tabindex="-1"
                    href="{{ route('password.request') }}"
                    wire:navigate
                >Forgot password?</a>
            </div>
            <div class="form-control-wrap">
                <x-text-input
                    wire:model.live="password"
                    id="password"
                    name="password"
                    required
                    autofocus
                    class="form-control-lg"
                    autocomplete="password"
                    type="password"
                    placeholder="Enter your password"
                />
            </div>

            <x-error :messages="$errors->get('password')" class="mt-1"/>
        </div>
        <x-primary-button
            type="submit"
            class="btn-lg btn-outline-primary btn-dim btn-block rounded"
            wire:loading.attr="disabled"
        >
            Sign in
        </x-primary-button>
    </form>
    <div class="form-note-s2 pt-4">
        New on our platform?
        <a href="{{ route('register') }}" wire:navigate>Create an account</a>
    </div>
</div>
