@php
    $label = $getLabel();
    $name = $getName();
    $startRange = $getMinDate();
    $endRange = $getMaxDate();
    $required = $getRequired();
@endphp
<div
    class="form-group"
    x-data="{
        startDate: '',
        endDate: '',
        initializeDateRangePicker() {
            $(this.$refs.dateRangePicker).daterangepicker({
                startDate: moment().subtract(7, 'days'),
                endDate: moment(),
                ranges: {
                    'Last 7 Days': [moment().subtract(7, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [
                        moment().subtract(1, 'month').startOf('month'),
                        moment().subtract(1, 'month').endOf('month')
                    ]
                }
            }, (start, end) => {
                this.startDate = start.format('YYYY-MM-DD');
                this.endDate = end.format('YYYY-MM-DD');
            });
        }
    }"
    x-init="initializeDateRangePicker()"
>
    @if($label)
        <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="form-control-wrap">
        <input
            type="text"
            wire:model="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror"
            native="false"
            @if($required) required @endif
            x-ref="dateRangePicker"
        />
    </div>

</div>

@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.x/daterangepicker.css"/>
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.5.x/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.29.x/moment.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.x/daterangepicker.min.js"></script>
@endpush
