 <!-- Modal -->
 <div class="modal fade" id="linkmodal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered" >
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title text-center" id="exampleModalLongTitle">ربط الخدمة مع الاشتراكات</h3>
                 <button type="button" class="close" data-dismiss="modal" >

                 </button>
             </div>
             <div class="modal-body">
                 <form class="m-2 font-weight-bold " id="linkForm">

                    <div class="form-group my-2 form-row text-muted">
                        <h4 for="exampleInput2" class="h4">اختر نوع الاشتراك الذي تريد اضافته للخدمة</h4>

                            @foreach ($subscriptions as $sub)


                        <div class="input-group mb-3">

                            <span class="input-group-text h4 my-auto" id="basic-addon1">{{$sub->name}} </span>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="checkbox" value="{{$sub->id}}" name="sub[{{$loop->index}}]">
                                </div>
                              </div>
                            <input type="number" class="form-control"   name="price[{{$loop->index}}]">


                          </div>





                            @endforeach


                    </div>


                     <div class="modal-footer justify-content-center">
                        <button type="button" class="btn  btn-danger h4" req="no" data-dismiss="modal"
                            id="closeAdding">{{__('tr.close')}}</button>
                        <button type="button" id="oklink" req="no" class="btn h4 btn-success">{{__('tr.save')}}</button>
                    </div>
                     <input type="hidden" id="link" req="no" name="id" />
                 </form>
             </div>

         </div>
     </div>
 </div>

 <script>
     $(document).on('click', '#oklink', function(e) {

         e.preventDefault();
         e.stopImmediatePropagation();
         var form = document.getElementById('linkForm');

             var data = $('#linkForm').serialize();

             $.ajax({
                 url: "{{ route('service.linkSub') }}",
                 type: 'post',
                 dataType: 'json',
                 data: data,

                 success: function(data) {
                     if (data.response == true) {
                         var table = $('.data-table').DataTable();
                         table.draw();
                         Alert("{{$model_name}} has been edit successfully", "success")
                         $("#linkmodal .close").click();
                         $('.modal-backdrop').hide();
                     } else {
                         Alert("error message", "danger")
                         $("#linkmodal .close").click();
                         $('.modal-backdrop').hide();
                     }
                 }
             });



     });
     $(document).on('click', '#closeedit', function(e) {
         e.preventDefault();
         e.stopImmediatePropagation();

         var form = document.getElementById('linkForm');
         for (I = 0; I < form.length; I++) {
             $(form[I]).removeClass('is-invalid')
             $(form[I]).removeClass('is-valid')
             $(form[I]).val('')
         }
     });



 </script>
