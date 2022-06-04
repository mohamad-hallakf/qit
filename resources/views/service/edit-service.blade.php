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

                    <div class="form-group my-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">{{__('tr.name')}}</span>
                            </div>
                            <input type="text" placeholder="{{__('tr.name')}}" name="name" class="form-control ">


                        </div>
                    </div>

                    <div class="form-group my-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">{{__('tr.type')}}</span>
                            </div>
                            <input type="text" placeholder="{{__('tr.type')}}" name="type" class="form-control ">


                        </div>
                    </div>

                    <div class="form-group my-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">{{__('tr.description')}}</span>
                            </div>
                            <input type="text" placeholder="{{__('tr.description')}}" name="description" class="form-control ">


                        </div>
                    </div>


                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn  btn-danger" req="no" data-dismiss="modal"
                            id="closeAdding">{{__('tr.close')}}</button>
                        <button type="button" id="okEdit" req="no" class="btn  btn-success">{{__('tr.save')}}</button>
                    </div>
                     <input type="hidden" id="theID" req="no" name="id" />
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
         var isvalidate = true;


         for (I = 0; I < form.length; I++) {
             $(form[I]).removeClass('is-invalid')
             $(form[I]).removeClass('is-valid')

         }

         // validate all feilds
         for (I = 0; I < form.length; I++) {
             var Req = form[I].getAttribute('req');
             var Value = form[I].value;
             if (Value == "") {
                 if (Req != "no") {
                     $(form[I]).addClass('is-invalid')

                 } else
                     $(form[I]).addClass('is-valid')

             } else
                 $(form[I]).addClass('is-valid')

         }
         // validate unique feilds
         for (I = 0; I < form.length; I++) {
             if ($(form[I]).attr('type') == 'email') {

                 if (IsEmail($(form[I]).val()))
                     $(form[I]).addClass('is-valid')
                 else
                     $(form[I]).addClass('is-invalid')

             }
             if ($(form[I]).attr('type') == 'number' && Req != "no") {
                 if (IsNumber($(form[I]).val()))
                     $(form[I]).addClass('is-valid')
                 else
                     $(form[I]).addClass('is-invalid')
             }
             if($(form[I]).val()=='noselect'){
                $(form[I]).addClass('is-invalid')
            }

                else{
                    $(form[I]).addClass('is-valid')
                }

         }
         // check if the form is ready to ajax call
         for (I = 0; I < form.length; I++) {
             if ($(form[I]).hasClass('is-invalid')) {
                 isvalidate = false;

             }
         }
         if (isvalidate) {
             var data = $('#editForm').serialize();

             $.ajax({
                 url: "{{ route('service.update') }}",
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

         }


     });
     $(document).on('click', '#closeedit', function(e) {
         e.preventDefault();
         e.stopImmediatePropagation();

         var form = document.getElementById('editForm');
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
