@extends('layouts.admin')
@section('title')
    <title>Add booking</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Booking', 'key' => 'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('booking.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control select2_init" name="user_id" id="user_id">
                                    <option value="">--Select user--</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Car</label>
                                <select class="form-control select2_init" name="car_id" id="car_id">
                                    <option value="">--Select car--</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Pick Up Date</label>
                                    <input type="datetime-local" class="form-control" name="pick_up_date"
                                        id="pick_up_date" placeholder="Enter pick_up_date">
                                    @if ($errors->has('pick_up_date'))
                                        <span class="text-danger">{{ $errors->first('pick_up_date') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Return Date</label>
                                    <input type="datetime-local" class="form-control" name="return_date" id="return_date"
                                        placeholder="Enter return_date">
                                    @if ($errors->has('return_date'))
                                        <span class="text-danger">{{ $errors->first('return_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Pick Up Office</label>
                                    <select class="form-control select2_init" name="pick_up_office_id"
                                        id="pick_up_office_id">
                                        <option value="">--Select Office--</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Return Office</label>
                                    <select class="form-control select2_init" name="return_office_id" id="return_office_id">
                                        <option value="">--Select Office--</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2_init" name="status_id" id="status_id">
                                    <option value="">--Select Status--</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Rental Type</label>
                                <select class="form-control select2_init" name="rental_type" id="rental_type">
                                    <option value="">--Select rental type--</option>
                                    @foreach ($rental_type as $item)
                                        <option value="{{ $item }}"> {{ $item }}
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
