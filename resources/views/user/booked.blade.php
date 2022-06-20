@extends('layouts.home')
@section('title')
    <title>Booked Car</title>
@endsection
@section('content')
    <div class="jewellery_section">
        <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-booked active">
                    <div class="container">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <h1 class="fashion_taital">Car Booked</h1>
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Car</th>
                                    <th scope="col">Pick Up Date</th>
                                    <th scope="col">Return Up Date</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Payable</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $booked->car->name }}</td>
                                    <td>{{ $booked->pick_up_date }}</td>
                                    <td>{{ $booked->return_date }}</td>
                                    <td>{{ $booked->total_price }}</td>
                                    <td>{{ $payable }}</td>

                                    <td><button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#received"
                                            data-id="{{ $booked->id }}" data-user_id="{{ $booked->user_id }}"
                                            data-car_id="{{ $booked->car_id }}" data-name="{{ $booked->car->name }}"
                                            data-pick_office="{{ $booked->pick_up_office->name }}"
                                            data-return_office="{{ $booked->return_office->name }}"
                                            data-pick_office_id="{{ $booked->pick_up_office_id }}"
                                            data-return_office_id="{{ $booked->return_office_id }}"
                                            data-pick_date="{{ $booked->pick_up_date }}"
                                            data-return_date="{{ $booked->return_date }}"
                                            data-rental_type="{{ $booked->rental_type }}"
                                            data-price_start="{{ $booked->car->price_start }}"
                                            data-payable="{{ $payable}}">Received</button></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="received" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="seeMoreModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seeMoreModal">Received</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('received.car', 'test') }}" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        @include('user.received-car')
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
                                <path
                                    d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z" />
                            </svg>Paypal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal notification --}}
    {{-- <div class="modal fade" id="notification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="notification" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notification">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    @csrf
                    <div class="modal-body">
                        @include('common.modal-notification')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
{{-- @section('js')
    @if (!empty(Session::get('message')) && Session::get('message'))
        <script>
            $(function() {
                $('#notification').modal('show');
            });
        </script>
    @endif
    <script>
        $('#booking').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var user_id = button.data('user_id')
            var car_id = button.data('car_id')
            var name = button.data('name')
            var pick_office = button.data('pick_office')
            var return_office = button.data('return_office')
            var pick_date = button.data('pick_date')
            var return_date = button.data('return_date')
            var price_start = button.data('price_start')
            var pick_office_id = button.data('pick_office_id')
            var return_office_id = button.data('return_office_id')
            var rental_type = button.data('rental_type')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #car_id').val(car_id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #pick_up_office').val(pick_office);
            modal.find('.modal-body #return_office').val(return_office);
            modal.find('.modal-body #pick_up_office_id').val(pick_office_id);
            modal.find('.modal-body #return_office_id').val(return_office_id);
            modal.find('.modal-body #pick_up_date').val(pick_date);
            modal.find('.modal-body #return_date').val(return_date);
            modal.find('.modal-body #price_start').val(price_start);
            modal.find('.modal-body #rental_type').val(rental_type);
        })
    </script>
@endsection --}}
@section('js')
    @if (!empty(Session::get('message')) && Session::get('message'))
        <script>
            $(function() {
                $('#notification').modal('show');
            });
        </script>
    @endif
    <script>
        $('#received').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var user_id = button.data('user_id')
            var car_id = button.data('car_id')
            var name = button.data('name')
            var pick_office = button.data('pick_office')
            var return_office = button.data('return_office')
            var pick_date = button.data('pick_date')
            var return_date = button.data('return_date')
            var price_start = button.data('price_start')
            var pick_office_id = button.data('pick_office_id')
            var return_office_id = button.data('return_office_id')
            var rental_type = button.data('rental_type')
            var payable = button.data('payable')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #car_id').val(car_id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #pick_up_office').val(pick_office);
            modal.find('.modal-body #return_office').val(return_office);
            modal.find('.modal-body #pick_up_office_id').val(pick_office_id);
            modal.find('.modal-body #return_office_id').val(return_office_id);
            modal.find('.modal-body #pick_up_date').val(pick_date);
            modal.find('.modal-body #return_date').val(return_date);
            modal.find('.modal-body #price_start').val(price_start);
            modal.find('.modal-body #rental_type').val(rental_type);
            modal.find('.modal-body #payable').val(payable);
        })
    </script>
@endsection
