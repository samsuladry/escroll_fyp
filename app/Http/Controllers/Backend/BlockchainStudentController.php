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
use App\Scopes\UniversityScope;
use Carbon\Carbon;


class BlockchainStudentController extends Controller
{

    public function index(Request $request, Faculty $faculty)
    {
        $user_id = Auth::id();
        
        $students = Student::where('university_id', $user_id)->where('faculty_id', $faculty->id)->get();

        
        return view('backend.blockchainstudent', compact('students','faculty'));
    }


    public function getStudents(Request $request, $faculty)
    {
        // dd('test', $filter);
        // $faculty = Faculty::where('name', ucwords(str_replace('-', ' ', $faculty)))
		// 	->where('university_id', auth()->user()->university->id)
        //     ->first();
            // echo ($request);
		$students = Student::where('students.university_id', auth()->user()->university->id)
                           ->leftJoin('faculty', 'faculty.id', '=', 'students.faculty_id')
                           ->leftJoin('department', 'department.id', '=', 'students.department_id')
                           ->select('students.matric_number', 'students.name', 'faculty.name as faculty', 'department.name as bachelor', 'students.dean_id', 'students.rector_id', 'students.serial_no', 'students.date_endorse', 'students.citizenship', 'students.hash')
						   ->where('faculty.id', $faculty)
						   ->where('students.is_import', 0)
						   ->withoutGlobalScope(UniversityScope::class)
                           ->get()->toArray();
		// dd($students);
        return response()->json($students);
    }

    public function setStudentImport()
    {

        $student = Student::where('students.university_id', auth()->user()->university->id)
                          ->whereIn('matric_number', json_decode($_POST['imported_students']))
                          ->update([
                                'is_import'     => 1,
                                'updated_at'    => Carbon::now(),
                            ]);

        return response()->json(['success' => true]);
    }

}
