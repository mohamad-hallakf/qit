  <!-- Modal -->
  <div class="modal fade border  border border-info rounded" id="addweight" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  " role="document">
          <div class="card">
              <div class="modal-content">

                  <div class="card-header card-header-info">
                      <h3 class="card-title"> اضافة قياس جديد</h3>
                      <p class="card-category h5"> <strong class="h3">انتبه
                          </strong>الوزن ب كغ والطول ب سم </p>

                  </div>
                  <form  method="POST" action="{{ route('Chart.store') }}" enctype="multipart/form-data"
                      class="text-dark">
                      @csrf
                      <div class="card-body ">

                          <div class="form-group my-2 ">
                              <label for="exampleInputname" class="h4">الوزن</label>
                              <input type="text" class="form-control" id="exampleInputname" name="weight" max="15"
                                  min="1" required>

                          </div>
                          <div class="form-group my-2 ">
                              <label for="exampleInputname2" class="h4">الطول</label>
                              <input type="text" class="form-control" id="exampleInputname2" name="height" max="100"
                                  min="30" required>

                          </div>
                          <input type="hidden" value="{{$id}}" name="childid">

                      </div>
                      <div class="card-footer ml-auto mr-auto">
                          <button type="submit" class="btn btn-info mx-auto save h3 py-1">موافق</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
