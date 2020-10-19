<?php

namespace App\Http\Controllers\Backend;

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


class CsvController extends Controller
{
     public function import_csv(){
 
    	return view('backend.uploadcsv');
    }

    public function store_csv(){
 		
 		Excel::import(new StudentsImport, request()->file('file'));
        $students = Student::whereNull('uuid')->get();

        foreach ($students as $student) {
            $uuid = Uuid::uuid4();
            $uuid = $uuid->toString();
            $student->update(['uuid' => $uuid]);
        }
    	return redirect('/admin/faculty');
    }
}
