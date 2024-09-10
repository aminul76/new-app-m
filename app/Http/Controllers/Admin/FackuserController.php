<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Fackuser;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\Importable;

class FackuserController extends Controller
{
    use Importable;

    public function fackusershowImportForm()
    {
        return view('backend.fackuser.index');
    }

    public function fackuserimport(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        Excel::import(new class implements ToArray
        {
            public function array(array $array)
            {
                foreach ($array as $row) {
                    // Skip header row or any invalid data
                    if (isset($row[0]) && !empty($row[0])) {
                        Fackuser::create([
                            'f_name' => $row[0], // Adjust this based on your Excel structure
                        ]);
                    }
                }
            }
        }, $file);

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
