@php
    $name = $getName();
    $route = $getSubmit();
    $steps = $getSteps();
@endphp

<div class="nk-block nk-block-lg">
    <div class="card card-bordered">
        <form class="nk-stepper stepper-init is-alter nk-stepper-s1" action="#" id="stepper-create-project">
            <div class="row g-0 col-sep col-sep-md col-sep-xl">
                <div class="col-md-4 col-xl-4">
                    <div class="card-inner">
                        <ul class="nk-stepper-nav nk-stepper-nav-s1 stepper-nav is-vr">
                            @foreach($steps as $key => $step)
                                <li>
                                    <div class="step-item">
                                        <div class="step-text">
                                            <div class="lead-text">{{ $step->getName() }}</div>
                                            <div class="sub-text">{{ $step->getName() }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-xl-8">
                    <div class="card-inner">
                        <div class="nk-stepper-content">
                            <div class="nk-stepper-steps stepper-steps">
                                @foreach($steps as $key => $step)
                                    {{ $step }}
                                @endforeach
                            </div>
                            <ul class="nk-stepper-pagination pt-4 gx-4 gy-2 stepper-pagination">
                                <li class="step-prev">
                                    <button class="btn btn-dim btn-primary">Prev</button>
                                </li>
                                <li class="step-next">
                                    <button class="btn btn-primary">Next</button>
                                </li>
                                <li class="step-submit">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
