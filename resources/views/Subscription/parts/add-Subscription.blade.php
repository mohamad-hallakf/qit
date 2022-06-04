
    <!-- Modal -->
    <div class="modal fade" id="addmodel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">اضافة اشتراك جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-2 font-weight-bold " id="addForm">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">اسم الاشتراك </span>
                                </div>
                                <input type="text" placeholder="ادخل اسم الاشتراك" name="name" class="form-control ">

                            </div>
                        </div>






                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-lg btn-info h3" req="no" data-dismiss="modal"
                                id="closeAdding">رجوع</button>
                            <button type="button" id="confirmAdding" req="no" class=" h3 btn btn-lg btn-success">موافق</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>

        $(document).on('click', '#confirmAdding', function(e) {

            e.preventDefault();
            e.stopImmediatePropagation();

            var form = document.getElementById('addForm');
            var data = $('#addForm').serialize();


                var data = $('#addForm').serialize();
                $.ajax({
                    url: "{{route('Subscription.store')}}",
                    type: 'post',
                    dataType: 'json',
                    data:data,
                    success: function(data) {
                        if (data.response == true) {
                            Alert(" has been successfully", "success")
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
    </script>
