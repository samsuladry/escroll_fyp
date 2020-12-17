<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Scopes\DeleteScope;

class AcademicLevelController extends Controller
{
    public function index(){

        $academic_levels = AcademicLevel::paginate(15);

        return view('backend.university.academic.index', compact('academic_levels'));
    }

    public function create(){
        return view('backend.university.academic.create');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'  => 'required',
        ]);

        AcademicLevel::create([
            'university_id' => auth()->user()->university->id,
            'name'          => $request->name,
            'is_delete'     => 0,
        ]);

        return redirect()->route('admin.academic.index');
    }

    public function update(Request $request, AcademicLevel $academic_level){
        $request->validate([
            'name'  => 'required',
        ]);

        $academic_level->name = $request->name;
        $academic_level->save();

        return redirect()->back()->with('flash_success', 'Successfully Updated Academic Level');

    }

    public function destroy(AcademicLevel $academic_level){

        $academic_level->is_delete = 1;
        $academic_level->save();

        return redirect()->back()->with('flash_success', 'Academic Level Deleted');
    }
}
