<?php

namespace App\Http\Controllers\Backend;

use File;
use Carbon\Carbon;
use App\Models\Dean;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\PreImport;
use App\Models\Rector;
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
        $student->date_endorse  = Carbon::parse($request->date_endorse);
        $student->save();

        return redirect()->back()->with('flash_success', 'Successfully updated');
    }

    public function importFaculty(Request $request, $filter){
        set_time_limit(3000);
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
                               ->where('is_import', 0)
                               ->get();

        $insert_data = collect();

        foreach($importData as $data){

            $department = Department::where('name', $data->programme)
                        ->first();

            $dean = Dean::where('faculty_id', $faculty->id)
                        ->where('active', 1)
                        ->first();
            $rector = Rector::where('university_id', auth()->user()->university->id)
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

            QrCode::format('png')->margin(0)->size(200)->generate(auth()->user()->uuid.'/'.$data->matric_no, $path.'\\'.$data->matric_no.'.png');
            
            $insert_data->push([
                'matric_number'     => $data->matric_no,
                'name'              => $data->name,
                'university_id'     => $university_id,
                'faculty_id'        => $faculty->id,
                'department_id'     => $department->id,
                'dean_id'           => (is_null($dean))? null : $dean->id,
                'rector_id'         => (is_null($rector))? null : $rector->id,
                'serial_no'         => $data->serial_no,
                'date_endorse'      => $data->date_endorse,
                'citizenship'       => $data->citizenship,
                'qr_code_path'      => 'qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name.'\\'.$data->matric_no.'.png',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);  

            $data->is_import = 1;
            $data->save();
        }

        foreach($insert_data->chunk(500) as $chunk){
            \DB::table('students')->insert($chunk->toArray());
        }

        return redirect()->route('admin.check.index')->with('flash_success', 'Success import');
    }

    public function importProgramme(Request $request, $filter)
    {
        set_time_limit(3000);

        $university_id = auth()->user()->university->id;

        $importData = PreImport::where('programme', str_replace('-', ' ', $filter))
                               ->where('user_id', Auth::id())
                               ->where('is_import', 0)
                               ->get();

        $insert_data = collect();

        foreach($importData as $data){
            $faculty = Faculty::where('name', $data->faculty)
                              ->where('user_id', Auth::id())
                              ->first();
            
            if(is_null($faculty)){
                $faculty = Faculty::create([
                    'user_id'       => Auth::id(),
                    'name'          => $data->faculty,
                ]);
            }

            $dean = Dean::where('faculty_id', $faculty->id)
                        ->where('active', 1)
                        ->first();

            $rector = Rector::where('university_id', auth()->user()->university->id)
                            ->where('active', 1)
                            ->first();

            $programme = Department::where('faculty_id', $faculty->id)
                                   ->where('name', str_replace('-', ' ', $filter))
                                   ->first();
            
            if(is_null($programme)){
                $programme = Department::create([
                    'faculty_id'    => $faculty->id,
                    'name'          => $data->programme,
                ]);
            }

            $path = public_path('qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name);

            if(!File::exists($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            QrCode::format('png')->margin(0)->size(100)->generate(auth()->user()->uuid.'/'.$data->matric_no, $path.'\\'.$data->matric_no.'.png');

            $insert_data->push([
                'matric_number'     => $data->matric_no,
                'name'              => $data->name,
                'university_id'     => $university_id,
                'faculty_id'        => $faculty->id,
                'department_id'     => $programme->id,
                'dean_id'           => (is_null($dean))? null : $dean->id,
                'rector_id'         => (is_null($rector))? null : $rector->id,
                'serial_no'         => $data->serial_no,
                'date_endorse'      => $data->date_endorse,
                'citizenship'       => $data->citizenship,
                'qr_code_path'      => 'qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name.'\\'.$data->matric_no.'.png',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);  

            $data->is_import = 1;
            $data->save();
        }

        foreach($insert_data->chunk(500) as $chunk){
            \DB::table('students')->insert($chunk->toArray());
        }

        return redirect()->route('admin.check.index')->with('flash_success', 'Success import');

    }

    public function importCitizenship(Request $request, $filter)
    {
        set_time_limit(3000);

        $university_id = auth()->user()->university->id;

        $importData = PreImport::where('citizenship', str_replace('-', ' ', $filter))
                               ->where('user_id', Auth::id())
                               ->where('is_import', 0)
                               ->get();

        $insert_data = collect();

        foreach($importData as $data){
            $faculty = Faculty::where('name', $data->faculty)
                              ->where('user_id', Auth::id())
                              ->first();
            
            if(is_null($faculty)){
                $faculty = Faculty::create([
                    'user_id'       => Auth::id(),
                    'name'          => $data->faculty,
                ]);
            }

            $dean = Dean::where('faculty_id', $faculty->id)
                        ->where('active', 1)
                        ->first();

            $rector = Rector::where('university_id', auth()->user()->university->id)
                        ->where('active', 1)
                        ->first();
        
            $programme = Department::where('faculty_id', $faculty->id)
                                   ->where('name', str_replace('-', ' ', $filter))
                                   ->first();
            
            if(is_null($programme)){
                $programme = Department::create([
                    'faculty_id'    => $faculty->id,
                    'name'          => $data->programme,
                ]);
            }

            $path = public_path('qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name);

            if(!File::exists($path)){
                File::makeDirectory($path, 0777, true, true);
            }

            QrCode::format('png')->margin(0)->size(100)->generate(auth()->user()->uuid.'/'.$data->matric_no, $path.'\\'.$data->matric_no.'.png');

            $insert_data->push([
                'matric_number'     => $data->matric_no,
                'name'              => $data->name,
                'university_id'     => $university_id,
                'faculty_id'        => $faculty->id,
                'department_id'     => $programme->id,
                'dean_id'           => (is_null($dean))? null : $dean->id,
                'rector_id'         => (is_null($rector))? null : $rector->id,
                'serial_no'         => $data->serial_no,
                'date_endorse'      => $data->date_endorse,
                'citizenship'       => $data->citizenship,
                'qr_code_path'      => 'qrcode\\'.auth()->user()->university->name.'\\'.$faculty->name.'\\'.$data->matric_no.'.png',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);  

            $data->is_import = 1;
            $data->save();
        }

        foreach($insert_data->chunk(500) as $chunk){
            \DB::table('students')->insert($chunk->toArray());
        }

        return redirect()->route('admin.check.index')->with('flash_success', 'Success import');
    }

    public function faculty(Request $request, $faculty)
    {
        $search = '';
        if(isset($request->search)){
            $search = $request->search;
            $students = PreImport::where('faculty', ucwords(str_replace('-', ' ', $faculty)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->where(function ($query) use ($search) {
                                    $query->where('name', 'like', '%'.$search.'%')
                                          ->orWhere('programme', 'like', '%'.$search.'%')
                                          ->orWhere('citizenship', 'like', '%'.$search.'%')
                                          ->orWhere('serial_no', 'like', '%'.$search.'%')
                                          ->orWhere('date_endorse', 'like', '%'.$search.'%');
                                 })
                                 ->paginate(15);
        }
        else{
            $students = PreImport::where('faculty', ucwords(str_replace('-', ' ', $faculty)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->paginate(15);
        }
        

        return view('backend.check.faculty', compact('students', 'faculty', 'search'));
    }

    public function programme(Request $request, $programme)
    {
        $search = '';
        if(isset($request->search)){
            $search = $request->search;
            $students = PreImport::where('programme', strtoupper(str_replace('-', ' ', $programme)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->where(function ($query) use ($search) {
                                    $query->where('name', 'like', '%'.$search.'%')
                                          ->orWhere('faculty', 'like', '%'.$search.'%')
                                          ->orWhere('citizenship', 'like', '%'.$search.'%')
                                          ->orWhere('serial_no', 'like', '%'.$search.'%')
                                          ->orWhere('date_endorse', 'like', '%'.$search.'%');
                                 })
                                 ->paginate(15);
        }
        else{
            $students = PreImport::where('programme', strtoupper(str_replace('-', ' ', $programme)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->paginate(15);
        }

        return view('backend.check.programme', compact('students', 'programme', 'search'));
    }

    public function citizenship(Request $request, $citizenship)
    {
        $search = '';
        if(isset($request->search)){
            $search = $request->search;
            $students = PreImport::where('citizenship', ucwords(str_replace('-', ' ', $citizenship)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->where(function ($query) use ($search) {
                                    $query->where('name', 'like', '%'.$search.'%')
                                          ->orWhere('faculty', 'like', '%'.$search.'%')
                                          ->orWhere('programme', 'like', '%'.$search.'%')
                                          ->orWhere('serial_no', 'like', '%'.$search.'%')
                                          ->orWhere('date_endorse', 'like', '%'.$search.'%');
                                 })
                                 ->paginate(15);
        }
        else{
            $students = PreImport::where('citizenship', ucwords(str_replace('-', ' ', $citizenship)))
                                 ->where('user_id', Auth::id())
                                 ->where('is_import', 0)
                                 ->paginate(15);
        }
        return view('backend.check.citizenship', compact('students', 'citizenship', 'search'));
    }
}
