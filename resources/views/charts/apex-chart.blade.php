@php
    $name = $getName();
    $height = $getHeight();
    $type = $getType();
    $dataLabel = $getDataLabel();
    $datasets = $getDataset();
@endphp

<div
    wire:ignore
    class="card card-full"
    x-data="{
        chart: null,
        init() {
            this.chart = new ApexCharts(this.$refs.chart,{
                chart: {
                    type: '{{ $type }}',
                    height: '{{ $height }}',
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    @if($type === 'bar')
                        bar: {
                            horizontal: false,
                            dataLabels: {
                                position: 'top'
                            }
                        },
                    @endif
                    @if($type === 'line')
                        line: {
                            curve: '{{ $getStroke() }}'
                        },
                    @endif
                },
                @if($type === 'line')
                    stroke: {
                        curve: '{{ $getStroke() }}'
                    },
                @endif
                dataLabels: {
                    enabled: '{{ $dataLabel }}',
                },
                series: [
                    {
                        name: '{{ $name }}',
                        data: @js($datasets),
                    },
                ],
                xaxis: {
                    categories: @js($getCategories()),
                },
                yaxis: {
                    title: {
                        text: '{{ $name }}',
                    },
                },
            });
            this.chart.render();
        }
    }"
    x-init="init"
>
    <div class="nk-ecwg nk-ecwg8 h-100">
        <div class="card-inner">
            <div class="card-title-group mb-3">
                <div class="card-title">
                    <h6 class="title">{{ $name }}</h6>
                </div>
            </div>
            <div class="nk-ecwg8-ck" style="margin-bottom: 3rem">
                <div
                    x-ref="chart"
                ></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
