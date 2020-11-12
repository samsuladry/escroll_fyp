<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Certificate;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

use App\Http\Controllers\Backend\DashboardController;

class FacultyController extends Controller
{
    public function view_faculty(Request $request)
    {
        $user_id = Auth::id();
        $search = '';

        if(isset($request->search)){
            $search = $request->search;
            $faculties = Faculty::where('user_id', $user_id)
                                ->where(function ($query) use ($search) {
                                    $query->where('name', 'like', '%'.$search.'%');
                                })
                                ->paginate(15);
        }
        else{
            $faculties = Faculty::where('user_id', $user_id)->paginate(15);
        }

        return view('backend.university.faculty.index')->with(compact('faculties', 'search'));
    }

    public function add_faculty()
    {
        return view('backend.university.faculty.add');
    }

     public function store_faculty(Request $request){

        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
        ]);

        $rector = Faculty::create($request->all());
        return redirect('admin/faculty');
    }

      public function edit_faculty(Faculty $faculty)
      {
        return view('backend.university.faculty.edit')->with(compact('faculty'));
    }

      public function update_faculty(Request $request,Faculty $faculty)
      {
        $faculty->update($request->all());

        return redirect('admin/faculty');
    }

    public function view_faculty_graduate(Request $request, Faculty $faculty)
    {
        $user_id = Auth::id();

        $search = '';

        if(isset($request->search)){
            $search = $request->search;
            $students = Student::where('university_id', auth()->user()->university->id)
                               ->where('students.faculty_id', $faculty->id)
                               ->leftJoin('department', 'department.id', '=', 'students.department_id')
                               ->where(function ($query) use ($search) {
                                    $query->where('students.name', 'like', '%'.$search.'%')
                                          ->orWhere('students.matric_number', 'like', '%'.$search.'%')
                                          ->orWhere('department.name', 'like', '%'.$search.'%');
                               })
                               ->select('students.id', 'students.name', 'students.matric_number', 'students.qr_code_path', 'students.department_id')
                               ->orderBy('pdf_doc_path')
                               ->orderBy('students.name')
                               ->paginate(15);
        }
        else{
            $students = Student::where('university_id', auth()->user()->university->id)
                               ->where('faculty_id', $faculty->id)
                               ->orderBy('pdf_doc_path')
                               ->orderBy('students.name')
                               ->paginate(15);
        }
        

        return view('backend.university.faculty.graduatestudent', compact('students','faculty', 'search'));
    }

    public function activate_faculty_graduate(Request $request)
    {      
        // $extension = $request->file('certificate')->getClientOriginalExtension();

        // $filename = uniqid().'.'.$extension; 
        // Storage::disk('public')->putFileAs('digital-certificate/', $request->file('certificate'), $filename);

        // $path = 'digital-certificate/'.$filename;

  
        // DB::table('certificate_info')->where('user_id', $request->user_id)
        // ->update(['certificate'=> $path]);

        $students = Student::where('faculty_id', $request->faculty_id)->where('qr_code_path', null)->get();
        $faculty = Faculty::where('id', $request->faculty_id)->first();




        // FacultyController::generate_qr_faculty_graduate($students, $faculty);
        // FacultyController::generate_qr_faculty_graduate($students, $faculty);

        // comment jap bcs openssl_pkcs7_sign(): error getting private key
        // FacultyController::sign_pdf($students, $faculty);
        
        return view('backend.university.faculty.graduatestudent', compact('students','faculty'));
    }

    public function generate_qr_faculty_graduate($students, $faculty){


        $students = Student::where('faculty_id', $faculty->id)->where('qr_code_path', null)->get();


        if(count($students)){
        
        foreach ($students->chunk(500) as $student) {

            $qr_code_key = $student->uuid;
            $id = $student->id;

            $image = QrCode::format('png')
                    ->size(200)->errorCorrection('H')
                    ->generate($qr_code_key);


            $image_name = 'img-'.$qr_code_key.'-' . time() . '.png';
            $directory = "qr-code";
            $path = "/public/$directory/$image_name";

            $image_storage_path = "qr-code/$image_name";

            $qrcode = Storage::disk('local')->put($path, $image);

            DB::table('students')->where('id', $id)
            ->update(['qr_code_path' => $image_storage_path]);
            }
        }

    }

        public function sign_pdf($students, $faculty){


        $user_id = Auth::id();
        $certificate_info = Certificate::where('user_id', $user_id)->first();

        $name = $certificate_info->name;
        $location = $certificate_info->location;
        $reason = $certificate_info->reason;
        $contact_info = $certificate_info->contact_info;
        $cert_path = $certificate_info->certificate;
        $path = 'app/public/'.$cert_path;
        $certificate = 'file://'.storage_path($path);



        $info = array(
            'Name' => $name,
            'Location' => $location,
            'Reason' => $reason,
            'ContactInfo' => $contact_info,
        );

        PDF::setSignature($certificate, $certificate, 'password', '', 2, $info);
        PDF::SetFont('helvetica', '', 12);
        PDF::SetTitle('E-Scroll');
        PDF::AddPage();

        $text = view('frontend.tcpdf');
        PDF::writeHTML($text, true, 0, true, 0);
        PDF::Image(public_path('signature.png'), 200, 130, 25, 25, 'PNG');
        PDF::setSignatureAppearance(180, 60, 15, 15);
        PDF::Output(public_path('hello_world.pdf'), 'F');

        $file = asset('hello_world.pdf');
        $destination = storage_path('hello_world.pdf');
        Storage::move($file,$destination);

        PDF::reset();
        

        // foreach ($students as $student) {

        // $name = $student->name;
        // $id = $student->id;
        // $field = $student->graduate_field->title;

        // PDF::setSignature($certificate, $certificate, 'password', '', 2, $info);
        // PDF::SetFont('helvetica', '', 12);
        // PDF::SetTitle('E-Scroll');
        // PDF::AddPage('L', 'A4');



        // PDF::Image(public_path('cert.jpg'), 10, 10, 600, 400, 'JPG');

        // PDF::Image(public_path('qrcode.png'), 130, 130, 30, 30, 'PNG');

        // PDF::Image(public_path('signature.png'), 200, 130, 25, 25, 'PNG');

        // PDF::Image(public_path('signature.png'), 70, 130, 25, 25, 'PNG');

        // PDF::SetY(90);

        // PDF::writeHTML($name, true, false, false, false, 'C');

        // PDF::SetY(108);
        // PDF::writeHTML($field, true, false, false, false, 'C');

        // $pdf_name = 'pdf-'.$name.'-' . time() . '.pdf';

        // $directory = $faculty->name ;
        // $path = "/public/$directory/$pdf_name";

        // PDF::Output(public_path('hello_world.pdf'), 'F');


        // PDF::Output($pdf_name);

        // $qrcode = Storage::disk('local')->put($path, $pdf_doc);


        // $pdf_storage_path = "$directory/$pdf_name";


        // DB::table('students')->where('id', $id)
        // ->update(['qr_doc_path' => $pdf_storage_path]);

        // PDF::reset();

        // }



        dd('pdf done created');


}
}
