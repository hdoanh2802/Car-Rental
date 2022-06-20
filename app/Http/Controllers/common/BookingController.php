<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Office;
use App\Models\StatusBooking;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DateTime;

class BookingController extends Controller
{
    public function index(HttpFoundationRequest $request)
    {
        $search = $request->get('username');
        if ($search == "") {
            $bookings = Booking::orderByDesc('created_at')->paginate(5);
        }
        if ($search != "") {
            $user = User::where('username', 'like', '%' . $search . '%')->first();
            if ($user == null) {
                return redirect()->route('booking.list')->with(Session::flash('status', 'User not found'));
            }
            $bookings =  Booking::where('user_id', $user->id)->paginate(5);
        }

        return view('admin.booking.list-booking', compact('bookings', 'search',));
    }

    public function create()
    {
        $rental_type = Booking::RENTA_TYPE;
        $offices = Office::all();
        $bookings = Booking::all();
        $status = StatusBooking::all();
        $users = User::all();
        $cars = Car::all();

        return view('admin.booking.add-booking', compact('rental_type', 'bookings', 'offices', 'status', 'users', 'cars'));
    }

    public function store(Request $request)
    {

        $status_waiting =  StatusBooking::where('name_status', 'waiting')->first();

        $request->validate([
            'pick_up_date' => 'required|date|before:return_date|after_or_equal:now',
            'return_date' => 'required|date|after:pick_up_date',
            'pick_up_office_id' => 'required',
            'return_office_id' => 'required',
        ]);
        $check = $this->CheckAvailability($request);
        $total_price = $this->TotalPrice($request);
        foreach (Auth::user()->roles as $role) {
            if ($role->name == "admin") {
                $booking = new Booking();
                $booking->user_id = $request->input('user_id');
                $booking->car_id = $request->input('car_id');
                $booking->pick_up_date = $request->input('pick_up_date');
                $booking->return_date = $request->input('return_date');
                $booking->pick_up_office_id = $request->input('pick_up_office_id');
                $booking->return_office_id = $request->input('return_office_id');
                $booking->status_id = $request->input('status_id');
                $booking->rental_type = $request->input('rental_type');

                $check = $this->CheckAvailability($request);

                if ($check == null) {

                    $booking->save();
                    return redirect()->route('booking.list')->with('message', 'New booking been added successfully');
                }
                if ($check != null) {

                    $from = $check->pick_up_date;
                    $to = $check->return_date;
                    $from  = date('d-m-Y\ H:i', strtotime($from));
                    $to = date('d-m-Y\ H:i', strtotime($to));

                    return redirect()->route('booking.list')->with('message', 'The car has user book from ' . $from . ' to ' . $to);
                }
            }
        }

        foreach (Auth::user()->roles as $role) {
            if ($role->name == "user") {

                $booking = new Booking();
                $booking->user_id = Auth::user()->id;
                $booking->car_id = $request->input('car_id');
                $booking->pick_up_date = $request->input('pick_up_date');
                $booking->return_date = $request->input('return_date');
                $booking->pick_up_office_id = $request->input('pick_up_office_id');
                $booking->return_office_id = $request->input('return_office_id');
                $booking->status_id = $status_waiting->id;
                $booking->rental_type = Booking::RENTA_TYPE_SHORT;
                $booking->total_price = $total_price;

                if ($check == null) {
                    $booking->save();
                    return redirect()->route('cart.list')->with('message', 'Has add to cart successfully');
                }
                if ($check != null) {

                    $from = $check->pick_up_date;
                    $to = $check->return_date;
                    $from  = date('d-m-Y\ H:i', strtotime($from));
                    $to = date('d-m-Y\ H:i', strtotime($to));

                    return redirect()->back()->with('message', 'The car has user book from ' . $from . ' to ' . $to);
                }
            }
        }
    }

    public function CheckAvailability(Request $request)
    {
        $car_id = $request->input('car_id');
        $pickdate = $request->input('pick_up_date');
        $returndate = $request->input('return_date');

        $count = Booking::where('car_id', $car_id)->count();

        for ($i = 0; $i <= $count; $i++) {
            $check = Booking::where([
                ['car_id', $car_id],
                ['pick_up_date', '<=', $pickdate],
                ['return_date', '>=', $pickdate],
                ['pick_up_date', '<=', $returndate],
                ['return_date', '>=', $returndate],
            ])->orWhere([
                ['car_id', $car_id],
                ['pick_up_date', '>=', $pickdate],
                ['return_date', '>=', $pickdate],
                ['pick_up_date', '<=', $returndate],
                ['return_date', '>=', $returndate],
            ])->orWhere([
                ['car_id', $car_id],
                ['pick_up_date', '<=', $pickdate],
                ['return_date', '>=', $pickdate],
                ['pick_up_date', '<=', $returndate],
                ['return_date', '<=', $returndate],
            ])->orWhere([
                ['car_id', $car_id],
                ['pick_up_date', '>=', $pickdate],
                ['return_date', '>=', $pickdate],
                ['pick_up_date', '<=', $returndate],
                ['return_date', '<=', $returndate],
            ])
                ->first();
        }

        return $check;
    }

    public function TotalPrice(Request $request)
    {
        $car_id = $request->car_id;
        $pick_up_date = new DateTime($request->input('pick_up_date'));
        $return_date = new DateTime($request->input('return_date'));
        $hour = $return_date->diff($pick_up_date)->h;
        $day = $return_date->diff($pick_up_date)->d;
        $total_time = $day * 24 + $hour;

        $car = Car::where('id', $car_id)->first();
        $total_price = $total_time * $car->price_hourly + $car->price_start;

        return $total_price;
    }
    public function edit($id)
    {
        $booking =  Booking::find($id);
        $bookings = Booking::all();
        $users = User::all();
        $cars = Car::all();
        $offices = Office::all();
        $rental_type = Booking::RENTA_TYPE;
        $status = StatusBooking::all();
        $booking->pick_up_date = date('Y-m-d\TH:i', strtotime($booking->pick_up_date));
        $booking->return_date = date('Y-m-d\TH:i', strtotime($booking->return_date));

        return view('admin.booking.edit-booking', compact('bookings', 'booking', 'rental_type', 'status', 'users', 'cars', 'offices'));
    }

    public function update($id, Request $request)
    {
        $booking =  Booking::find($id);
        $booking->user_id = $request->input('user_id');
        $booking->car_id = $request->input('car_id');
        $booking->pick_up_date = $request->input('pick_up_date');
        $booking->return_date = $request->input('return_date');
        $booking->pick_up_office_id = $request->input('pick_up_office_id');
        $booking->return_office_id = $request->input('return_office_id');
        $booking->status_id = $request->input('status_id');
        $booking->rental_type = $request->input('rental_type');
        $booking->save();

        return redirect()->back()->with('message', 'User has been updated successfully');
    }

    public function delete($id)
    {
        Booking::find($id)->delete();
        return redirect()->back()->with('message', 'Deleted');
    }
}
