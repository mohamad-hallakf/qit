@extends('layouts.app', ['activePage' => 'mychildren' ])
@section('content')
    <div class="content">

        <div class="container-fluid">

            <div class="   rounded pb-0  col-6 align-items-center">


                <!-- Button trigger modal -->
                <span data-toggle="tooltip" data-placement="auto" class=" mb-4 h3   mx-auto   my-0 py-0  mx-auto">

                    <button type="button" class="btn btn-success p-2 rounded " data-toggle="modal" data-target="#addchild"
                        id='internalAdding'>
                        <i class="fas fa-plus-circle fa-2x"></i> <span class="h3"> اضافة طفل </span>
                    </button>

                </span>

            </div>


            <div class="row text-center mt-5">
                @foreach ($children as $child)
                    <div class="col-md-4 mt-5">
                        <div class="card  mx-auto  ">
                            <div class=" card-header-success  rounded-circle mx-auto "  style="margin-top:-85px " >

                                @if ($child->image)
                                    <img src="{{ asset('storage/' . $child->image) }}" class="rounded-circle"
                                        style="width: 150px; height: 150px;">
                                @else
                                    <img src="{{ asset('material/img/ex1.png') }}" class="rounded-circle    "
                                        style="width: 100px; height: 150px;">
                                @endif

                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $child->name }}</h4>
                                <p class="card-category h4 text-success"> {{ date('Y',strtotime($child->dateofbirth))-date('Y') }} سنة {{ date('m',strtotime($child->dateofbirth))-date('m') }} شهر {{ date('d',strtotime($child->dateofbirth))-date('d') }} يوم</p>
                            </div>
                            <div class="card-footer">
                                <div class="stats mx-auto">
                                    <button type="button" class="btn btn-outline-success">
                                        <i class="fa-solid fa-right-to-bracket   mx-2"></i>
                                        <span class="h6">go to
                                            child </span>
                                    </button>

                                </div>
                            </div>
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
                            <form id="adduser" method="POST" action="{{ route('child.store') }}"
                                enctype="multipart/form-data" class="text-dark">
                                @csrf
                                <div class="card-body ">

                                    <div class="form-group my-2 form-row">
                                        <label for="exampleInputname" class="h4">الاسم</label>
                                        <input type="text" class="form-control" id="exampleInputname" name="name"
                                            required>

                                    </div>
                                    <div class="form-group my-2 form-row text-muted ">
                                        <label for="exampleInput4" class="h4 ">الصورة</label>
                                        <input type="file" name="image" class="form-control  " id="exampleInput4" required>

                                    </div>
                                    <div class="form-group my-2 form-row">
                                        <label for="exampleInput1" class="h4 ">تاريخ الميلاد</label>
                                        <input type="date" class="form-control text-center" id="exampleInput1"
                                            name="dateofbirth" required>

                                    </div>


                                    <div class="form-group my-2 form-row text-muted">
                                        <h4 for="exampleInput2" class="h4">هل يعاني من هذه الامراض ؟</h4>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input diseases" type="checkbox" id="inlineRadio1"
                                                value="3" name="down">
                                            <label class="form-check-label h4" for="inlineRadio1">متلازمة داون</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input diseases" type="checkbox" id="inlineRadio2"
                                                value="1" name="paralysis">
                                            <label class="form-check-label h4" for="inlineRadio2">شلل الاطفال</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input diseases" type="checkbox" id="inlineRadio3"
                                                value="2" name="autism">
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
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function populate() {


        });
    </script>
@endpush
