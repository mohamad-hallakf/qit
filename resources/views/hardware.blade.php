@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
<style>
    #videoElement {
        width: 500px;
        height: 375px;
        background-color: #1c343f;
    }

    /* The switch - the box around the slider */
    .switch {
        margin-top: 15px;
        margin-left: 2px;
        position: relative;
        display: inline-block;
        width: 55px;
        height: 25px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: -7;
        left: -6;
        right: 2;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 40px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="alert alert-danger h5 text-center" id="alert"> لا يوجد اتصال</div>

            <div class="row " id="control">
                <div class="col-lg-6 col-sm-6">
                    <div class="row">

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow  ">
                                        <i class="fa-solid fa-temperature-three-quarters text-danger"></i>
                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-danger">
                                        <span class="font-mono "> <span id="temp">30</span>  &#176;</span>
                                        <span class=" font-weight-bold text-danger pr-2 h3">درجة الحرارة</span>

                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow  ">
                                        <i class="fa-solid fa-house-medical text-warning"></i>
                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-warning">
                                        <span class="font-mono pr-2 "> 10&#176;</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow  ">
                                        <i class="fa-solid fa-heart-pulse text-danger    "></i>
                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-danger ">
                                        <span class="font-mono pr-2 "> 34&#176;</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow  ">
                                        <i class="fa-solid fa-power-off text-primary" id="fanicon"></i>
                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-primary ">
                                        <label class="switch">
                                            <input type="checkbox" id="fan">
                                            <span class="slider round"></span>
                                        </label>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow">
                                        <i class="fa-solid fa-lightbulb    text-success" id="lighticon"></i>

                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-primary ">
                                        <label class="switch">
                                            <input type="checkbox" id="light">
                                            <span class="slider round"></span>
                                        </label>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats  ">
                                <div class="card-header  card-header-icon mx-auto">
                                    <div class="card-icon rounded-circle mx-auto bg-white shadow  ">
                                        <i class="fa-solid fa-door-closed text-secondary " id="dooricon"></i>
                                    </div>
                                    <h2 class="card-title text-center my-3 pt-2 text-primary ">

                                        <label class="switch">
                                            <input type="checkbox" id="door">
                                            <span class="slider round"></span>
                                        </label>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 my-auto ">
                    <div class="row  ">
                        <div class="row">
                            <div class=" mx-auto ">
                                <video controls autoplay id="videoElement" class="rounded p-1"></video>
                                <div class="mt-2 mx-3" id="imageDiv">

                                    <img src="" alt="" id="im">
                                    <input type="hidden" value="" id="screenshot">


                                </div>

                            </div>

                            <div class="modal-footer justify-content-center m-0 p-0">
                                <a type="button" onclick="saveimage()" class=" h3 btn bg-transparent " title="حفظ الصورة"
                                    id="play"><i class="fa-solid fa-save fa-1x text-warning"></i></a>
                                <button type="button" onclick="getStream('video')" class=" h3 btn bg-transparent "
                                    title="تشغيل البث" id="play"><i
                                        class="fa-solid fa-play fa-1x text-success"></i></button>

                                <button type="button" onclick="stopStream('video')" class=" h3 btn bg-transparent "
                                    title="ايقاف البث" id="stop"><i class="fa-solid fa-stop fa-1x text-danger"></i></button>
                                <button type="button" onclick="capture()" class=" h3 btn bg-transparent "
                                    title="التقاط الصورة"><i
                                        class="fa-solid fa-tablet-screen-button fa-1x text-secondary"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).on("click", '#door', function() {
            var checkBox = document.getElementById("door");
            if (checkBox.checked == true) {
                //turn on the switch
                $('#dooricon').removeClass('fa-door-closed')
                $('#dooricon').addClass('fa-door-open')

                $.ajax({
                    url: "{{ route('openDoor') }}",
                    type: 'get',
                    success: function(data) {}
                });
            } else {
                //turn off the switch
                $('#dooricon').addClass('fa-door-closed')
                $('#dooricon').removeClass('fa-door-open')
                $.ajax({
                    url: "{{ route('closeDoor') }}",
                    type: 'get',
                    success: function(data) {}
                });

            }
        })

        $(document).on("click", '#fan', function() {
            var checkBox = document.getElementById("fan");
            if (checkBox.checked == true) {
                //turn on the switch
                $('#fanicon').removeClass('fa-power-off')
                $('#fanicon').addClass('fa-fan ')


            } else {
                //turn off the switch
                $('#fanicon').addClass('fa-power-off')
                $('#fanicon').removeClass('fa-fan ')

            }
        })

        function getUserMedia(constraints) {

            if (navigator.mediaDevices) {
                var stream = navigator.mediaDevices.getUserMedia(constraints);
                return stream
            }

            var legacyApi = navigator.getUserMedia || navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia || navigator.msGetUserMedia;

            if (legacyApi) {
                return new Promise(function(resolve, reject) {
                    legacyApi.bind(navigator)(constraints, resolve, reject);
                });
            }
        }

        function stopStream(type) {
            const video = document.querySelector('video');
            const mediaStream = video.srcObject;
            const tracks = mediaStream.getTracks();
            tracks[0].stop();
        }

        function getStream(type) {
            if (!navigator.mediaDevices && !navigator.getUserMedia && !navigator.webkitGetUserMedia &&
                !navigator.mozGetUserMedia && !navigator.msGetUserMedia) {
                alert('User Media API not supported.');
                return;
            }

            var constraints = {};
            constraints[type] = true;

            getUserMedia(constraints)
                .then(function(stream) {
                    var mediaControl = document.querySelector(type);

                    if ('srcObject' in mediaControl) {
                        mediaControl.srcObject = stream;
                    } else if (navigator.mozGetUserMedia) {
                        mediaControl.mozSrcObject = stream;
                    } else {
                        mediaControl.src = (window.URL || window.webkitURL).createObjectURL(stream);
                    }

                    mediaControl.play();
                })
                .catch(function(err) {
                    alert('Error: ' + err);
                });
        }

        function capture() {
            let canvas = document.createElement('canvas');
            let video = document.getElementById('videoElement');

            canvas.width = 270;
            canvas.height = 180;

            let ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            let image = canvas.toDataURL('image/jpeg');
            $('#im').attr('src', image)
            $('#imageDiv').show()
        }

        function saveimage() {
            $('#screenshot').val($('#im').attr('src'))
            $('#imageDiv').hide()
        }

        getSensor()

        function getSensor() {
            $.ajax({
                url: "{{ route('sensor') }}",
                type: 'get',
                success: function(data) {
                    if (data.response) {



                       $('#temp').html( data.data.sound)
                        $('#alert').hide()
                        $('#control').show()
                    } else {
                        $('#alert').show()
                        $('#control').hide()
                    }

                }
            });
            setTimeout(getSensor, 3000);
        }
    </script>
@endpush
