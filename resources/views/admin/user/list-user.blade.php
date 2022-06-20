@extends('layouts.admin')
@section('title')
    <title>Trang-chu</title>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'User', 'key' => 'List'])
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="">
                        @csrf
                        <div class="input-group rounded">
                            <input type="text" name="username" value="{{ $search }}" class="form-control rounded"
                                placeholder="Search user name" />
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <a href="{{ route('user.export') }}" class="btn btn-success float-right m-2">Export</a>
                        <a href="{{ route('user.import') }}" class="btn btn-success float-right m-2">Import</a>
                        <a href="{{ route('user.create') }}" class="btn btn-success float-right m-2">ADD</a>
                    </div>
                    @if (session()->has('status'))
                        <div class="alert alert-success">
                            {{ session()->get('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>
                                            @foreach ($user->roles as $item)
                                                {{ $item->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#showUserModal1" data-username="{{ $user->username }}"
                                                data-email="{{ $user->email }}"
                                                data-fullname="{{ $user->userInfo->fullname }}"
                                                data-address="{{ $user->userInfo->address }}"
                                                data-phone="{{ $user->userInfo->phone }}"
                                                data-age="{{ $user->userInfo->age }}">


                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </button>
                                            <a href="{{ route('user.edit', ['id' => $user->id]) }}"
                                                class="btn btn-default"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>

                                            <a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                                class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-trash"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="">
                        {!! $users->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="showUserModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">User profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">User Name:</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Full Name:</label>
                            <input type="text" name="fullname" class="form-control" id="fullname">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" name="address" class="form-control" id="address">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Age:</label>
                            <input type="text" name="age" class="form-control" id="age">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        $('#showUserModal1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var username = button.data('username')
            var email = button.data('email')
            var fullname = button.data('fullname')
            var address = button.data('address')
            var phone = button.data('phone')
            var age = button.data('age')

            var modal = $(this)
            modal.find('.modal-body #username').val(username);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #fullname').val(fullname);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #age').val(age);
        })
    </script>
@endsection
