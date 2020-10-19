<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Export\CsvImport;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use Ramsey\Uuid\Uuid;


use App\Models\University;
use App\Imports\StudentsImport;
use App\Models\Auth\User;
use App\Models\Student;
use App\Models\Rector;
use App\Models\Faculty;
use App\Models\Dean;
use App\Models\Department;
use App\Models\Bachelor;
use App\Models\EscrollTemplate;
use App\Models\Certificate;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    public function test(){


        return view('backend.university.escroll.index');
    }

    // public function sign_pdf($students){
        
    //     $user_id = Auth::id();
    //     $certificate_info = Certificate::where('user_id', $user_id)->first();
    //     $name = $certificate_info->name;
    //     $location = $certificate_info->location;
    //     $reason = $certificate_info->reason;
    //     $contact_info = $certificate_info->contact_info;
    //     $certificate = $certificate_info->certificate;

    //     $info = array(
    //         'Name' => $name,
    //         'Location' => $location,
    //         'Reason' => $reason,
    //         'ContactInfo' => $certificate,
    //     );

    //     PDF::setSignature($certificate, $certificate, 'password', '', 2, $info);
    //     PDF::SetFont('helvetica', '', 12);
    //     PDF::SetTitle('E-Scroll');
    //     PDF::AddPage();

    //     // print a line of text
    //     $text = view('frontend.tcpdf');

    //     // add view content
    //     PDF::writeHTML($text, true, 0, true, 0);

    //     // add image for signature
    //     PDF::Image('tcpdf.png', 180, 60, 15, 15, 'PNG');

    //     // define active area for signature appearance
    //     PDF::setSignatureAppearance(180, 60, 15, 15);

    //     // save pdf file
    //     PDF::Output(public_path('hello_world2.pdf'), 'F');

    //     PDF::reset();

    //     dd('pdf created');

    // }

    public function graduate_student(){

    	$students = Student::where('qr_code_key', '<>', null)->get();
    	return view('backend.graduate-student', compact('students'));
    }


    public function view_faculty_graduate(Faculty $faculty){

        $students = Student::where('faculty_id', $faculty->id)->get();

        if ($students[1]->qr_code_path === null) {
            $status = "Generate_QR";
        }
        else if ($students[1]->qr_code_path !== null) {
            $status = "Generate_PDF";
        }
        return view('backend.university.faculty.graduatestudent')
        ->with(compact('students', 'faculty'))
        ->with(['status' => $status]);
    }

    // public function generate_qr_faculty_graduate($students){

    //     dd('okyesdsd');

    //     $students = Student::where('faculty_id', $faculty)->where('qr_code_path', null)->get();

    //     if(count($students)){
        
    //     foreach ($students as $student) {

    //     $qr_code_key = $student->uuid;
    //     $id = $student->id;

    //     $image = QrCode::format('png')
    //              ->size(200)->errorCorrection('H')
    //              ->generate($qr_code_key);


    //     $image_name = 'img-'.$qr_code_key.'-' . time() . '.png';
    //     $directory = "qr-code";
    //     $path = "/public/$directory/$image_name";

    //     $image_storage_path = "qr-code/$image_name";

    //     $qrcode = Storage::disk('local')->put($path, $image);

    //     DB::table('students')->where('id', $id)
    //     ->update(['qr_code_path' => $image_storage_path]);
    //     }
    //     return redirect()->back()->with('flash_success','Successfully generate QR Code');
    //     }
    //     else{
    //         return redirect()->back()->with('flash_danger','QR Code already been generated for all student in this faculty');
    //     }

    // }

     public function view_department_graduate(Faculty $faculty, Department $department){

        $students = Student::where('department_id', $department->id)->get();
        return view('backend.university.department.graduatestudent')->with(compact('students'));

    }

       public function generate_qr_code(){

        $students = Student::where('qr_code_key', null)->get();
        return view('backend.generate-qrcode', compact('students'));

    }



    public function view_cert(Student $student)
    {
        $university = $student->university;
        $college = $student->faculty;
        $logo = University::where('keyword', $university)->pluck('logo')->first();
        $rector_sign = University::where('keyword', $university)->pluck('signature')->first();
        $dean_sign = College::where('keyword', $college)->pluck('signature')->first();


        return view('backend.view-cert')
        ->with(compact('student'))
        ->with(['logo' => $logo])
        ->with(['rector_sign' => $rector_sign])
        ->with(['dean_sign' => $dean_sign]);
    }


    public function view_cert_pdf(University $university, College $college, Student $student)
    {

        $title = $student->name;
        $field = $student->field;
        $uni_keyword = $student->university;
        $college_keyword = $student->faculty;
        $rector_sign = University::where('keyword', $uni_keyword)->pluck('signature')->first();
        $dean_sign = College::where('keyword', $college_keyword)->pluck('signature')->first();
        $qr_code = $student->qr_code_path;


        $img_rector_sign = "storage/$rector_sign";
        $img_dean_sign = "storage/$dean_sign";
        $img_qr_code ="storage/$qr_code";

        $html_content = '

        <br><br><br><br><br><br>
        <div>
        <h3 style="text-align:center;">By the authority of the Senate it is hereby certified that</h3>
        <h1 style="text-align:center;font-size:28px;">' . $title . '</h1>

         <h3 style="text-align:center;">Having fulfilled all the requirements and having passed all the prescribed <br> examinations has been conferred the degree of</h3>

        <h1 style="text-align:center;font-size:25px;">' . $field . '</h1>

        <p style="text-align:center;">29-September-2020</p>
        </div>
   
        <div class="row" >
        <br><br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             <img src="'.$img_rector_sign.'" height="100" height="100">

            

             <img src="'.$img_dean_sign.'" height="100" height="100">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


             <img  src="'.$img_qr_code.'" height="100" height="100">
            

        </div>
        

        ';  
 
        PDF::SetTitle($title);
        PDF::AddPage('L', 'A4');
        PDF::writeHTML($html_content, true, false, true, false, '');

 
        PDF::Output('SamplePDF.pdf');
    }



    
}
