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
            @if (session('status') == 'verification-link-sent')
                <div class="text-primary">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex">
        <x-primary-button wire:click="sendVerification">
            {{ __('Resend Verification Email') }}
        </x-primary-button>

        <x-primary-button type="submit" wire:click="logout">
            {{ __('Log Out') }}
        </x-primary-button>
    </div>
</div>
