@extends('layouts.admin')
@section('title')
    <title>Edit car</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Car', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('car.update', ['id' => $car->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label>Office</label>
                                    <select class="form-control select2_init" name="office_id">
                                        <option value="{{ $car->office_id }}">{{ $car->office->name }}</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Car type</label>
                                    <select class="form-control select2_init" name="type_id">
                                        <option value="{{ $car->type_id }}">{{ $car->type->label }}</option>
                                        @foreach ($car_types as $car_type)
                                            <option value="{{ $car_type->id }}">{{ $car_type->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                    <input value=" {{ $car->name }}" type="text" class="form-control" name="name"
                                        placeholder="Enter name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Color</label>
                                    <input {{ $car->color }} type="color" class="form-control" name="color"
                                        placeholder="Enter color" style="width: 50px">
                                    @if ($errors->has('color'))
                                        <span class="text-danger">{{ $errors->first('color') }}</span>
                                    @endif
                                </div>

                                <div class="col">
                                    <label>Brand</label>
                                    <select class="form-control select2_init" name="brand_id">
                                        <option value="{{ $car->brand->id }}">{{ $car->brand->name_brand }}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name_brand }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input value="{{ $car->description }}" type="text" class="form-control"
                                    name="description" placeholder="description">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Purch_date</label>
                                    <input value="{{ $car->purch_date }}" type="datetime-local" class="form-control"
                                        name="purch_date" placeholder="purch_date">
                                    @if ($errors->has('purch_date'))
                                        <span class="text-danger">{{ $errors->first('purch_date') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Price Start</label>
                                    <input value="{{ $car->price_start }}" type="text" class="form-control"
                                        name="price_start" placeholder="Enter price_start">
                                    @if ($errors->has('price_start'))
                                        <span class="text-danger">{{ $errors->first('price_start') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Price Hourly</label>
                                    <input value="{{ $car->price_hourly }}" type="tetx" class="form-control"
                                        name="price_hourly" placeholder="Enter price_hourly">
                                    @if ($errors->has('price_hourly'))
                                        <span class="text-danger">{{ $errors->first('price_hourly') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input value="{{ $car->image_name }}" type="file" class="form-control-file"
                                    name="image_path" placeholder="Enter image">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
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
