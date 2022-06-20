@extends('layouts.admin')
@section('title')
    <title>Add Office</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Office', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('office.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Label</label>
                                <input type="text" class="form-control" name="name" placeholder="name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="address">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
