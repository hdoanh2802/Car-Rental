<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::paginate(5);

        return view('admin.office.list-office', compact('offices'));
    }

    public function create()
    {
        return view('admin.office.add-office');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $office = new Office();
        $office->name = $request->input('name');
        $office->address = $request->input('address');

        $office->save();

        return redirect()->route('office.list')->with('message', 'New ofice has been added successfully');
    }

    public function edit($id)
    {
        $office =  Office::find($id);
        return view('admin.office.edit-office', compact('office'));
    }

    public function update($id, Request $request)
    {
        $office =  Office::find($id);
        $office->name = $request->input('name');
        $office->address = $request->input('address');

        $office->save();

        return redirect()->route('office.list')->with('message', 'Office has been updated successfully');
    }

    public function delete($id)
    {
        Office::find($id)->delete();
        
        return redirect()->route('office.list')->with('message', 'Office has been deleted successfully');
    }
}
