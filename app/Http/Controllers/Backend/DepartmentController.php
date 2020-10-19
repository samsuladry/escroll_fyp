<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;

class DepartmentController extends Controller
{
     public function index(Faculty $faculty){

        $departments = Department::where('faculty_id', $faculty->id )->orderBy('created_at', 'desc')->get();
		return view('backend.university.department.index')->with(compact('departments','faculty'));
    }

      public function add_department(Faculty $faculty){
 
        return view('backend.university.department.add')->with(compact('faculty'));
    }

     public function store_department(Request $request, Faculty $faculty){

        $request->validate([
            'faculty_id' => 'required',
            'name' => 'required',
        ]);

        Department::create($request->all());
		return redirect()->route('admin.view-department', [$faculty]);
    }

     public function edit_department(Faculty $faculty,Department $department){

        return view('backend.university.department.edit')->with(compact('department','faculty'));
    }

     public function update_department(Request $request,Faculty $faculty, Department $department){
     	
        $department->update($request->all());
        return redirect()->route('admin.view-department', [$faculty]);
    }

    public function view_department_graduate(Faculty $faculty, Department $department){

        $user_id = Auth::id();
        $students = Student::where('university_id', $user_id)->where('faculty_id', $faculty->id)->where('department_id', $department->id)->get();

        return view('backend.university.department.graduatestudent', compact('students','faculty','department'));
    }
}
