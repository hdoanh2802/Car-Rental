@extends('layouts.admin')
@section('title')
    <title>Add-user</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'User', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="username" placeholder="username">
                                    @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fullname" placeholder="full name">
                                @if ($errors->has('fullname'))
                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="address">
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Phone</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="phone">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2_init" name="status">
                                    <option value="">Select status</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item }}"> {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2_init" name="role_id">
                                    <option value="">Select role</option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
