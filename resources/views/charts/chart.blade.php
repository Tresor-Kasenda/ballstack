@php
    $name = $getName();
    $labels = $getLabel();
    $datasets = $getDatasets();
    $type = $getType();
    $borderColor = $getBorderColor();
    $backgroundColor = $getBackgroundColor();
@endphp
<div
    class="card card-bordered card-preview"
    x-data="{
        chart: null,
        init() {
            this.chart = new Chart(this.$refs.chartjs, {
                type: '{{ $type }}',
                data: {
                  labels: @js($datasets),
                  datasets: [{
                    label: '{{ $labels }}',
                    data: @js($datasets),
                    borderWidth: 1,
                    backgroundColor: @js($backgroundColor),
                    borderColor: @js($borderColor),
                  }]
                },
                options: {
                  indexAxis: 'y',
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
            });
        }
    }"
    x-init="init"
>
    <div class="card-inner">
        <div class="card-head">
            <h6 class="title">{{ $name }}</h6>
        </div>
        <div>
            <canvas id="chartjs" x-ref="chartjs"></canvas>
        </div>
    </div>
</div>
