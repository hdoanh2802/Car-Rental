<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Car_Type;
use App\Models\Office;
use App\Traits\StorageImage;

class CarController extends Controller
{
    use StorageImage;

    public function index()
    {
        $cars = Car::orderByDesc('created_at')->paginate(5);
        return view('admin.car.list-car', compact('cars'));
    }

    public function create()
    {
        $brands = BrandCar::all();
        $offices = Office::all();
        $car_types = Car_Type::all();
        return view('admin.car.add-car', compact('car_types', 'offices', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
            'color' => 'required',
            'brand_id' => 'required|max:10',
            'description' => 'min:10|max:40',
            'purch_date' => 'required',
            'price_start' => 'required',
            'price_hourly' => 'required'
        ]);

        $car = new Car();
        $car->type_id = $request->input('type_id');
        $car->office_id = $request->input('office_id');
        $car->name = $request->input('name');
        $car->color = $request->input('color');
        $car->brand_id = $request->input('brand_id');
        $car->description = $request->input('description');
        $car->purch_date = $request->input('purch_date');
        $car->price_start = $request->input('price_start');
        $car->price_hourly = $request->input('price_hourly');


        $dataUploadImage = $this->storageImage($request, 'image_path', 'car');
        if (!empty($dataUploadImage)) {
            $car['image_name'] = $dataUploadImage['file_name'];
            $car['image_path'] = $dataUploadImage['file_path'];
        }

        $car->save();
        return redirect()->route('car.list')->with('message', 'New car has been added successfully');
    }

    public function edit($id)
    {
        $car = Car::find($id);
        $brands = BrandCar::all();
        $offices = Office::all();
        $car_types = Car_Type::all();
        $car->purch_date = date('Y-m-d\TH:i', strtotime($car->purch_date));
        $cars = Car::all();

        return view('admin.car.edit-car', compact('car', 'brands', 'offices', 'car_types','cars'));
    }

    public function update($id, Request $request)
    {
        $car =  Car::find($id);
        $car->type_id = $request->input('type_id');
        $car->office_id = $request->input('office_id');
        $car->name = $request->input('name');
        $car->color = $request->input('color');
        $car->brand_id = $request->input('brand_id');
        $car->description = $request->input('description');
        $car->purch_date = $request->input('purch_date');
        $car->price_start = $request->input('price_start');
        $car->price_hourly = $request->input('price_hourly');

        $dataUploadImage = $this->storageImage($request, 'image_path', 'car');
        if (!empty($dataUploadImage)) {
            $car['image_name'] = $dataUploadImage['file_name'];
            $car['image_path'] = $dataUploadImage['file_path'];
        }
        $car->save();

        return redirect()->route('car.list')->with('message', 'Car has been updated successfully');
    }

    public function delete($id)
    {
        Car::find($id)->delete();
        return redirect()->route('car.list')->with('message', 'delete success');
    }
}
