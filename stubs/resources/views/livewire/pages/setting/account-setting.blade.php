<div>
    <x-setting-aside>
        <x-slot:title>
            {{ __('Parametre du site') }}
        </x-slot:title>
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner-group">
                    <div class="card-inner">
                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                            <div class="nk-block-text">
                                <h6>Save my Activity Logs</h6>
                                <p>You can save your all activity logs including unusual activity detected.</p>
                            </div>
                            <div class="nk-block-actions">
                                <ul class="align-center gx-3">
                                    <li class="order-md-last">
                                        <div class="custom-control custom-switch me-n2 checked">
                                            <input type="checkbox" class="custom-control-input" checked=""
                                                   id="activity-log">
                                            <label class="custom-control-label" for="activity-log"></label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="between-center flex-wrap g-3">
                            <div class="nk-block-text">
                                <h6>Change Password</h6>
                                <p>Set a unique password to protect your account.</p>
                            </div>
                            <div class="nk-block-actions flex-shrink-sm-0">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                    <li class="order-md-last">
                                        <a href="#" class="btn btn-primary">Change Password</a>
                                    </li>
                                    <li>
                                        <em class="text-soft text-date fs-12px">Last changed:
                                            <span>Oct 2, 2019</span></em>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                            <div class="nk-block-text">
                                <h6>2 Factor Auth &nbsp; <span class="badge badge-success ms-0">Enabled</span></h6>
                                <p>Secure your account with 2FA security. When it is activated you will need to
                                    enter not only your password, but also a special code using app. You can receive
                                    this code by in mobile app. </p>
                            </div>
                            <div class="nk-block-actions">
                                <a href="#" class="btn btn-primary">Disable</a>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- .card -->
        </div>
    </x-setting-aside>
</div>
