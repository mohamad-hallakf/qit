<div id="removemodal" class="modal fade" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="card">
            <div class="modal-content" >
                    <div class="card-header card-header-primary">
                    <h4 class="card-title text-center">{{ __('delete') }} {{ $model_name }}</h4>
                </div>

            <div class="modal-body h5 text-center">
                <p class="font-weight-bold">{{ __('It will be permanently deleted Are you sure?') }}
                </p>
            </div>
            <div class="modal-footer">    @csrf
                <button type="button" data-id="" id="okDelete" class="btn btn-danger" data-dismiss="modal">{{ __('ok') }}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('cancel') }}</button>

            </div>
        </div>

        </div>

    </div>
</div>
<script>
    $(document).on('click', '.delete', function() {
        $('#okDelete').attr('data-id', $(this).attr('data-id'));
    });
    $(document).on('click', '#okDelete', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var id = $(this).attr('data-id');
        data={'id':id}
        $.ajax({
            url: "{{ route('user.destroy') }}" ,
            type: 'post',
            dataType: 'json',
            data:data,
            success: function(data) {
                if (data.response == true) {
                    var table = $('.data-table').DataTable();
                    table.draw();
                     Alert("{{ $model_name }} has been deleted successfully", "success")
                         $("#removemodel .close").click();
                         $('.modal-backdrop').hide();
                } else {
                    Alert("error", "dange")

                }
            }
        });
        $('#okDelete').attr('data-id', '');

    });
</script>
