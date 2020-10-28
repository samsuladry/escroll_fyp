<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\PreImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ExcelTypoController extends Controller
{
    public function index()
    {
        $faculties = PreImport::select('faculty')
                              ->groupBy('faculty')
                              ->orderBy('faculty')
                              ->get();

        $programmes = PreImport::select('programme')
                              ->groupBy('programme')
                              ->orderBy('programme')
                              ->get();

        $citizenships = PreImport::select('citizenship')
                                ->groupBy('citizenship')
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
