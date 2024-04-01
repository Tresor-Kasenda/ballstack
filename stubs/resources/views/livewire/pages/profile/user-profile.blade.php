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
        <div class="nk-block">
            <div class="alert alert-warning mb-5">
                <div class="alert-cta flex-wrap flex-md-nowrap">
                    <div class="alert-text"><p>Upgrade your account to unlock feature &amp; get lowest(%)
                            interest.</p></div>
                    <ul class="alert-actions gx-3 mt-3 mb-1 my-md-0">
                        <li class="order-md-last"><a href="#" class="btn btn-sm btn-warning">Upgrade</a></li>
                        <li><a href="#" class="link link-primary">Learn More</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </x-setting-aside>
</div>
