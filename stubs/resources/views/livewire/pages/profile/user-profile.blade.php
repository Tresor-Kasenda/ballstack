<div>

    <x-setting-aside>
        <x-slot:title>
            {{ __('Personal Information') }}
        </x-slot:title>
        <p>{{ __('Basic info, like your name and address, that you use on Nio Platform.') }}</p>
        <div class="nk-block">
            <div class="profile-ud-list pt-2">
                <x-profile-item
                    title="{{ __('Monsieur') }}"
                    :name="auth()->user()->name"
                />
                <x-profile-item
                    title="{{ __('Email') }}"
                    :name="auth()->user()->email"
                />
                <x-profile-item
                    title="{{ __('Date de creation') }}"
                    :name="auth()->user()->created_at->format('M,D y')"
                />
                <x-profile-item
                    title=" {{ __('Name') }}"
                    :name="auth()->user()->name"
                />
            </div>
        </div>

        <div class="nk-divider divider md"></div>
    </x-setting-aside>
</div>
