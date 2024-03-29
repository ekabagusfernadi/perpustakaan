{{-- @dd($data_donut) --}}
@extends('layouts.admin')
@section("title", "Dashboard")
@section("header", "Dashboard")
@section('content')

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{ $total_buku }}</h3>

                <p>Total Buku</p>
                </div>
                <div class="icon">
                <i class="fas fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                <h3>{{ $total_anggota }}</h3>

                <p>Total Anggota</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{ $total_penerbit }}</h3>

                <p>Data Penerbit</p>
                </div>
                <div class="icon">
                <i class="fas fa-building"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>{{ $total_peminjaman }}</h3>

                <p>Data Peminjaman</p>
                </div>
                <div class="icon">
                <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                    <h3 class="card-title">Grafik Penerbit</h3>
    
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
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                    <h3 class="card-title">Grafik Peminjaman</h3>
    
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
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
                <!-- PIE CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Grafik Katalog</h3>
    
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
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection

<!-- jQuery -->
<script src="{{ asset('assets../../plugins/jquery/jquery.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
{{-- My Script --}}
<script type="text/javascript">

    let label_donut = '{!! json_encode($label_donut) !!}';  // ini harus petik satu ya ('')
    let data_donut = '{!! json_encode($data_donut) !!}';
    let data_bar = '{!! json_encode($data_bar) !!}';
    let data_pie = '{!! json_encode($data_pie) !!}';
    let label_pie = '{!! json_encode($label_pie) !!}';

    $(function () {
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
        // labels: [
        //     'Chrome',
        //     'IE',
        //     'FireFox',
        //     'Safari',
        //     'Opera',
        //     'Navigator',
        //     'Cuba'
        // ],
        labels: JSON.parse(label_donut),
        datasets: [
            {
            // data: [700,500,400,600,300,100],
            data: JSON.parse(data_donut),
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#42220B'],
            }
        ]
        }
        var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
        })

        //-------------
        //- BAR CHART -
        //-------------

        var areaChartData = {
        labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: JSON.parse(data_bar)
        }

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        // var temp0 = areaChartData.datasets[0]
        // var temp1 = areaChartData.datasets[1]
        // barChartData.datasets[0] = temp1
        // barChartData.datasets[1] = temp0

        var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
        }

        new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
        })

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = {
            labels: JSON.parse(label_pie),
            datasets: [
                {
                // data: [700,500,400,600,300,100],
                data: JSON.parse(data_pie),
                backgroundColor : ['#001aff', '#4557ff', '#8590ff', '#00c0ef', '#9bdbeb'],
                }
            ]
        }
        var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }

        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
        })

    });

</script>