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
        <div class="mb-4 text-sm">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
        <div class="nk-block-head-content">
            @if (session('status') == 'verification-link-sent')
                <div class="text-primary">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex gap gap-20px">
        <x-primary-button wire:click="sendVerification" class="btn btn-outline-primary btn-dim">
            {{ __('Resend Verification Email') }}
        </x-primary-button>

        <x-primary-button type="submit" wire:click="logout" class="btn btn-outline-danger btn-dim"
                          style="margin-left: 0.5rem">
            {{ __('Log Out') }}
        </x-primary-button>
    </div>
</div>
