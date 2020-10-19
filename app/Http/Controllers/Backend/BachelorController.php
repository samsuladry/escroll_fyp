<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Bachelor;
use App\Models\Faculty;
use App\Models\Department;

class BachelorController extends Controller
{
     public function view_bachelor(Faculty $faculty, Department $department){

        $bachelors = Bachelor::where('department_id', $department->id )->get();
        return view('backend.university.bachelor.index')->with(compact('bachelors','department','faculty'));
    }

      public function add_bachelor(Faculty $faculty, Department $department){
 
        return view('backend.university.bachelor.add')->with(compact('faculty','department'));
    }

     public function store_bachelor(Request $request, Faculty $faculty, Department $department){

        $request->validate([
            'department_id' => 'required',
            'title' => 'required',
        ]);

        Bachelor::create($request->all());
		return redirect()->route('admin.view-bachelor', [$faculty, $department]);
    }

     public function edit_bachelor(Faculty $faculty,Department $department, Bachelor $bachelor){

        return view('backend.university.bachelor.edit')->with(compact('department','faculty','bachelor'));
    }

     public function update_bachelor(Request $request,Faculty $faculty, Department $department, Bachelor $bachelor){
     	
        $bachelor->update($request->all());
        return redirect()->route('admin.view-bachelor', [$faculty, $department]);
    }
}
