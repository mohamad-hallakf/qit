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
                     <form class="m-2 font-weight-bold " id="editForm">
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
         var form = document.getElementById('editForm');
         var valid = formValidtor("editForm", ["name", "username", "email"])
         var data = $('#editForm').serialize();
         if (valid == 0) {
             $.ajax({
                 url: "{{ route('user.update') }}",
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
