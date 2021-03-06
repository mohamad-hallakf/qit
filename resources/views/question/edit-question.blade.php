 <div class="modal fade" id="editmodal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
         <div class="card">
             <div class="modal-content">
                 <div class="card-header card-header-primary">
                     <h4 class="card-title text-center">{{ __('delete') }} {{ $model_name }}</h4>
                 </div>
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">
                     </button>
                 </div>
                 <div class="modal-body">
                     <form class="m-2 font-weight-bold " id="editQuestion">

                         <div class="form-group mb-3">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="">{{ __('question') }}</span>
                                 </div>
                                 <input type="text" placeholder="{{ __('question content') }}" name="content"
                                     class=" form-control ">

                             </div>
                         </div>

                         <div class="form-group mb-3">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="">{{ __('right ans') }}</span>
                                 </div>
                                 <input type="text" placeholder="{{ __('right answer') }}" name="right"
                                     class=" form-control ">

                             </div>
                         </div>
                         <div class="form-group mb-3">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="">{{ __('wrong 1') }}</span>
                                 </div>
                                 <input type="text" placeholder="{{ __('wrong1') }}" name="wrong1"
                                     class=" form-control ">

                             </div>
                         </div>
                         <div class="form-group mb-3">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="">{{ __('wrong 2') }}</span>
                                 </div>
                                 <input type="text" placeholder="{{ __('wrong2') }}" name="wrong2"
                                     class=" form-control ">

                             </div>
                         </div>
                         <div class="form-group mb-3">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="">{{ __('wrong 3') }}</span>
                                 </div>
                                 <input type="text" placeholder="{{ __('wrong3') }}" name="wrong3"
                                     class=" form-control ">

                             </div>
                         </div>



                         <div class="modal-footer justify-content-center">
                             <button type="button" class="btn  btn-danger" req="no" data-dismiss="modal"
                                 id="cancel ">{{ __('close') }}</button>
                             <button type="button" id="okEdit" req="no"
                                 class="btn  btn-success">{{ __('save') }}</button>
                         </div>
                         <input type="hidden" id="theID" req="no" name="id" />
                     </form>
                 </div>

             </div>
         </div>

     </div>
 </div>

 <script>
     $(document).on('click', '#okEdit', function(e) {
         e.preventDefault();
         e.stopImmediatePropagation();
         var form = document.getElementById('editQuestion');
         var valid = formValidtor("editQuestion", ["content", "right", "wrong1", "wrong2", "wrong3"])

         var data = $('#editQuestion').serialize();
         if (valid == 0) {
             $.ajax({
                 url: "{{ route('question.update') }}",
                 type: 'post',
                 dataType: 'json',
                 data: data,

                 success: function(data) {
                     if (data.response == true) {
                         var table = $('.data-table').DataTable();
                         table.draw();
                         Alert("{{ $model_name }} has been edit successfully", "success")
                         $("#editmodal .close").click();
                         $('.modal-backdrop').hide()


                     } else {
                         Alert("error message", "danger")
                         $("#editmodal .close").click();
                         $('.modal-backdrop').hide();
                     }
                 }
             });

         }




     });
 </script>
