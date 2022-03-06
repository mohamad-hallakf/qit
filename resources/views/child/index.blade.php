@extends('layouts.app', ['activePage' => 'children' ])
@section('content')
    <div class="content">

        <div class="container-fluid">

            <div class=" row   bg-gray m-1 mb-2 rounded pb-0 ">


                <!-- Button trigger modal -->
                <span data-toggle="tooltip" data-placement="auto" class="h3 text-muted">

                    <button type="button" class="btn btn-success p-2 rounded-circle" data-toggle="modal"
                        data-target="#addmodel" id='internalAdding'>
                        <i class="fas fa-plus-circle fa-2x"></i>
                    </button>
                    اضافة خدمة
                </span>

            </div>


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
        @include('child.add-child')
        @include('child.delete-child')
        @include('child.edit-child')
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
                    ajax: "{{ route('child.index') }}",
                    columns: columnsNames
                });

            });
            //end  get the data and make the tables
        });
        // edit the record

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $('#theID').val(id);
            $('#editForm select[name=farmid] > option').each(function() {

                if ($(this).val() != 'noselect')
                    $(this).remove();
            });
            var form = document.getElementById('editForm');

            for (I = 0; I < form.length; I++) {
                $(form[I]).removeClass('is-invalid')
                $(form[I]).removeClass('is-valid')
            }

            var form = document.getElementById('editForm');
            data = {
                'id': id
            }
            $.ajax({
                url: "{{ route('child.edit') }}",
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