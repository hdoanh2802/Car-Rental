<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\StatusBooking;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Car_Type;
use DateTime;

class UserBookingController extends Controller
{
    public function cart(Request $request)
    {
        $search = $request->input('search');
        if ($search != "") {
            $cars =  Car::where('name', 'like', '%' . $search . '%')->paginate(6);
        }
        if ($search == "") {
            $cars = Car::paginate(6);
        }
        
        $car_types = Car_Type::all();
        $status_waiting = StatusBooking::where('name_status', 'waiting')->first();
        $bookings = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $status_waiting->id]
        ])->get();

        return view('user.cart', compact('bookings', 'car_types', 'search', 'cars'));
    }

    public function bookedCar(Request $request)
    {
        $search = $request->input('search');
        if ($search != "") {
            $cars =  Car::where('name', 'like', '%' . $search . '%')->paginate(6);
        }
        if ($search == "") {
            $cars = Car::paginate(6);
        }
        $car_types = Car_Type::all();
        $status_booked = StatusBooking::where('name_status', 'booked')->first();
        $booked = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $status_booked->id]
        ])->first();

        if ($booked != null) {
            $pick_up_date = new DateTime($booked->pick_up_date);
            $return_date = new DateTime($booked->return_date);
            $hour = $return_date->diff($pick_up_date)->h;
            $day = $return_date->diff($pick_up_date)->d;
            $total_time = $day * 24 + $hour;

            $payable = $total_time * $booked->car->price_hourly . ".00";

            return view('user.booked', compact('booked', 'car_types', 'search', 'cars', 'payable'));
        }
        return redirect()->route('cart.list')->with('message', 'Please booking now');
    }
}
