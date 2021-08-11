<?php

$canvasId = uniqid(); ?>
<!-- DONUT CHART -->
<div class="card card-danger">
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
            function shuffle(array) {
                var currentIndex = array.length, randomIndex;

                // While there remain elements to shuffle...
                while (0 !== currentIndex) {

                    // Pick a remaining element...
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex--;

                    // And swap it with the current element.
                    [array[currentIndex], array[randomIndex]] = [
                        array[randomIndex], array[currentIndex]];
                }

                return array;
            }

            const donutChartCanvas = $('#{{$canvasId}}').get(0).getContext('2d');
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            const chart = new Chart(donutChartCanvas, {
                type: 'doughnut',
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
                    const colors = shuffle(['#f94144', '#f3722c', '#f8961e', '#f9844a', '#f9c74f', '#90be6d', '#43aa8b', '#4d908e', '#577590', '#277da1', '#ffadad', '#ffd6a5', '#fdffb6', '#caffbf', '#9bf6ff', '#a0c4ff', '#ffc6ff', '#bdb2ff']);

                    chart.data.labels = response.map((obj) => obj['{{$group}}']);
                    chart.data.datasets.push({
                        data: response.map((obj) => obj.count),
                        backgroundColor: colors.slice(0, chart.data.labels.length)
                    });
                    chart.update();
                });
            }
        });
    </script>

@append
