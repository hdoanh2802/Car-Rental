@extends('layouts.home')
@section('title')
    <title>Home</title>
@endsection
@section('content')
    <div class="jewellery_section">
        <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital">{{$type_label->label}}</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach ($cars as $item)
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="box_main">
                                            <h4 class="shirt_text">{{ $item->name }}</h4>
                                            <p class="price_text">Start Price <span style="color: #262626;">
                                                   $ {{ $item->price_start }}</span>
                                            </p>
                                            <p class="price_text">Price Hourly <span style="color: #262626;">
                                                   $ {{ $item->price_hourly }}</span>
                                            </p>
                                            <div class="jewellery_img">
                                                <img src="{{ asset("$item->image_path") }}" width="500" height="600" />
                                            </div>
                                            <div class="btn_main">
                                                <div class="buy_bt"><a data-bs-toggle="modal"
                                                        data-bs-target="#checkAvailabilityModal"
                                                        data-name="{{ $item->name }}"
                                                        data-user_id="{{ Auth::user()->id }}"
                                                        data-car_id="{{ $item->id }}" href="#">Book Now</a></div>
                                                <div class="seemore_bt"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#seeMoreModal" data-name="{{ $item->name }}"
                                                        data-color="{{ $item->color }}"
                                                        data-brand="{{ $item->brand->name_brand }}"
                                                        data-description="{{ $item->description }}"
                                                        data-purch_date="{{ $item->purch_date }}">See
                                                        More</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $cars->links() }}
    </div>
@endsection
{{-- modal see more --}}
<div class="modal fade" id="seeMoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="seeMoreModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seeMoreModal">Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                @csrf
                <div class="modal-body">
                    @include('user.modal-show-car')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal book --}}
<div class="modal fade" id="checkAvailabilityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="checkAvailabilityModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="checkAvailabilityModal">Book Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('create-booking') }}" method="POST">
                @csrf

                <div class="modal-body">
                    @include('user.modal-check-availability')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#checkAvailabilityModal" data-bs-dismiss="modal">Check
                        Availability</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="notification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                </div>
            </form>
        </div>
    </div>
</div>

@section('js')
    <script>
        $('#seeMoreModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var name = button.data('name')
            var color = button.data('color')
            var brand = button.data('brand')
            var description = button.data('description')
            var purch_date = button.data('purch_date')


            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #color').val(color);
            modal.find('.modal-body #brand').val(brand);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #purch_date').val(purch_date);

        })
    </script>
    <script>
        $('#checkAvailabilityModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var name = button.data('name')
            var id = button.data('car_id')

            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #car_id').val(id);
        })
    </script>
    @if (!empty(Session::get('message')) && Session::get('message'))
        <script>
            $(function() {
                $('#notification').modal('show');
            });
        </script>
    @endif
@endsection
