<div
    class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card">
                <div class="user-avatar bg-primary">
                    <span>{{ strtoupper(substr(auth()->user()->name,0, 2)) }}</span>
                </div>
                <div class="user-info">
                    <span class="lead-text">{{ auth()->user()->name }}</span>
                    <span class="sub-text">{{ auth()->user()->email }}</span>
                </div>
                <div class="user-action">
                    <div class="dropdown">
                        <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#">
                            <em class="icon ni ni-more-v"></em>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <ul class="link-list-opt no-bdr">
                                <li>
                                    <a href="#">
                                        <em class="icon ni ni-camera-fill"></em>
                                        <span>Change Photo</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <em class="icon ni ni-edit-fill"></em>
                                        <span>Update Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-inner">
            <div class="user-account-info py-0">
                <h6 class="overline-title-alt">Account Balance</h6>
                <div class="user-balance">
                    12.395769
                    <small class="currency currency-btc">USD</small>
                </div>
                <div class="user-balance-sub">
                    Pending
                    <span>
                        0.344939
                        <span class="currency currency-btc">USD</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-inner p-0">
            <ul class="link-list-menu">
                <li>
                    <a
                        class="{{ request()->routeIs('profile') ? 'active' : '' }}"
                        href="{{ route('profile') }}"
                        wire:navigate
                    >
                        <em class="icon ni ni-user-fill-c"></em>
                        <span>{{ __('Personal Infomation')  }}</span>
                    </a>
                </li>
                <li>
                    <a
                        class="{{ request()->routeIs('setting') ? 'active' : '' }}"
                        href="{{ route('setting') }}"
                        wire:navigate
                    >
                        <em class="icon ni ni-lock-alt-fill"></em>
                        <span>{{ __('Security Settings') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-inner">
            <div class="user-account-info py-0">
                <h6 class="overline-title-alt">Last Login</h6>
                <p>06-29-2020 02:39pm</p>
                <h6 class="overline-title-alt">Login IP</h6>
                <p>192.129.243.28</p>
            </div>
        </div>
    </div>
</div>
