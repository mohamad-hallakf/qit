 <!-- Modal -->
 <div class="modal fade" id="editmodal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered" >
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center" id="exampleModalLongTitle">{{ $model_name }}</h5>
                 <button type="button" class="close" data-dismiss="modal" >

                 </button>
             </div>
             <div class="modal-body">
                 <form class="m-2 font-weight-bold " id="editForm">



                    <div class="form-group my-3 form-row text-muted">
                        <h4 for="exampleInput2" class="h4">تغيير حالة السؤال</h4>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input diseases" type="radio" id="inlineRadio1"
                                value="1" name="common" required checked>
                            <label class="form-check-label h4" for="inlineRadio1">شائع</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input diseases" type="radio" id="inlineRadio2"
                                value="0" name="common" required>
                            <label class="form-check-label h4" for="inlineRadio2">غير شائع</label>
                        </div>

                    </div>
                    <input type="hidden" value="" name="id" id="qid">
                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn  btn-info" req="no" data-dismiss="modal"
                            id="closeAdding">{{__('clients.close')}}</button>
                        <button type="button" id="okEdit" req="no" class="btn  btn-danger">{{__('clients.save')}}</button>
                    </div>
                  </form>
             </div>

         </div>
     </div>
 </div>

 <script>
     $(document).on('click', '#okEdit', function(e) {

         e.preventDefault();
         e.stopImmediatePropagation();
         var form = document.getElementById('editForm');

             var data = $('#editForm').serialize();

             $.ajax({
                 url: "{{ route('question.update') }}",
                 type: 'post',
                 dataType: 'json',
                 data: data,

                 success: function(data) {
                     if (data.response == true) {
                         var table = $('.data-table').DataTable();
                         table.draw();
                         Alert("{{$model_name}} has been edit successfully", "success")
                         $("#editmodal .close").click();
                         $('.modal-backdrop').hide();
                     } else {
                         Alert("error message", "danger")
                         $("#editmodal .close").click();
                         $('.modal-backdrop').hide();
                     }
                 }
             });




     });






 </script>
