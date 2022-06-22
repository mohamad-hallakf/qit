@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')


    @if (auth()->user()->role != 'admin')
        <div class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-tabs card-header-warning">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">

                                        <ul class="nav nav-tabs col-12 " data-tabs="tabs">
                                            <li class="nav-item col-6">
                                                <a class="nav-link active " href="#free" data-toggle="tab">
                                                    <i class=" fa-solid fa-cart-shopping fa-2x"></i>
                                                    <span class="h3">خدمات مجانية
                                                    </span>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>
                                            <li class="nav-item col-6">
                                                <a class="nav-link" href="#paid" data-toggle="tab">
                                                    <i class=" fa-solid fa-filter-circle-dollar fa-2x"></i>
                                                    <span class="h3">خدمات مدفوعة
                                                    </span>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="free">
                                        <div class="row">
                                            @foreach ($services as $service)
                                                @if ($service->type == 'free')
                                                    <div class="col-md-4">
                                                        <div class="card card-chart">
                                                            <div class="card-header card-header-success   p-2">


                                                                    <img src="{{ url('hard.jpg') }}"
                                                                        class="rounded"
                                                                        style="width:100%;height: 200px;">


                                                            </div>
                                                            <div class="card-body">
                                                                <h4 class="card-title">{{ $service->name }}</h4>
                                                                <p class="card-category">{{ $service->description }}</p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="stats mx-auto">
                                                                    <a type="button" class="btn btn-outline-success"
                                                                        href="{{ $service->link }}">
                                                                        <i class="fa-solid fa-right-to-bracket   mx-2"></i>
                                                                        <span class="h5"> تصفح الخدمة </span>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="paid">
                                        <div class="row">
                                            @foreach ($services as $service)
                                                @if ($service->type == 'paid')
                                                    <div class="col-md-4">
                                                        <div class="card card-chart">
                                                            <div class="card-header card-header-danger   p-2">


                                                                    <img src="{{ url('hard.jpg') }}"
                                                                        class="rounded"
                                                                        style="width:100%;height: 200px;">

                                                            </div>
                                                            <div class="card-body">
                                                                <h4 class="card-title">{{ $service->name }}</h4>
                                                                <p class="card-category">{{ $service->description }}</p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="stats mx-auto">
                                                                    <a type="button"
                                                                        class="btn btn-outline-danger paidservice" href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#servicesubscription"
                                                                        data-id="{{ $service->id }}">
                                                                        <i class="fa-solid fa-right-to-bracket   mx-2"></i>
                                                                        <span class="h5">اشتراك</span>
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade border  border border-danger rounded" id="servicesubscription" tabindex="-1"
                        role="dialog">
                        <div class="modal-dialog   " role="document">
                            <div class="card">
                                <div class="modal-content">

                                    <div class="card-header card-header-danger">
                                        <h3 class="card-title">اشتراك بالخدمة</h3>
                                        <p class="card-category h5">ادخل المعلومات اللازمة للاشتراك </p>
                                    </div>

                                    <form id="addservicesubscription" method="POST"
                                        action="{{ route('ChildSub.store') }}" enctype="multipart/form-data"
                                        class="text-dark">
                                        @csrf
                                        <div class="card-body ">



                                            <div class="form-group my-2 input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">اختر الطفل</span>
                                                </div>

                                                @if ($children != '[]')
                                                    <select class="form-select form-control text-center" name='childid'
                                                        required>
                                                        @foreach ($children as $child)
                                                            <option selected value="{{ $child->id }}">
                                                                {{ $child->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <div class="stats mx-auto">
                                                        <a type="button" class="btn btn-outline-success"
                                                            href="{{ route('child.mychildren') }}">
                                                            <i class="fa-solid fa-right-to-bracket   mx-2"></i>
                                                            <span class="h5">ادخل معلومات طفلك اولا</span>
                                                        </a>

                                                    </div>
                                                @endif

                                            </div>

                                            @if ($children != '[]')
                                                <div class="form-group my-2 input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id=""> نوع الاشتراك</span>
                                                    </div>
                                                    <select class="form-select form-control text-center" name='subid'
                                                        required>
                                                    </select>
                                                </div>
                                            @endif
                                            <input type="hidden" name="serviceid" id="serviceid">


                                            <div id="hardwareService">
                                                <div class="form-group my-4 input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text h4" id="">اختر الاجهزة</span>
                                                    </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                كاميرا
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault1">
                                                            <label class="form-check-label" for="flexCheckDefault1">
                                                                مراقبة حركة
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckChecked2">
                                                            <label class="form-check-label" for="flexCheckChecked2">
                                                                مراقبة صوت
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckChecked3">
                                                            <label class="form-check-label" for="flexCheckChecked3">
                                                                مراقبة حرارة ورطوبة
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckChecked4">
                                                            <label class="form-check-label" for="flexCheckChecked4">
                                                                التحكم بالاضاءة
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckChecked5">
                                                            <label class="form-check-label" for="flexCheckChecked5">
                                                                التحكم بالتكييف
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckChecked6">
                                                            <label class="form-check-label" for="flexCheckChecked6">
                                                                التحكم بالنافذة
                                                            </label>
                                                        </div>

                                                </div>
                                                <p>

                                                    <button class="btn btn-outline-secondary h5 p-1 float-left"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseExample" aria-expanded="false"
                                                        aria-controls="collapseExample">تفاصيل
                                                    </button>
                                                </p>
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <p class="font-weight-bold h4">
                                                            نقدم لكم في هذه السطور نظرة سريعة لتوضيح كيفية الاستفادة من هذه
                                                            الأجهزة
                                                            وتحقيق الاستخدام الأمثل لها...</p>
                                                        <p> 1..كاميرا..وفيها يتم مراقبة الطفل بحيث يصبح الأهل على دراية
                                                            كاملة
                                                            بكافة
                                                            تحركاته لإتخاذ الإجراءات المناسبة في حال حدوث أي داعي لذلك</p>
                                                        <p> 2..جهاز مراقبة الحركة..حيث يتم تحديد مسافة آمنة للطفل من خلال
                                                            هذا
                                                            الجهاز
                                                            وفي حال تم تجاوز هذه المسافة من قبل الطفل فيتم إصدار إنذار
                                                            لتنبيه
                                                            الأهل
                                                            لحماية الطفل من أي اصطدام تفاديا لأي أذى جسدي يمكن أن ينتج عن
                                                            حركته
                                                        </p>
                                                        <p>
                                                            3..جهاز تحكم بالمحيط..يقوم بفتح نوافذ الغرفة في الصباح لتأمين
                                                            بيئة
                                                            صحية
                                                            للطفل من حيث هواء وأشعة الشمس وما ضمن ذلك ثم يقوم بإغلاقها بعد
                                                            فترة
                                                            معينة يتم تحديدها مسبقا</p>
                                                        <p> 4..جهاز مراقبة الصوت..يتم من خلاله التحسس لوجود صوت صادر عن
                                                            الطفل
                                                            حيث
                                                            يتم تشغيل إضاءة في حال التحسس لأي صوت
                                                            ...وننوه إلى أنه في جميع الأجهزة السابقة يتم التحكم بها من قبل
                                                            آدمن
                                                            التطبيق وكذلك يقوم باتخاذ الإجراءات المناسبة في حال حدوث أي طارئ
                                                            تبعا
                                                            للجهاز المستخدم</p>

                                                        <p class="font-weight-bold h5">
                                                            ومن المؤكد أننا نراعي خصوصية المستخدم حيث يمكن إيقاف جميع
                                                            الأجهزة
                                                            السابقة بمحرد فصل التيار الكهربائي عنها</p>
                                                    </div>
                                                </div>


                                            </div>


                                        </div>
                                        <div class="card-footer ml-auto mr-auto">
                                            @if ($children != '[]')
                                                <button type="submit" class="btn btn-danger mx-auto ">حفظ</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @elseif(auth()->user()->role == 'admin')
        <div class="content">
            <div class="row justify-content-center">
                <div class="card card-stats col-3 mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-child   text-success" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-primary ">
                        عدد الاطفال: {{ $childrens->count() }}
                    </h4>
                </div>
                <div class="card card-stats col-3  mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-star   text-warning" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-primary ">
                        عدد الخدمات: {{ $services->count() }}
                    </h4>
                </div>
                <div class="card card-stats col-3  mx-3 ">
                    <div class="card-header  card-header-icon mx-auto">
                        <div class="card-icon rounded-circle mx-auto bg-white shadow mb-2">
                            <i class="fa-solid fa-user   text-info" id="lighticon"></i>
                        </div>
                    </div>
                    <h4 class="card-footer text-center mx-auto   text-primary ">
                        عدد المستخدمين: {{ $users->count() }}
                    </h4>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script>
        //   demo.initDocumentationCharts();
        function chart() {
            if ($('#dailySalesChart').length != 0 && $('#websiteViewsChart').length != 0) {
                /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

                dataDailySalesChart = {
                    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
                    series: [
                        [12, 17, 7, 17, 23, 18, 38],


                    ]
                };


                newDailySalesChart = {
                    series: ['M', 'T', 'W', 'T', 'M', 'T', 'W', 'T', 'F', 'S', 'j', 'F', 'S', 'S', 'F', 'S', 'j', 'F',
                        'S', 'S'
                    ],
                    series: [
                        [12, 7, 17, 2, 2, 7, 17, 2, 3, 38, 17, 7, 17, 2, 2, 7, 17, 2, 3, 38],
                    ]
                };

                optionsDailySalesChart = {
                    lineSmooth: Chartist.Interpolation.cardinal({
                        tension: 0
                    }),


                    low: 0,
                    fullWidth: true,
                    showLabel: true,
                    high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                    chartPadding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                    showLine: false,

                }

                var dailySalesChart = new Chartist.Line('#dailySalesChart', newDailySalesChart, optionsDailySalesChart);

                // var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
            }
        }
        chart()
        $(document).ready(function() {
            $(document).on("click", ".paidservice", function(e) {

                var id = $(this).attr("data-id")
                if (id != 2)
                    $('#hardwareService').hide()
                else
                    $('#hardwareService').show()
                $("#addservicesubscription #serviceid").val(id)
                $("#addservicesubscription select[name= subid]").html("")
                data = {
                    'id': id
                }
                $.ajax({
                    url: "{{ route('Subscription.subsType') }}",
                    type: 'post',
                    dataType: 'json',
                    data,
                    data,
                    success: function(data) {
                        if (data.response == true) {

                            $.each(data.data, function(index, value) {

                                $("#addservicesubscription select[name= subid]").append(
                                    '  <option value="' + value.id + '">' + value
                                    .name + " كلفة الاشتراك " + value.price +
                                    '</option>'
                                )

                            });

                        } else {}
                    }
                });
            })

        });
    </script>
@endpush
