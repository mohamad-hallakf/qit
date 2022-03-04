@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Profile')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Users</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">

                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#adduser">Add user <i class="fa-solid fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Creation date
                                            </th>
                                            <th class="text-right">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->created_at }}
                                                </td>
                                                <td class="td-actions text-right ">
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="#"
                                                        data-id="{{ $user->id }}" title="edit the user">
                                                        <span class="bg-white rounded-circle p-2 border-success border "> <i
                                                                class="fa fa-lg fa-light fa-pen "></i>
                                                        </span>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade border  border border-primary rounded" id="adduser" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  " role="document">
                <div class="card">
                    <div class="modal-content">

                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">User information</p>
                        </div>
                        <form id="adduser" method="POST" action="{{ route('register') }}">
                            <div class="card-body ">

                                <div class="form-group my-2 form-row">
                                    <label for="exampleInputname">Name</label>
                                    <input type="text" class="form-control" id="exampleInputname" name="name" >
                                    <div class="invalid-feedback">
                                        Please enter a username.
                                      </div>

                                </div>
                                <div class="form-group my-2">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        >
                                        <div class="invalid-feedback">
                                            Please enter an email.
                                          </div>
                                </div>
                                <div class="form-group my-2">
                                    <label for="exampleInputpassword">Password</label>
                                    <input type="password" class="form-control" id="exampleInputpassword" name="password"
                                        >
                                        <div class="invalid-feedback">
                                            Please enter an email.
                                          </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary mx-auto save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.save', function() {
                event.preventDefault();
                event.stopPropagation();
                formValidtor("adduser", ["name", "email", "password"])
            });
        });
    </script>
@endpush
