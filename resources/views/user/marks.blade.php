@extends('layouts.app', ['activePage' => 'user-marks'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class=" row   bg-gray m-1 mb-2 rounded pb-0 ">
                <div class="col-10  mt-2">
                    <h1 class="text-muted  text-lg h1  "> Students Marks </h1>
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
    <script type="text/javascript">
        $(document).ready(function populate() {

            //start get the data and make the tables
            $(function() {
                var header = '';
                @foreach ($columnArray as $column)
                    header = header + '<th>{{ __('' . $column) }}</th>';
                @endforeach

                $('#table-header').html(header);

                var columnsNames = []
                var counter
                @foreach ($columnArray as $column)
                    columnsNames.push({
                        data: '{{ $column }}'
                    }, )
                @endforeach
                                var printColumn = []

                for (i = 0; i < columnsNames.length ; i++)
                    printColumn.push(i)
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
                    ajax: "{{ route('user.marks') }}",
                    columns: columnsNames,
                    "dom": '<lf<B><t>ip>',
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn btn-success  btn-sm mx-2',
                            exportOptions: {
                                columns: printColumn
                            }


                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info  btn-sm mx-2',
                            exportOptions: {
                                columns: printColumn
                            }



                        },
                    ]
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
                url: "{{ route('user.edit') }}",
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
                        console.log(data.data)

                    } else {}
                }
            });




        });
    </script>
@endpush
