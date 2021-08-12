<?php

$canvasId = uniqid(); ?>
<!-- DONUT CHART -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title ?? 'Chart'  }}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <canvas id="{{$canvasId}}"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@section('js-footer')
    <script type="text/javascript">
        $(function () {
            const lineChartCanvas = $('#{{$canvasId}}').get(0).getContext('2d');
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            const chart = new Chart(lineChartCanvas, {
                type: 'line',
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    data: {
                        labels: [],
                        datasets: [{
                            data: [],
                        }]
                    }
                }
            });
            ajax_chart(chart, '{{$url}}', {});

            function ajax_chart(chart, url, data) {
                data = data || {};
                $.getJSON(url, data).done(function (response) {

                    chart.data.labels = response.map((obj) => obj['{{$group}}']);
                    chart.data.datasets.push({
                        data: response.map((obj) => obj.count),
                        label: '{{$title ?? ''}}'
                    });
                    chart.update();
                });
            }
        });
    </script>

@append
