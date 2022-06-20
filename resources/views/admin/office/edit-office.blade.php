@extends('layouts.admin')
@section('title')
    <title>Edit Office</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Office', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('office.update', ['id' => $office->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ $office->name }}" type="text" class="form-control" name="name"
                                    placeholder="name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input value="{{ $office->address }}" type="text" class="form-control" name="address"
                                    placeholder="address">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
