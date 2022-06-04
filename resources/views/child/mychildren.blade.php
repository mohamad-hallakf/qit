@extends('layouts.app', ['activePage' => 'mychildren' ])
@section('content')
    <div class="content">

        <div class="container-fluid">



            <center>


                <!-- Button trigger modal -->
                <span data-toggle="tooltip" data-placement="auto" class="  h3   mx-auto    mx-auto  ">

                    <button type="button" class="btn btn-success p-2 rounded " data-toggle="modal" data-target="#addchild"
                        id='internalAdding'>
                        <i class="fas fa-plus-circle fa-2x"></i> <span class="h3"> اضافة طفل </span>
                    </button>

                </span>

            </center>

            <div class="row text-center mt-5">
                @foreach ($children as $child)
                    <div class="col-md-4 mt-5">
                        <div class="card  mx-auto  ">
                            <div class=" @if ($child->gender == 'male') card-header-info @else card-header-primary @endif   rounded-circle mx-auto "
                                style="margin-top:-85px ">

                                @if ($child->image)
                                    <img src="{{ asset('storage/' . $child->image) }}" class="rounded-circle"
                                        style="width: 150px; height: 150px;">
                                @else
                                    <img src="{{ asset('material/img/ex1.png') }}" class="rounded-circle    "
                                        style="width: 100px; height: 150px;">
                                @endif

                            </div>

                            @php
                                $year=date('Y')- date('Y', strtotime($child->dateofbirth)) ;
                                $month= date('m')-date('m', strtotime($child->dateofbirth));
                            @endphp
                            <div class="card-body">
                                <h3 class="card-title">{{ $child->name }}</h3>
                                <p class="card-category h4 text-success">
                                    @if ($year>0)
                                    {{$year}}  سنة
                                    @endif
                                    @if ($month>0)
                                    {{$month}} شهر
                                    @endif
                                    {{ date('d') -date('d', strtotime($child->dateofbirth)) }} يوم </p>
                            </div>
                            @foreach ($services as $service)
                                @if ($service->childid == $child->id)
                                    <div class="card-footer mt-0 pt-0">
                                        <hr class="bg-secondary">
                                        <div class=" text-muted mx-auto ">
                                            <hr>
                                            <h3>الخدمات</h3>
                                            <span class="h4"> الخدمة : {{ $service->servicename }}</span>
                                            <span class="h5  "> ... </span>
                                            <span class="h4"> المدة : {{ $service->duration }}</span>
                                            <a type="button" class="btn btn-outline-success"
                                              @if ($service->servicename=="مراقبة النمو")
                                                  href={{ route('Chart.child', $child->id) }}>
                                              @endif
                                                <i class="fa-solid fa-right-to-bracket   mx-2"></i>
                                                <span class="h5"> تصفح الخدمة </span>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
            </div>
        </div>
        @endforeach


    </div>


    <!-- Modal -->
    <div class="modal fade border  border border-success rounded" id="addchild" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  " role="document">
            <div class="card">
                <div class="modal-content">

                    <div class="card-header card-header-success">
                        <h3 class="card-title">اضافة طفل</h3>
                        <p class="card-category h5">ادخل معلومات الطفل </p>
                    </div>
                    <form id="adduser" method="POST" action="{{ route('child.store') }}" enctype="multipart/form-data"
                        class="text-dark">
                        @csrf
                        <div class="card-body ">

                            <div class="form-group my-2 form-row">
                                <label for="exampleInputname" class="h4">الاسم</label>
                                <input type="text" class="form-control" id="exampleInputname" name="name" required>

                            </div>



                            <div class="form-group my-4 form-row text-muted">
                                <label for="exampleInputnamew" class="h4">الجنس</label>


                                <div class="form-check form-check-inline">
                                    <input class="form-check-input " type="radio" id="inline2" value="male" name="gender">
                                    <label class="form-check-label h4" for="inline2">ذكر</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input " type="radio" id="inline3" value="female" name="gender">
                                    <label class="form-check-label h4" for="inline3">انثى</label>
                                </div>

                            </div>


                            <div class="form-group my-2 form-row text-muted ">
                                <label for="exampleInput4" class="h4 ">الصورة</label>
                                <input type="file" name="image" class="form-control  " id="exampleInput4" required>

                            </div>
                            <div class="form-group my-2 form-row">
                                <label for="exampleInput1" class="h4 ">تاريخ الميلاد</label>
                                <input type="date" class="form-control text-center" id="exampleInput1" name="dateofbirth"
                                    required>

                            </div>


                            <div class="form-group my-2 form-row text-muted">
                                <h4 for="exampleInput2" class="h4">هل يعاني من هذه الامراض ؟</h4>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input diseases" type="checkbox" id="inlineRadio1" value="3"
                                        name="down">
                                    <label class="form-check-label h4" for="inlineRadio1">متلازمة داون</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input diseases" type="checkbox" id="inlineRadio2" value="1"
                                        name="paralysis">
                                    <label class="form-check-label h4" for="inlineRadio2">شلل الاطفال</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input diseases" type="checkbox" id="inlineRadio3" value="2"
                                        name="autism">
                                    <label class="form-check-label h4" for="inlineRadio3">التوحد</label>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-success mx-auto save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function populate() {


        });
    </script>
@endpush
