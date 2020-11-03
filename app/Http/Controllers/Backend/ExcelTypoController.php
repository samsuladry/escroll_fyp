<?php

namespace App\Http\Controllers\Backend;

use File;
use Carbon\Carbon;
use App\Models\Dean;
use App\Models\Department;
use App\Models\PreImport;
use App\Models\Faculty;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ExcelTypoController extends Controller
{
    public function index()
    {
        $faculties = PreImport::select('faculty')
                              ->where('is_import', 0)
                              ->groupBy('faculty')
                              ->orderBy('faculty')
                              ->get();

        $programmes = PreImport::select('programme')
                              ->groupBy('programme')
                              ->where('is_import', 0)
                              ->orderBy('programme')
                              ->get();

        $citizenships = PreImport::select('citizenship')
                                 ->groupBy('citizenship')
                                 ->where('is_import', 0)
                                 ->orderBy('citizenship')
                                 ->get();

        return view('backend.check.index', compact('faculties', 'programmes', 'citizenships'));
    }

    public function update(Request $request, $student){

        $student = PreImport::find($student);

        $student->matric_no     = $request->matric_no;
        $student->name          = $request->name;
        $student->faculty       = $request->faculty;
        $student->programme     = $request->programme;
        $student->citizenship   = $request->citizenship;
        $student->serial_no     = $request->serial_no;
        $student->date_endorse  = $request->date_endorse;
        $student->save();

        return redirect()->back()->with('flash_success', 'Successfully updated');
    }

    public function importFaculty(Request $request, $filter){

        $faculty = Faculty::where('name', ucwords(str_replace('-', ' ', $filter)))
                          ->where('user_id', Auth::id())
                          ->first();

        $university_id = auth()->user()->university->id;

        if(is_null($faculty)){
            $faculty = Faculty::create([
                'user_id'   => Auth::id(),
                'name'      => ucwords(str_replace('-', ' ', $filter)),
            ]);
        }

        $importData = PreImport::where('faculty', ucwords(str_replace('-', ' ', $filter)))
                               ->where('user_id', Auth::id())
                               ->get();

        $insert_data = collect();

        foreach($importData as $data){

            $department = Department::where('name', $data->programme)
                        ->first();

            $dean = Dean::where('faculty_id', $faculty->id)
                        ->where('active', 1)
                        ->first();

            if(is_null($department)){
                $department = Department::create([
                    'faculty_id'    => $faculty->id,
                    'name'          => $data->programme,
                ]);
            }

            $path = public_path('qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name);

            if(!File::exists($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            QrCode::size(100)->format('png')->generate(auth()->user()->uuid.'/'.$data->matric_no, $path.'\\'.$data->matric_no.'.png');
            
            $insert_data->push([
                'matric_number'     => $data->matric_no,
                'name'              => $data->name,
                'university_id'     => $university_id,
                'faculty_id'        => $faculty->id,
                'department_id'     => $department->id,
                'dean_id'           => (is_null($dean))? null : $dean->id,
                'qr_code_path'      => 'qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name.'\\'.$data->matric_no.'.png',
            ]);  

            $data->is_import = 1;
            $data->save();
        }

        foreach($insert_data->chunk(500) as $chunk){
            \DB::table('students')->insert($chunk->toArray());
        }

        return redirect()->route('admin.dashboard')->with('flash_success', 'Success import');
    }

    public function importProgramme(Request $request, $filter){

    }

    public function importCitizenship(Request $request, $filter){

    }

    public function faculty(Request $request, $faculty)
    {
        $students = PreImport::where('faculty', ucwords(str_replace('-', ' ', $faculty)))
                             ->where('user_id', Auth::id())
                             ->get();
        
        if ($request->ajax()) {
            return Datatables::of($students)
            ->addColumn('matric_no', function($students) {
                return $students->matric_no;
            })
            ->addColumn('name', function($students) {
                return $students->name;
            })
            ->addColumn('programme', function($students) {
                return $students->programme;
            })
            ->addColumn('citizenship', function($students) {
                return $students->citizenship;
            })
            ->addColumn('serial_no', function($students) {
                return $students->serial_no;
            })
            ->addColumn('date_endorse', function($students) {
                return Carbon::parse($students->date_endorse)->format('d-m-Y');
            })
            ->addColumn('actions', function($students) {
                 return view('backend.check.partials.action', compact('students'));
            })
            // ->rawColumns(['actions', 'section_head', 'is_active', 'description'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('backend.check.faculty', compact('students', 'faculty'));
    }

    public function programme(Request $request, $programme)
    {
        $students = PreImport::where('programme', strtoupper(str_replace('-', ' ', $programme)))
                             ->where('user_id', Auth::id())
                             ->get();

        if ($request->ajax()) {
            return Datatables::of($students)
            ->addColumn('matric_no', function($students) {
                return $students->matric_no;
            })
            ->addColumn('name', function($students) {
                return $students->name;
            })
            ->addColumn('faculty', function($students) {
                return $students->faculty;
            })
            ->addColumn('citizenship', function($students) {
                return $students->citizenship;
            })
            ->addColumn('serial_no', function($students) {
                return $students->serial_no;
            })
            ->addColumn('date_endorse', function($students) {
                return Carbon::parse($students->date_endorse)->format('d-m-Y');
            })
            ->addColumn('actions', function($students) {
                 return view('backend.check.partials.action', compact('students'));
            })
            // ->rawColumns(['actions', 'section_head', 'is_active', 'description'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('backend.check.programme', compact('students', 'programme'));
    }

    public function citizenship(Request $request, $citizenship)
    {
        $students = PreImport::where('citizenship', ucwords(str_replace('-', ' ', $citizenship)))
                             ->where('user_id', Auth::id())
                             ->get();
        
        if ($request->ajax()) {
            return Datatables::of($students)
            ->addColumn('matric_no', function($students) {
                return $students->matric_no;
            })
            ->addColumn('name', function($students) {
                return $students->name;
            })
            ->addColumn('faculty', function($students) {
                return $students->faculty;
            })
            ->addColumn('programme', function($students) {
                return $students->programme;
            })
            ->addColumn('serial_no', function($students) {
                return $students->serial_no;
            })
            ->addColumn('date_endorse', function($students) {
                return Carbon::parse($students->date_endorse)->format('d-m-Y');
            })
            ->addColumn('actions', function($students) {
                 return view('backend.check.partials.action', compact('students'));
            })
            // ->rawColumns(['actions', 'section_head', 'is_active', 'description'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('backend.check.citizenship', compact('students', 'citizenship'));
    }
}
