@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
 <div class="content">
            <div class="container-fluid">
<div class="row">
    <div class="col-md-8">
        <div class="card card-chart">
            <div class="card-header card-header-success">
                <canvas   id="myChart"></canvas>
            </div>
            <div class="card-body">
                <h4 class="card-title">Daily Sales</h4>
                <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in
                    today sales.
                </p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>



    const data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ],

        datasets: [


            {
                label: 'القيم المثالية',
                data :[ {x:3.3 , y:49.8},{x:4.4 , y:54.8}, {x:5.6 , y:58.4},{x:6.4 , y:61.4},{x:7 , y:64},{x:7.5 , y:66},{x:7.9 , y:67.5},{x:8.3 , y:69},{x:8.6 , y:70.6},{x:8.9 , y:71.8},{x:9.1 , y:73.1},{x:9.4 , y:74.4}],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgb(75, 192, 192)',

            },

            {
                label: 'القيم المدخلة',
                data :[ {x:3.3 , y:49.8}, {x:6.4 , y:54.4},{x:7 , y:64},{x:7.5 , y:66},{x:7.9 , y:67.5},{x:8.3 , y:69},{x:8.6 , y:70.6},{x:8.9 , y:66.8}, ],
                fill: false,
                borderColor: 'rgb(242, 55, 55)',
                backgroundColor:'rgb(242, 55, 55)',

            }
        ]
    };
    const config = {

        type: 'line',
        data: data,
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {

                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 20,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    }
                },
                y: {
                    display: false,
                    title: {
                        display: false,
                        color: '#191',
                        font: {
                            family: 'Times',
                            size: 20,
                            style: 'normal',
                            lineHeight: 1.2
                        },
                        padding: {
                            top: 30,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    }
                }
            },
            plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label =  " الوزن "+data.datasets[0].data[context.parsed.x].x +' كغ  ';
                            label=label+"\r\n"+"   الطول "+ context.parsed.y +" سم  "

                        return label;
                    }
                }
            }
        }
        },
    };
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

</script>
@endpush
