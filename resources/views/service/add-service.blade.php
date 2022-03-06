<!-- Modal -->

<div class="modal fade" id="addmodel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">اضافة خدمة</h5>
                <button type="button" class="close" data-dismiss="modal">

                </button>
            </div>
            <div class="modal-body">
                <form class="m-2 font-weight-bold " id="addForm" enctype="multipart/form-data"  method="post" action="{{route('service.store')}}">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">{{ __('tr.name') }}</span>
                            </div>
                            <input type="text" placeholder="{{ __('tr.name') }}" name="name" class="@error('name') is-invalid @enderror form-control ">


                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text mr-3" id="">اختر النوع</span>
                            <input type="radio" class="btn-check" name="type" id="success-outlined" value="free"
                                checked>
                            <label class="btn btn-outline-success" for="success-outlined">مجانية</label>

                            <input type="radio" class="btn-check" name="type" id="danger-outlined" value="paid">
                            <label class="btn btn-outline-danger" for="danger-outlined">مدفوعة</label>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">{{ __('tr.description') }}</span>
                            </div>
                            <textarea type="text" placeholder="{{ __('tr.description') }}" name="description"
                                class="form-control "></textarea>


                        </div>
                    </div>

                    <div class="input-group mb-3">اختر صورة
                        <input type="file" name="image" class="form-control mx-2" id="img">

                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-lg btn-danger py-2" data-dismiss="modal"
                            id="closeAdding">{{ __('tr.close') }}</button>
                        <button type="submit" id="confirmAdding"
                            class="btn btn-lg btn-success  py-2">{{ __('tr.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click', '#internalAdding', function(e) {})
    $(document).on('submit', '#addFormsad', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();


        // var data = $('#addForm').serialize();

        // console.log(data)
        $.ajax({
            url: "{{ route('service.store') }}",
            type: 'post',
            dataType: 'json',
            data: new FormData(this),
            success: function(data) {
                if (data.response == true) {

                    $("#addmodel .close").click();
                    $('.modal-backdrop').hide();

                    var table = $('.data-table').DataTable();

                    table.draw();
                } else {
                    Alert("error message", "danger")
                    $("#addmodel .close").click();
                    $('.modal-backdrop').hide();
                }
            }
        });




    });
    $(document).on('click', '#closeAdding', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var form = document.getElementById('addForm');
        for (I = 0; I < form.length; I++) {
            $(form[I]).removeClass('is-invalid')
            $(form[I]).removeClass('is-valid')
            $(form[I]).val('')
        }
    });

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    function IsNumber(number) {
        return Number.isInteger(number);
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip('enable');
    });
</script>
