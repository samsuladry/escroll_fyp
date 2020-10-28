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


class CsvController extends Controller
{
     public function import_csv(){
 
    	return view('backend.uploadcsv');
    }

    public function store_csv(){
 		
         Excel::import(new StudentsImport, request()->file('file'));
         
    	return redirect('/admin/check');
    }
}
