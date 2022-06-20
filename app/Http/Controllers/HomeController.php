<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Car_Type;
use App\Models\Office;
use App\Models\PayPal;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $total_user = User::count();
        $total_car = Car::count();
        $unique_visitors = Booking::count('user_id');
        $sale = PayPal::where('status', 'completed')->sum('total_paypal');

        $res = DB::select(DB::raw("select count(booking.car_id) as total,cars.name from cars,booking WHERE cars.id = booking.car_id group by name"));
        $chart_data = "";
        foreach ($res as $list) {
            $chart_data .= "['" . $list->name . "',     " . $list->total . "],";
        }
        $data = $chart_data;

        $res1 = DB::select(DB::raw("SELECT SUM(paypal.total_paypal) as sum_total, DATE_FORMAT(paypal.created_at, '%m-%Y') AS year_and_month FROM paypal GROUP BY year_and_month"));
        $data1 = "";
        $arr = ['#b87333', '#silver', '#e5e4e2'];
        foreach ($res1 as $list1) {
            $data1 .= '["' . $list1->year_and_month . '", ' . $list1->sum_total . ', " #silver "],';
        }
        $data2 = $data1;

        return view('dashboard', compact('total_user', 'total_car', 'unique_visitors', 'sale', 'data', 'data2'));
    }

    public function home(HttpRequest $request)
    {
        $search = $request->input('search');
        if ($search != "") {
            $cars =  Car::where('name', 'like', '%' . $search . '%')->paginate(6);
        }
        if ($search == "") {
            $cars = Car::paginate(6);
        }

        $car_types = Car_Type::all();
        $offices = Office::all();
        return view('home', compact('cars', 'search', 'car_types', 'offices'));
    }

    public function searchByType(
        HttpRequest $request,
        $slug,
        $id
    ) {
        $search = $request->input('search');
        if ($search != "") {
            $cars =  Car::where('name', 'like', '%' . $search . '%')->get();
        }
        if ($search == "") {
            $cars = Car::paginate(6);
        }
        $cars = Car::where('type_id', $id)->paginate(6);
        $car_types = Car_Type::all();
        $type_label = Car_Type::where('id', $id)->first();
        $offices = Office::all();

        return view('user.search-car-by-type', compact('cars', 'car_types', 'search', 'type_label', 'offices'));
    }
}
