<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\EscrollTemplate;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Rector;
use App\Models\Dean;
use ZipArchive;
use File;

class EscrollController extends Controller
{
    public function index()
    {
        return view('backend.university.escroll-generate.index');
    }

    public function generate(Request $request)
    {
        set_time_limit(0);
        $university_id = auth()->user()->university->id;
        $downloaded = 1;
        $dean = Dean::where('id', 1)->first();

        $students = Student::where('university_id', $university_id)
                           ->orderBy('serial_no')
                           ->get();

        $rector = Rector::where('university_id', $university_id)
                        ->where('active', 1)
                        ->first();

        $template = EscrollTemplate::where('active', 1)
                                   ->where('university_id', $university_id)
                                   ->first();

        if($template->escrollSetup->landscape == 1){
            $landscape = 'landscape';
            $width = 1080;
            $height = 790;
        }
        else{
            $landscape = 'portrait';
            $height = 1080;
            $width = 790;
        }

        $directory = 'pdf/'.auth()->user()->university->acronym;

        if(Storage::disk('public')->exists($directory)){
            storage::disk('public')->deleteDirectory($directory);
        }

        if(!Storage::disk('public')->exists($directory)){
            Storage::disk('public')->makeDirectory($directory);
        }

        foreach ($students as $student) {
            if(connection_aborted()){
                Storage::disk('public')->deleteDirectory('pdf/'.auth()->user()->university->acronym);
                return response()->json(['msg' => 'User closed the browser'], 500);
            }
            if(is_null($student->dean_id)){
                $faculty = Faculty::where('id', $student->faculty_id)->first();
                return response()->json(['msg' => 'Dean not assigned for '.$faculty->name], 500);
            }

            if($dean->id != $student->dean_id){
                $dean = Dean::where('id', $student->dean_id)->first();
            }

            $pdf = PDF::loadView('backend.university.escroll.index', compact('template', 'student','rector','dean', 'downloaded', 'width', 'height'))->setPaper('a4', $landscape);
            $file = public_path('storage/'.$directory).'/'.$student->matric_number.'.pdf';
            $pdf->save($file);

            $student->pdf_doc_path = 'storage/'.$directory.'/'.$student->matric_number.'.pdf';
            $student->save();
        }

        return response()->json(['success' => 1 ], 200);
    }

    public function check_percentage(Request $request)
    {
        $total = $request->totalStudents;
        $total_files = count(File::files(public_path('storage/pdf/'.auth()->user()->university->acronym)));

        return response()->json(['total' => floor(($total_files/$total) * 100), 'total_files' => $total_files, 'totalStudents' => $total], 200);
    }

    public function getTotalStudents()
    {
        $total = Student::where('university_id', auth()->user()->university->id)
                        ->orderBy('serial_no')
                        ->get()
                        // ->take(1000)
                        ->count();

        if(is_null($total) || $total == 0){
            response()->json(['msg' => 'Failed to get total students'], 500);
        }

        return response()->json(['total' => $total], 200);
    }

    public function download_zip(){
        set_time_limit(0);
        $zip_file = public_path('storage/pdf/').auth()->user()->university->acronym.'.zip';
        $zip = new ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = storage_path('app/public/pdf/'.auth()->user()->university->acronym);
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();

                // extracting filename with substr/strlen
                $relativePath = auth()->user()->university->acronym.'/' . substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        Storage::disk('public')->deleteDirectory('pdf/'.auth()->user()->university->acronym);
        return response()->download($zip_file);
    }
}
