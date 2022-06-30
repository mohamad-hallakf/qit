<!-- Modal -->

<div class="modal fade    border    border-primary rounded" id="addmodel" tabindex="-1">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="card">
            <div class="modal-content">
                <div class="card-header card-header-primary  ">
                    <h4 class="card-title text-center  ">add new {{ $model_name }}</h4>

                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">

                    <form class="m-2 font-weight-bold " id="addForm">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">{{ __('name') }}</span>
                                </div>
                                <input type="text" placeholder="{{ __('name') }}" name="name"
                                    class=" form-control ">

                            </div>
                        </div>


                        <div>
                            <div class="input-group mb-3">
                                <button id="addQuestion" class="btn btn-outline-success " type="button"><i
                                        class="fas fa-plus-circle"></i></button>
                                <select class="form-select" id="selectQuestion"
                                    aria-label="Example select with button addon">
                                    <option selected value="noselect">Choose Question...</option>

                                </select>
                            </div>
                            <div id="theQuestion" class="mt-3 text-center">
                                <h3 class="text-center">The Question</h3>


                            </div>
                        </div>


                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-lg btn-danger py-2" data-dismiss="modal"
                                id="closeAdding">{{ __('close') }}</button>
                            <button type="button" id="confirmAdding"
                                class="btn btn-lg btn-success  py-2">{{ __('save') }}</button>
                                   {{-- <a class="btn btn-outline-success col-1 p-1 ml-5" href="{{ route('question.index') }}"
                    title="Go to Question Record">
                    <i class="fa fa-lg fa-solid fa-question"></i>
                </a> --}}
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    var questionsArray = [];
    var questionsSelected = [];
    $('#theQuestion').hide()
    // get questions Array
    $.ajax({
        url: "{{ route('test.getQuestion') }}",
        type: 'post',
        dataType: 'json',
        success: function(data) {
            if (data.response == true) {
                var question = data.data
                question.forEach(element => {
                    questionsArray.push({
                        id: element.id,
                        content: element.content
                    });
                    $('#selectQuestion').append(
                        '<option value="' + element.id + '">' + element.content + '</option>'
                    )
                });
            }
        }
    });

    $(document).on('click', '#confirmAdding', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        var valid = formValidtor("addForm", ["name"])
        var counter = $("input[name='questions[]']").length
        var data = $('#addForm').serialize();
        if (counter < 4) {
            alert("add 4 question at least...")
        }
        if (valid == 0 && counter > 3) {
            $.ajax({
                url: "{{ route('test.store') }}",
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if (data.response == true) {

                        $("#addmodel .close").click();
                        $('.modal-backdrop').hide();
                        Alert("{{ $model_name }} has been added successfully", "success")

                        var table = $('.data-table').DataTable();

                        table.draw();
                    } else {
                        Alert("error message", "danger")
                        $("#addmodel .close").click();
                        $('.modal-backdrop').hide();
                    }
                }
            });
        }




    });
    $(document).on('click', '#closeAdding', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $('#theQuestion').html('<h3 class="text-center">The Question</h3>')
        var form = document.getElementById('addForm');
        for (I = 0; I < form.length; I++) {
            $(form[I]).removeClass('is-invalid')
            $(form[I]).removeClass('is-valid')

        }
    });




    $(document).on('click', '#addQuestion', function(e) {
        $('#theQuestion').show()
        var selectedID = $('#selectQuestion').val()
        var selectedContent = $("#selectQuestion option:selected").text()
        if (selectedID == 'noselect') {
            alert("choose question first...")
        } else if (!contain(selectedID)) {
            $('#theQuestion').append(
                '<div class="mt-2"><h5> "' + selectedContent +
                '" <button  class="btn btn-outline-danger deleteQuestion " type="button"><i class="fa fa-trash"></i></button></h5><input type="hidden"  class="  form-control " name="questions[]"   value="' +
                selectedID + '" ></div>')
        } else {
            alert("the question already exist in the test")
        }

    });




    $(document).on('click', '.deleteQuestion', function(e) {
        $(this).parent().parent().remove();
    });



    function contain(selectedID) {
        var exist = false
        $("input[name='questions[]']").each(function() {

            if ($(this).val() == selectedID) {
                exist = true;
            }
        });
        return exist;
    }
</script>
