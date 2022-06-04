@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
<div class="row">

    <div class="col-md-6 h-25 mx-auto">
        <div class="card card-chart">
            <div class="card-header card-header-info">


                <h4 class="card-title">مخطط الطول المثالي للطفل</h4>
                <p class="card-category">يحوي قيم الطول المثالي مقاس ب سم</p>
            </div>
            <div class="card-header ">

                <canvas   id="height"></canvas>

            </div>


        </div>
    </div>


    <div class="col-md-6 h-25 mx-auto">
        <div class="card card-chart">
            <div class="card-header card-header-info">

                <h4 class="card-title">مخطط الوزن المثالي للطفل</h4>
                <p class="card-category">يحوي قيم الوزن المثالي مقاس ب كغ</p>
            </div>
            <div class="card-header ">

                <canvas   id="weight"></canvas>
            </div>

        </div>
    </div>
</div>
 <div class="row">
@php
    $months= ['الشهر الاول', 'الشهر الثاني', 'الشهر الثالث', 'الشهر الرابع', 'الشهر الخامس', 'الشهر السادس', 'الشهر السابع', 'الشهر الثامن', 'الشهر التاسع', 'الشهر العاشر', 'الشهر الحادي عشر',
            'الشهر الثاني عشر'
 ];
@endphp
                    <div class="col-lg-10 mx-auto col-md-12">
                        <div class="card">
                            <div class="card-header card-header-info">
                                @isset($count)

                                @if ($count<12)


                                <span data-toggle="tooltip" data-placement="auto" class=" float-left  ">
                                    <button type="button" class="btn btn-info p-2 rounded " data-toggle="modal" data-target="#addweight">
                                        <i class="fas fa-plus-circle fa-2x"></i>
                                    </button>
                                </span>
                                @endif
                                @endisset
                                <h4 class="card-title">جدول تقييم نمو الطفل</h4>
                                <p class="card-category">يتم التقييم بالاعتماد على القيم المثالية</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-info">
                                        <th>الشهر</th>
                                        <th>الوزن</th>
                                        <th>تقييم الوزن</th>
                                        <th>الطول</th>
                                        <th>تقييم الطول</th>

                                    </thead>
                                    <tbody>
                                        @foreach ($data as $record)
                                        <tr>
                                            <td>{{  $months[$loop->index]}}</td>
                                            <td>{{$record->weight}} كغ</td>
                                            <td>{{$record->weightEval}}</td>
                                            <td>{{$record->height}} سم</td>
                                            <td>{{$record->heightEval}}</td>


                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
</div>

</div>
@endsection

@push('js')
@include('chart.add-weight')
<script>







  var weight = [3.3 ,4.4 ,5.6,6.4 ,7,7.5,7.9,8.3,8.6,8.9,9.1,9.4];
  var childweight=[]
  var childheight=[]
  @foreach ($data as $child )
  childweight.push({{$child->weight}})
  childheight.push({{$child->height}})
  @endforeach
 var height = [49.8,54.8,58.4,61.4,64,66,67.5,69,70.6,71.8,73.1,74.4];
var userweight=[]
var heightchart=document.getElementById('height')
var weightchart=document.getElementById('weight')
new Chart(heightchart, {
  type: "line",
  options: {
    responsive: true,
        scales: {
            y: {
                ticks: {

                    callback: function(value, index, ticks) {
                        s= value+" cm" ;
                        return s;
                    }
                }
            }
        }
    },


  data: {
    labels: ['الشهر الاول', 'الشهر الثاني', 'الشهر الثالث', 'الشهر الرابع', 'الشهر الخامس', 'الشهر السادس', 'الشهر السابع', 'الشهر الثامن', 'الشهر التاسع', 'الشهر العاشر', 'الشهر الحادي عشر',
            'الشهر الثاني عشر'
        ],
    datasets: [{
        label: 'الطول المثالي',
      data: height,
      borderColor: '#00BCD4' ,
      backgroundColor:  '#00BCD4',
    },
    {
        label: 'طول طفلك',
      data: childheight,
      borderColor: '#FD9710' ,
      backgroundColor:  '#FD9710',
    },

]
  },

});


new Chart(weightchart, {
  type: "line",

  options: {
    responsive: true,
        scales: {
            y: {
                ticks: {

                    callback: function(value, index, ticks) {
                        s= value+" kg" ;
                        return s;
                    }
                }
            }
        }
    },


  data: {
    labels: ['الشهر الاول', 'الشهر الثاني', 'الشهر الثالث', 'الشهر الرابع', 'الشهر الخامس', 'الشهر السادس', 'الشهر السابع', 'الشهر الثامن', 'الشهر التاسع', 'الشهر العاشر', 'الشهر الحادي عشر',
            'الشهر الثاني عشر'
        ],
    datasets: [{
        label: 'الوزن المثالي',
      data: weight,
      borderColor: '#00BCD4' ,
      backgroundColor:  '#00BCD4',
    },
    {
        label: 'وزن طفلك',
      data:childweight,
      borderColor: '#FD9710' ,
      backgroundColor:  '#FD9710',
    },

]
  },


});

</script>
@endpush
