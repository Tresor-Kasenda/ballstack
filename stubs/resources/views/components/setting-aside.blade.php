<?php

use App\Action\AuthenticationAction;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

new class extends Component {
    public function submit(AuthenticationAction $action): void
    {
        $action->sendVerification();
    }
}; ?>
<div class="nk-block">
    @if (session('status') === 'verification-link-sent')
        <p
            class="mt-2 text-danger text-sm"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        >
            {{ __('A new verification link has been sent to your email address.') }}
        </p>
    @endif
    @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
        <div class="alert alert-warning mb-2">
            <div class="alert-cta flex-wrap flex-md-nowrap">
                <div class="alert-text">
                    <p> {{ __('Your email address is unverified.') }}</p>
                </div>
                <ul class="alert-actions gx-3 mt-3 mb-1 my-md-0">
                    <li class="order-md-last">
                        <button wire:click.prevent="submit" class="btn btn-sm btn-warning">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">{{ $title }}</h4>
                        </div>
                        <div class="d-flex align-center">
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger" data-target="userAside">
                                    <em class="icon ni ni-menu-alt-r"></em>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    {{ $slot }}
                </div>
            </div>
            <x-settings-sidebar/>
        </div>
    </div>
</div>
