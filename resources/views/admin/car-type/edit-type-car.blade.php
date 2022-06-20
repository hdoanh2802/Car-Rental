@extends('layouts.admin')
@section('title')
    <title>Edit car types</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Car type', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('car-type.update', ['id' => $car_type->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Label</label>
                                <input value="{{ $car_type->label }}" type="text" class="form-control" name="label"
                                    placeholder="label">
                                @if ($errors->has('label'))
                                    <span class="text-danger">{{ $errors->first('label') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input value="{{ $car_type->description }}" type="text" class="form-control" name="description"
                                    placeholder="description">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
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
