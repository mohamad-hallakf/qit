<div id="removemodal" class="modal fade" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">

                <h4 class="modal-title"> حذف السؤال</h4>
            </div>
            <div class="modal-body">
                <p class="font-weight-bold">سيتم حذف السؤال بشكل نهائي
                </p>
            </div>
            <div class="modal-footer">    @csrf
                <button type="button" data-id="" id="okDelete" class="btn btn-danger" data-dismiss="modal">موافق</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">رجوع</button>

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
            url: "{{ route('question.destroy') }}" ,
            type: 'post',
            dataType: 'json',
            data:data,
            success: function(data) {
                if (data.response == true) {
                    var table = $('.data-table').DataTable();
                    table.draw();
                    // Alert("Farm has been deleting successfully", "success")
                         $("#removemodel .close").click();
                         $('.modal-backdrop').hide();
                } else {}
            }
        });
        $('#okDelete').attr('data-id', '');

    });
</script>
