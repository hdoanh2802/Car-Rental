@extends('layouts.admin')
@section('title')
    <title>Edit booking</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Booking', 'key' => 'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('booking.update', ['id' => $booking->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control select2_init" name="user_id">
                                    <option value="{{ $booking->user_id }}">{{ $booking->user->username }}
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Car</label>
                                <select class="form-control select2_init" name="car_id">
                                    <option value=" {{ $booking->car_id }}">{{ $booking->car->name }}</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label for="">Pick Up Date</label>
                                    <input value="{{ date('Y-m-d\TH:i', strtotime($booking->pick_up_date)) }}"
                                        type="datetime-local" class="form-control" name="pick_up_date">
                                    @if ($errors->has('pick_up_date'))
                                        <span class="text-danger">{{ $errors->first('pick_up_date') }}</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label>Return Date</label>
                                    <input value="{{ date('Y-m-d\TH:i', strtotime($booking->return_date)) }}"
                                        type="datetime-local" class="form-control" name="return_date">
                                    @if ($errors->has('return_date'))
                                        <span class="text-danger">{{ $errors->first('return_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <label>Pick Up Office</label>
                                    <select class="form-control select2_init" name="pick_up_office_id">
                                        <option value="{{ $booking->pick_up_office_id }}">
                                            {{ $booking->pick_up_office->name }}</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">
                                                {{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Return Office</label>
                                    <select class="form-control select2_init" name="return_office_id">
                                        <option value="{{ $booking->return_office_id }}">
                                            {{ $booking->return_office->name }}</option>
                                        @foreach ($offices as $office)
                                            <option value="{{ $office->id }}">
                                                {{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2_init" name="status_id">
                                    <option value="{{ $booking->status_id }}">{{ $booking->status->name_status }}
                                    </option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name_status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Rental Type</label>
                                <select class="form-control select2_init" name="rental_type">
                                    <option value="{{ $booking->rental_type }}">{{ $booking->rental_type }}</option>
                                    @foreach ($rental_type as $item)
                                        <option value="{{ $item }}"> {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
