<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class ExcelCSVController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function showImport()
    {
        return view('admin.excel-import-export.excel-csv');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExcel(Request $request)
    {
        $file = $request->file('file')->store('import');

        $import = new UsersImport;
        $import->queue($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->with('message', 'Excel file imported successfully');
    }

    public function exportExcel()
    {
        return (new UsersExport)->download('users.xlsx');
    }
}
