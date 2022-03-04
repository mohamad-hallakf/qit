@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Profile')])


@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Notifications</h4>
        <p class="card-category"> Here you can manage Notifications</p>
    </div>
    <div class="card-body">
        <div class="row">

            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <a href="{{ route("$module_name.index") }}" class="btn btn-success mt-1 btn-sm" data-toggle="tooltip" title="{{ __(ucwords($module_name)) }} List"><i class="fas fa-list"></i> List</a>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <hr>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <?php $data = json_decode($$module_name_singular->data); ?>
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <th>
                                    {{ $data->title }}
                                </th>
                            </tr>
                            <tr>
                                <th>Text</th>
                                <td>
                                    {!! $data->text !!}
                                </td>
                            </tr>
                            @if($data->url_backend != '')
                            <tr>
                                <th>URL Backend</th>
                                <td>
                                    Backend: <a href="{{$data->url_backend}}">{{$data->url_backend}}</a>
                                </td>
                            </tr>
                            @endif
                            @if($data->url_frontend != '')
                            <tr>
                                <th>URL Frontend</th>
                                <td>
                                    Frontend: <a href="{{$data->url_frontend}}">{{$data->url_frontend}}</a>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>            </div>
</div>
</div>
</div>

@endsection
