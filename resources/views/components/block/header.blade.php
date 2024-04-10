@props([
    'title'
])
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
