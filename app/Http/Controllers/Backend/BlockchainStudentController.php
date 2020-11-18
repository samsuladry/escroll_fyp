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


class BlockchainStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Faculty $faculty)
    {
        $user_id = Auth::id();
        
        $students = Student::where('university_id', $user_id)->where('faculty_id', $faculty->id)->get();

        
        return view('backend.blockchainstudent', compact('students','faculty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStudents()
    {
        $students = Student::where('university_id', auth()->user()->university->id)
                           ->where('matric_number', '1515680')
                           ->select('matric_number', 'name' )
                        //    ->where('is_import', 0)
                           ->get()->toArray();

        return response()->json($students);
    }

    public function setStudentImport($matric_no)
    {
        // dd('set student import');
        dd($_POST['student_json']);
        $student = Student::where('matric_number', $matric_no)
                          ->where('university_id', auth()->user()->university->id)
                          ->first();
        if(!is_null($student))
        {
            $student->update([
                        'is_import'  => 1,
                    ]);

            return response()->json(['success' => true]);
        }
        else return response()->json(['success' => false]);
    }

}
