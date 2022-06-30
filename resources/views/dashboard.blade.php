@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    @if (auth()->user()->role != 'admin')
        <div class="content">

            <div class="container-fluid">
                <div class="row">
                    @foreach ($tests as $test)
                        <div class="col-md-4 mx-auto">
                            <div class="card card-chart">
                                <div class="card-header card-header-info">
                                    <h4 class="card-title text-center"> {{ $test->name }} </h4>

                                </div>
                                <div class="card-body row">
                                    @if (!auth()->user()->testApplied($test->id))
                                        <a class="btn btn-outline-info  "
                                            href="{{ route('test.apply', ['id' => $test->id]) }}">{{ __('start test') }}
                                        </a>
                                    @else
                                    @php
                                        $TestResult=auth()->user()->test($test->id)
                                    @endphp
                                        <div class="text-center">
                                            <h3>Result : <span class="@if($TestResult->result=='success') text-success @else text-danger @endif">{{ $TestResult->result }}</span> </h3>
                                            <h3>Mark : <span  class="@if($TestResult->result=='success') text-success @else text-danger @endif">{{ $TestResult->mark }}</span> </h3>
                                            <h3>Data : <span  class="text-muted">{{ $TestResult->date }}</span></h3>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach




                </div>

            </div>
        </div>
    @elseif(auth()->user()->role == 'admin')
        <div class="content">
            <div class="row justify-content-center">

                <div class="card card-stats col-3  mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-star   text-warning" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-warning ">
                        Questions: {{ $questions->count() }}
                    </h4>
                </div>
                <div class="card card-stats col-3  mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-pen   text-success" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-success ">
                        Tests: {{ $tests->count()}}
                    </h4>
                </div>

                 <div class="card card-stats col-3  mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-user   text-info" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-info ">
                        Student: {{ $users->count() -1}}
                    </h4>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
@endpush
