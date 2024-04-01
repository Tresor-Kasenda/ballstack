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
            <h5 class="nk-block-title">{{ __('Forget Password') }}</h5>
            <p>
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>
    </div>

    <x-auth-session class="mb-4" :status="session('status')"/>
    
    <form wire:submit="sendPasswordReset">
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

        <x-primary-button
            type="submit"
            class="btn-lg btn-outline-primary btn-dim btn-block rounded"
            wire:loading.attr="disabled"
        >
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </form>
</div>
