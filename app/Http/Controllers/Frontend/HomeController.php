<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\University;
use App\Models\College;
/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function scan_qr($id){

    	$student = Student::where('id', $id)->first();

    	$university = $student->university;
        $college = $student->faculty;
        $qr_code = $student->qr_code_path;

        $logo = University::where('keyword', $university)->pluck('logo')->first();
        $rector_sign = University::where('keyword', $university)->pluck('signature')->first();
        $dean_sign = College::where('keyword', $college)->pluck('signature')->first();

        return view('frontend.view-cert')
        ->with(compact('student'))
        ->with(['logo' => $logo])
        ->with(['rector_sign' => $rector_sign])
        ->with(['dean_sign' => $dean_sign])
        ->with(['qr_code' => $qr_code]);

    }

    public function scanner(){
        return view('frontend.scanner');
    }

    public function authenticate_uuid($uuid){

        $result = Student::where('uuid', $uuid)->first();

        if(isset($result)){
            return $result;
        }
        else{
            $result = 0 ;
            return $result;
        }
    }

    public function certificate_uuid($uuid){
        $student = Student::where('uuid', $uuid)->first();

        return view('frontend.view-cert', compact('student'));
    }

    public function system_flow(){
        return view('frontend.system_flow');
    }
}
