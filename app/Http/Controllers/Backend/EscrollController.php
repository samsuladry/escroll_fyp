<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\EscrollTemplate;
use App\Models\AcademicLevel;
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
        $academic_levels = AcademicLevel::all();
        $batches = Student::select('batch')
                          ->groupBy('batch')
                          ->orderBy('batch', 'desc')
                          ->get();

        if(Storage::disk('public')->exists('zip')){
            Storage::disk('public')->makeDirectory('zip');
        }

        $file_names = [];
        foreach(File::files(public_path('storage/zip')) as $file)
        {
            if(substr(basename($file), 0, strlen(auth()->user()->university->acronym)) == auth()->user()->university->acronym)
            {
                array_push($file_names, basename($file));
            }
        }

        return view('backend.university.escroll-generate.index', compact('file_names', 'batches', 'academic_levels'));
    }

    public function removeFolder()
    {
        $directory = 'pdf/'.auth()->user()->university->acronym;

        if(Storage::disk('public')->exists($directory)){
            do{
                storage::disk('public')->deleteDirectory($directory);
            }while(Storage::disk('public')->exists($directory));
        }

        return response()->json(['success' => 1 ], 200);
    }
    
    public function generate(Request $request)
    {
        set_time_limit(0);
        $university_id = auth()->user()->university->id;
        $downloaded = 1;
        $dean = Dean::where('id', 1)->first();

        $students = Student::where('university_id', $university_id)
                           ->where('batch', $request->batch)
                           ->where('academic_levels_id', $request->academic_level)
                           ->orderBy('serial_no')
                           ->get()#;
                           ->take(100);

        $academic_level = AcademicLevel::find($request->academic_level);

        $rector = Rector::university()
                        ->where('active', 1)
                        ->first();

        $template = EscrollTemplate::where('active', 1)
                                   ->university()
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

        if(!Storage::disk('public')->exists($directory)){
            Storage::disk('public')->makeDirectory($directory);
        }

        foreach ($students as $student) {
            if(connection_aborted()){
                Storage::disk('public')->deleteDirectory('pdf/'.auth()->user()->university->acronym);
                exit();
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
            $file = public_path('storage/'.$directory).'/'.$student->serial_no.'.pdf';
            $pdf->save($file);

            $student->pdf_doc_path = 'storage/'.$directory.'/'.$student->serial_no.'.pdf';
            $student->save();
            $pdf = null;
            $file = null;
            $faculty = null;
        }

        return response()->json(['success' => 1, 'batch' => $request->batch, 'academic_level' => $academic_level->name], 200);
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
                        ->take(100)
                        ->count();

        if(is_null($total) || $total == 0){
            response()->json(['msg' => 'Failed to get total students'], 500);
        }

        return response()->json(['total' => $total], 200);
    }

    public function download_zip()
    {
        set_time_limit(0);
        if(!Storage::disk('public')->exists('zip')){
            Storage::disk('public')->makeDirectory('zip');
        }

        if(request()->download == 'true'){
            $zip_file = public_path('storage/zip/').request()->filename;
            return response()->download($zip_file, auth()->user()->university->acronym);
        }
        // try{

        // }catch(){

        // }
        $zip_file = public_path('storage/zip/').request()->filename.'.zip';

        $zip = new ZipArchive();
        // dd('pass', $zip_file);
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        // dd('pass', $zip_file);
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
        // Storage::disk('public')->deleteDirectory('pdf/'.auth()->user()->university->acronym);
        return response()->download($zip_file);
    }
}
