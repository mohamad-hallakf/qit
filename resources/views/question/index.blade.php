@extends('layouts.app', ['activePage' => 'services' ])
@section('content')
    <div class="content">

        <div class="container-fluid">


            <div clsss="table-responsive mb-5 ">
                <table class="table table-bordered data-table table-condensed table-hover shadow-sm ">
                    <thead>
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
        @include('question.edit-question')
    </div>

    <script type="text/javascript">
        $(document).ready(function populate() {

            //start get the data and make the tables
            $(function() {
                var header = '';
                @foreach ($columnArray as $column)
                    header=header+'<th>{{ __('tr.' . $column) }}</th>';
                @endforeach
                header = header + '<th>{{ __('tr.action') }}</th>';
                $('#table-header').html(header);

                var columnsNames = []
                var counter
                @foreach ($columnArray as $column)
                    columnsNames.push({data: '{{ $column }}'},)
                @endforeach
                columnsNames.push({
                    data: 'action',
                    name: '{{ __('tr.action') }}',
                    orderable: false,
                    searchable: false
                }, )
                var table = $('.data-table').DataTable({
                    "language": {
                        "infoEmpty": "{{ __('tr.nodata') }}",
                        "search": "{{ __('tr.Serach') }} :",
                        "info": "{{ __('tr.Showing') }} _START_  {{ __('tr.to') }} _END_  {{ __('tr.of') }}  _TOTAL_ {{ __('tr.entries') }} ",
                        "processing": "{{ __('tr.Processing...') }}",
                        "lengthMenu": "{{ __('tr.Show') }} _MENU_  {{ __('tr.entries') }}",
                        "emptyTable": "",
                        "paginate": {
                            "first": "{{ __('tr.first') }}",
                            "last": "{{ __('tr.last') }} ",
                            "next": "{{ __('tr.Next') }} ",
                            "previous": "{{ __('tr.Previous') }} ",
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

            $("#qid").val(id)



        });




        $(document).on('click', '.accept', function() {
            var id = $(this).attr('data-id');


            data = {
                'id': id
            }
            $.ajax({
                url: "{{ route('question.accept') }}",
                type: 'post',
                dataType: 'json',
                data,
                data,
                success: function(data) {
                    if (data.response == true) {
                        var table = $('.data-table').DataTable();
                    table.draw();


                    } else {}
                }
            });




        });
    </script>

@endpush
