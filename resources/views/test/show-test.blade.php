 <div class="modal fade" id="editmodal" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
         <div class="card">
             <div class="modal-content">
                 <div class="card-header card-header-primary">
                     <h4 class="card-title text-center">{{ __('show') }} {{ $model_name }}</h4>
                 </div>
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">
                     </button>
                 </div>
                 <div class="modal-body text-center">
                    <h2 id="test"> </h2>
                        <div id="testQuestion"></div>
                         <div class="modal-footer justify-content-center">
                             <button type="button" class="btn  btn-danger" req="no" data-dismiss="modal"
                                 id="cancel ">{{ __('close') }}</button>

                         </div>

                 </div>

             </div>
         </div>

     </div>
 </div>


