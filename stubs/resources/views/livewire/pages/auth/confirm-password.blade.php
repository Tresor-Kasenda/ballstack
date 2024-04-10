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
            <h5 class="nk-block-title">{{ __('Confirm Password') }}</h5>
        </div>
    </div>
    <form wire:submit="confirmPassword">
        <div class="form-group">
            <div class="form-label-group">
                <x-label :value="__('Password')" for="password"/>
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
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</div>

