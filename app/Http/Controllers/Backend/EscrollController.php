<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\EscrollTemplate;
use App\Models\Student;
use App\Models\Dean;
use ZipArchive;

class EscrollController extends Controller
{
    public function index()
    {
        return view('backend.university.escroll-generate.index');
    }

    public function generate(Request $request){
        
        $university_id = auth()->user()->university->id;
        $downloaded = 1;
        $students = Student::where('university_id', $university_id)
                           ->where('pdf_doc_path', null)
                           ->where('dean_id', $dean_id)
                           ->orderBy('serial_no')
                           ->get()
                           ->take(1000);
        
        $dean = Dean::where('id', $dean_id)->first();

        $rector = Rector::where('university_id', $university_id)
                        ->where('active', 1)
                        ->first();

        $template = EscrollTemplate::where('active', 1)
                                   ->where('university_id', $university_id)
                                   ->first();

        $directory = 'pdf/'.auth()->user()->university->acronym;

        if(!Storage::disk('public')->exists($directory)){
            Storage::disk('public')->makeDirectory($directory);
        }

        foreach ($students as $student) {

            $pdf = PDF::loadView('backend.university.escroll.index', compact('template', 'student','rector','dean', 'downloaded'))->setPaper('a4', $landscape);
            $file = public_path('storage/'.$directory).'/'.$student->matric_number.'.pdf';
            $pdf->save($file);

            $student->pdf_doc_path = $file;
            $student->save();
        }

        $postStudents = Student::where('university_id', $university_id)
                               ->where('pdf_doc_path', null)
                               ->where('dean_id', $dean_id)
                               ->first();

        $finish = 0;

        if(is_null($postStudents)){
            $finish = 1;
        }

        return response()->json(['success' => 1, 'finish' => $finish ], 200);

        // for($i = 1; $i <= 4063; $i++){
        //     for($j = 0; $j < 100; $j++){
        //         if($j == 99){
        //             Student::where('id', $i)->where('is_import', 1)->update([
        //                 'is_import' => 0
        //             ]);
        //         }
        //     }
            
        // }

        // return response()->json(['success'=> 'successs']);
    }

    public function check_percentage(){
        $total = Student::all()->count();
        $current = Student::where('pdf_doc_path', null)->count();
        echo floor(($current/$total) * 100);
    }

    public function getDeanCount(){
        $deans = Student::where('university_id', auth()->user()->university->id)
                        ->where('pdf_doc_path', null)
                        ->groupBy('dean_id')
                        ->pluck('dean_id')
                        ->toArray();;

        foreach($deans as $dean){
            if($dean == null){
                return response()->json(['msg' => 'Dean not assigned'], 422);
            }
        }

        return response()->json(['data' => $deans], 200);
    }

    public function getTotalStudents(){
        $total = Student::where('university_id', auth()->user()->university->id)
                          ->where('pdf_doc_path', null)
                          ->get()
                          ->count();

        return response()->json(['total' => $total], 200);
    }
}
