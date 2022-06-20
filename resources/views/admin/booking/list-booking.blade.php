@extends('layouts.admin')
@section('title')
    <title>Booking</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'Booking', 'key' => 'List'])
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
                                placeholder="Search user name" aria-label="Search" aria-describedby="search-addon" />
                            <input type="submit" value="search">
                        </div>
                    </form>
                    <div class="col-md-12">
                        <a href="{{ route('booking.create') }}" class="btn btn-success float-right m-2">ADD</a>
                    </div>

                    <div class="col-md-12">
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Car</th>
                                    <th scope="col">Pick Up Date</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Pick Up Office</th>
                                    <th scope="col">Return Office</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Rental Type</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <th scope="row">{{ $booking->id }}</th>
                                        <td>{{ $booking->user->username }}</td>
                                        <td>{{ $booking->car->name }}</td>
                                        <td>{{ $booking->pick_up_date }}</td>
                                        <td>{{ $booking->return_date }}</td>
                                        <td>{{ $booking->pick_up_office->name }}</td>
                                        <td>{{ $booking->return_office->name }}</td>
                                        <td>{{ $booking->status->name_status }}</td>
                                        <td>{{ $booking->rental_type }}</td>
                                        <td>
                                            <a href="{{ route('booking.edit', ['id' => $booking->id]) }}"
                                                class="btn btn-default"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                            <a href="{{ route('booking.delete', ['id' => $booking->id]) }}"
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
                        {!! $bookings->links() !!}
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
