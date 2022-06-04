@extends('layouts.app', ['activePage' => 'payment' ])
@section('content')
    <div class="content">

        <div class="container-fluid ">




        <div class=" row   bg-gray m-1 mb-2 rounded pb-0 ">
            <div class="col-11  mt-2">
                <h1 class="text-muted  text-lg  ">  سجل الدفعات </h1>
            </div>
            <div class="col-1 mt-2 text-center">


            </div>




        </div>
        <hr class="mt-0">

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
    <script type="text/javascript">
        $(document).ready(function populate() {

            //start get the data and make the tables
            $(function() {
                var header = '';
                @foreach ($columnArray as $column)
                header=header+'<th>{{__("tr.$column")}}</th>';
                @endforeach

                $('#table-header').html(header);

                var columnsNames = []
                var counter
                @foreach ($columnArray as $column)
                    columnsNames.push({data: '{{ $column }}',name: '{{ $column }}',},)
                @endforeach

                var printColumn = []
                for (i = 0; i < columnsNames.length - 1; i++)
                    printColumn.push(i)

                var table = $('.data-table').DataTable({
                    "language": {       "infoEmpty": "{{ __('reservation.nodata')}}",
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

                    ajax: "{{ route('Payment.index') }}",

                    columns: columnsNames,




                });



            });
            //end  get the data and make the tables
        });
        // edit the record

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $('#theID').val(id);

            var form = document.getElementById('editForm');
            for (I = 0; I < form.length; I++) {
            $(form[I]).removeClass('is-invalid')
            $(form[I]).removeClass('is-valid')

        }
            data = {
                'id': id
            }
            $.ajax({
                url: "{{ route('Payment.edit') }}",
                type: 'post',
                dataType: 'json',
                data,
                data,
                success: function(data) {
                    if (data.response == true) {

                        $.each(data.data, function(index, value) {
                            $("#editForm input[name=" + index + "]").val(value)
                            $("#editForm select[name=" + index + "]").val(value)
                            $("#editForm textarea[name=" + index + "]").val(value)


                        });

                    } else {}
                }
            });




        });



        $(function() {
            $('[data-toggle="tooltip"]').tooltip('enable');
        });
    </script>

@endpush
