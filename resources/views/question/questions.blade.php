@extends('layouts.app', ['activePage' => 'questions' ])
@section('content')
    <div class="content">

        <div class="container-fluid mr-0">



            <center>


                <!-- Button trigger modal -->
                <span data-toggle="tooltip" data-placement="auto" class="  h3   mx-auto    mx-auto  ">

                    <button type="button" class="btn btn-info p-2 rounded " data-toggle="modal" data-target="#addchild"
                        id='internalAdding'>
                        <i class="fas fa-plus-circle fa-2x"></i> <span class="h3"> اضافة سؤال </span>
                    </button>

                </span>

            </center>
            @foreach ($questions as $question)
                @if ($question->userid!==auth()->user()->id && $question->privacy=="private"  && auth()->user()->role=="user" )
                    <P></P>

                @else
                @if($question->status==0)
                <div class="row mx-5  " style="margin-right: 0rem !important;">

                    <div class="card p-0 ">
                        <div class="card-header w-100 border-bottom text-white bg-info pb-0 ">

                            <h4 class="float-right">{{ $question->user->name }}</h4>
                            <span class="text-center ml-3 float-left">
                                @if ($question->privacy=="private")
                                <i class=" fa-solid fa-lock" data-toggle="tooltip" title="لا يستطيع العامة رؤية هذا السؤال" ></i>
                                @else
                                <i class="fa-solid fa-earth-americas" data-toggle="tooltip" title="هذا السؤال عام" ></i>
                                @endif
                            </span>
                            <h5 class="float-left"> تاريخ النشر : {{ $question->updated_at->diffForHumans() }}  </h5>

                        </div>

                        <div class="card-body col-12">
                            <div class="col-3 float-left border-right">
                                @if ($question->image)
                                    <img src="{{ asset('storage/' . $question->image) }}" class=""
                                        style="width: 200px; height: 200px;">
                                @else
                                    <img src="{{ asset('material/img/question.jpg') }}" class="    "
                                        style="width: 200px; height: 150px;">
                                @endif
                            </div>
                            <div class="col-9">
                                <h3 class="float-right">{{ $question->content }}</h3>
                            </div>

                        </div>




                        @foreach ($question->answers as $answer)

                                <div class=" text-white rounded"
                                    style="background-image: linear-gradient(120deg, #0e5d68 0%, #0e5d68 100%);">
                                    <div class="  w-100 border-5 border-top px-5 pt-3">

                                        <div class=" row w-100  ">
                                            <h4 class="float-right col-6 "> الدكتور : {{ $answer->user->name}}</h4>
                                            <h5 class=" float-left col-6 text-start">تاريخ الرد :
                                                {{ $answer->updated_at->diffForHumans() }}      </h5>
                                        </div>

                                    </div>
                                </div>
                                <h4 class="text-muted p-3 rounded  w-75 mx-auto">
                                    {{ $answer->content }}

                                </h4>

                        @endforeach
                                @if (auth()->user()->role=="user" )
                                <p></p>
                                @elseif (auth()->user()->role=="doctor")
                        <div class="  w-100 border-top ">
                            <div class="form-group my-2 form-row">
                                <form id="adduser" method="POST" action="{{ route('question.answer') }}"
                                    enctype="multipart/form-data" class="text-dark">
                                    @csrf
                                    <div class="form-group my-2  row">
                                        <button type="submit" class="btn btn-info col-2 mt-1 ml-5 ">موافق</button>
                                        <textarea type="text" class="form-control col-9 w-75 m-1 border-1 border-info"
                                            id="exampleInputname" name="answer" placeholder="اكتب تعليق ...."
                                            required></textarea>

                                    </div>
                                    <input type="hidden" value="{{ $question->id }}" name="questionid">
                                </form>

                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                @endif
                @endif
            @endforeach

            <!-- Modal -->
            <div class="modal fade border  border border-info rounded" id="addchild" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  " role="document">
                    <div class="card">
                        <div class="modal-content">

                            <div class="card-header card-header-info">
                                <h3 class="card-title">اضافة سؤال</h3>
                                <p class="card-category h5">ادخل معلومات السؤال </p>
                            </div>
                            <form id="adduser" method="POST" action="{{ route('question.store') }}"
                                enctype="multipart/form-data" class="text-dark">
                                @csrf
                                <div class="card-body ">

                                    <div class="form-group my-2 form-row">
                                        <label for="exampleInputname" class="h4">نص السؤال</label>
                                        <textarea type="text" class="form-control" id="exampleInputname" name="content"
                                            required></textarea>

                                    </div>
                                    <div class="form-group my-2 form-row text-muted ">
                                        <label for="exampleInput4" class="h4 ">صورة للحالة</label>
                                        <input type="file" name="image" class="form-control  " id="exampleInput4">

                                    </div>



                                    <div class="form-group my-3 form-row text-muted">
                                        <h4 for="exampleInput2" class="h4">هل توافق على ان يتمكن الجميع من رؤية
                                            السؤال ؟</h4>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input diseases" type="radio" id="inlineRadio1"
                                                value="public" name="privacy" required>
                                            <label class="form-check-label h4" for="inlineRadio1">نعم</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input diseases" type="radio" id="inlineRadio2"
                                                value="private" name="privacy" required>
                                            <label class="form-check-label h4" for="inlineRadio2">لا</label>
                                        </div>

                                    </div>


                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <button type="submit" class="btn btn-info mx-auto save h3 py-1">موافق</button>
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
