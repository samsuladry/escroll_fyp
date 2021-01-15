<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Export\CsvImport;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;
use App\Imports\StudentsImport;
use App\Models\Student;
use App\Models\PreImport;
use App\Models\AcademicLevel;

class CsvController extends Controller
{
     public function import_csv(){
 
        $academic_level = AcademicLevel::all();

    	return view('backend.uploadcsv', compact('academic_level'));
    }

    public function store_csv(){

        request()->validate([
            'file'      =>  'required|mimes:csv,xls,xlsx',
            'batch'     =>  'required',
            'academic'  =>  'required',
        ]);

        if(!Excel::import(new StudentsImport, request()->file('file'))) return redirect()->back()->with('flash-danger', 'Invalid import format!');
        
        PreImport::where('university_id', auth()->user()->university->id)
                 ->update([
                    'batch'             => request()->batch,
                    'academic_levels_id'    => request()->academic,
                 ]);
        
    	return redirect('/admin/check');
    }

    public function update_ipfs(Request $request)
    {
        $academic_level = AcademicLevel::all();
        // dd($request->matricNumber);
        $matNo = explode(',', $request->matricNumber);
        $url = explode(',', $request->myURL);
        // dd($url);
        // dd($matNo);
        // foreach($request->matricNumber as $matNo)
        // {
        //      $student = Student::where('matric_number', $matNo)->get();
        // }

        $student = Student::whereIn('matric_number', $matNo)
                            ->orderBy('matric_number')
                            ->get();
        //    dd($student[1]->matric_number);
    //    for($i = 0;$i< count($matNo) ;$i++)
    //    {
    //        $matno[$i] = $student[$i]->matricNumber;
           
    //     //    $url[$i] = $url[]
    //    }
        //    dd($matNo);
        // foreach($student as $stu)
        // {
        //     // dd($stu);
        //     // dd($stu->name);
        //     // dd($stu->hash);
        //     // dd($request->myURL);
        //     for($i = 0;$i< count($url) ;$i++)
        //     {
        //         $stu->hash =$url[$i];
        //         $stu->save();
        //     }
        // }
        for($i = 0;$i< count($matNo) ;$i++)
        {
            $student[$i]->hash = $url[$i];
            $student[$i]->save();
        }
        // dd($student);
        // $student->hash = $request->myUrl;
        // $student->save();
        // return $request->input();
        // return redirect('/admin/check');
        return view('backend.uploadcsv', compact('academic_level'));
    }
}
