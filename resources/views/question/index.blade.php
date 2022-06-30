@extends('layouts.app', ['activePage' => 'questionsIndex' ])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class=" row   bg-gray m-1 mb-2 rounded pb-0 ">
                <div class="col-10  mt-2">
                    <h1 class="text-muted  text-lg h1  " > Questions Record</h1>
                </div>
                <div class="col-2 mt-2 text-center">

                    <!-- Button trigger modal -->
                    <span data-toggle="tooltip" data-placement="auto">

                        <button type="button" class="btn btn-success    " data-toggle="modal" data-target="#addmodel"
                            id='internalAdding'>
                            <i class="fas fa-plus-circle fa-2x"></i>
                        </button>

                    </span>

                </div>
            </div>
            <hr>


            <div clsss="table-responsive mb-5 ">
                <table class="table table-bordered data-table table-condensed table-hover shadow-sm ">
                    <thead class="table-light">
                        <tr id="table-header">

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <div>

        @include('question.delete-question')
        @include('question.add-question')
        @include('question.edit-question')
    </div>
    <script type="text/javascript">
        $(document).ready(function populate() {

            //start get the data and make the tables
            $(function() {
                var header = '';
                @foreach ($columnArray as $column)
                    header = header + '<th>{{ __('' . $column) }}</th>';
                @endforeach
                header = header + '<th>{{ __('action') }}</th>';
                $('#table-header').html(header);

                var columnsNames = []
                var counter
                @foreach ($columnArray as $column)
                    columnsNames.push({
                        data: '{{ $column }}'
                    }, )
                @endforeach
                columnsNames.push({
                    data: 'action',
                    name: '{{ __('action') }}',
                    orderable: false,
                    searchable: false
                }, )
                var table = $('.data-table').DataTable({
                    "language": {
                        "infoEmpty": "{{ __('no data') }}",
                        "search": "{{ __('Serach') }} :",
                        "info": "{{ __('Showing') }} _START_  {{ __('to') }} _END_  {{ __('of') }}  _TOTAL_ {{ __('entries') }} ",
                        "processing": "{{ __('Processing...') }}",
                        "lengthMenu": "{{ __('Show') }} _MENU_  {{ __('entries') }}",
                        "emptyTable": "",
                        "paginate": {
                            "first": "{{ __('first') }}",
                            "last": "{{ __('last') }} ",
                            "next": "{{ __('Next') }} ",
                            "previous": "{{ __('Previous') }} ",
                        }

                    },
                    processing: true,

                    serverSide: true,
                    ajax: "{{ route('question.index') }}",
                    columns: columnsNames
                });

            });
            //end  get the data and make the tables
        });
        // edit the record

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            removeValid("editForm", ["name", "username", "email", "password"])

            var form = document.getElementById('editForm');
            data = {
                'id': id
            }
            $.ajax({
                url: "{{ route('question.edit') }}",
                type: 'post',
                dataType: 'json',
                data,
                data,
                success: function(data) {
                    if (data.response == true) {

                        $.each(data.data, function(index, value) {
                            $("#editForm input[name=" + index + "]").val(value)
                            $("#editForm select[name=" + index + "]").val(value)

                        });

                    } else {}
                }
            });




        });
    </script>


@endpush
