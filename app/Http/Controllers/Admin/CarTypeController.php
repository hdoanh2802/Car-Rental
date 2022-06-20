<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car_Type;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Illuminate\Support\Facades\Session;

class CarTypeController extends Controller
{
    public function index(HttpFoundationRequest $request)
    {
        $search = $request->get('name');
        if ($search != "") {
            $car_types =  Car_Type::where('label', 'like', '%' . $search . '%')->paginate(5);
            // if ($car_types == "") {
            //     Session::flash('message', 'Type not found');
            // }
        }
        if ($search == "") {
            $car_types = Car_Type::orderByDesc('created_at')->paginate(5);
        }

        return view('admin.car-type.list-type-car', compact('car_types', 'search'));
    }

    public function create()
    {
        return view('admin.car-type.add-type-car');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
        ]);

        $car_type = new Car_Type();
        $car_type->label = $request->input('label');
        $car_type->description = $request->input('description');

        $car_type->save();

        return redirect()->route('car-type.list')->with('message', 'more success');
    }

    public function edit($id)
    {
        $car_type = Car_Type::find($id);

        return view('admin.car-type.edit-type-car', compact('car_type'));
    }

    public function update($id, Request $request)
    {
        $car_type =  Car_Type::find($id);
        $car_type->label = $request->input('label');
        $car_type->description = $request->input('description');

        $car_type->save();

        return redirect()->route('car-type.list')->with('message', 'Update success');;
    }

    public function delete($id)
    {
        Car_Type::find($id)->delete();

        return redirect()->route('car-type.list')->with('message', 'Deleted');
    }
}
