<!-- Modal -->

<div class="modal fade    border    border-primary rounded" id="addmodel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-primary">
                    <h4 class="card-title text-center">add {{ $model_name }}</h4>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-2 font-weight-bold " id="addForm">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">{{ __('name') }}</span>
                                </div>
                                <input type="text" placeholder="{{ __('name') }}" name="name"
                                    class=" form-control ">

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">{{ __('username') }}</span>
                                </div>
                                <input type="text" placeholder="{{ __('username') }}" name="username"
                                    class=" form-control ">

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">{{ __('email') }}</span>
                                </div>
                                <input type="email" placeholder="{{ __('email') }}" name="email"
                                    class=" form-control ">

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">{{ __('password') }}</span>
                                </div>
                                <input type="password" placeholder="{{ __('password') }}" name="password"
                                    class=" form-control ">

                            </div>
                        </div>



                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-lg btn-danger py-2" data-dismiss="modal"
                                id="closeAdding">{{ __('close') }}</button>
                            <button type="button" id="confirmAdding"
                                class="btn btn-lg btn-success  py-2">{{ __('save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).on('click', '#confirmAdding', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();
         var valid = formValidtor("addForm", ["name","username", "email", "password"])

        var data = $('#addForm').serialize();
        if(valid == 0){
                 $.ajax({
            url: "{{ route('user.store') }}",
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(data) {
                if (data.response == true) {

                    $("#addmodel .close").click();
                    $('.modal-backdrop').hide();
                     Alert("{{ $model_name }} has been added successfully", "success")

                    var table = $('.data-table').DataTable();

                    table.draw();
                } else {
                    Alert("error message", "danger")
                    $("#addmodel .close").click();
                    $('.modal-backdrop').hide();
                }
            }
        });
}




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
</script>
