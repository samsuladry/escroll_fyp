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
	public function index(Request $request, Faculty $faculty)
	{

		$search = '';
		if (isset($request->search)) {
			$search = $request->search;
			$departments = Department::where('faculty_id', $faculty->id)
				->where(function ($query) use ($search) {
					$query->where('name', 'like', '%' . $search . '%');
				})
				->orderBy('created_at', 'desc')
				->paginate(15);
		} else {
			$departments = Department::where('faculty_id', $faculty->id)->orderBy('created_at', 'desc')->paginate(15);
		}

		return view('backend.university.department.index')->with(compact('departments', 'faculty', 'search'));
	}

	public function add_department(Faculty $faculty)
	{

		return view('backend.university.department.add')->with(compact('faculty'));
	}

	public function store_department(Request $request, Faculty $faculty)
	{

		$request->validate([
			'faculty_id' => 'required',
			'name' => 'required',
		]);

		Department::create($request->all());
		return redirect()->route('admin.view-department', [$faculty]);
	}

	public function edit_department(Faculty $faculty, Department $department)
	{

		return view('backend.university.department.edit')->with(compact('department', 'faculty'));
	}

	public function update_department(Request $request, Faculty $faculty, Department $department)
	{

		$department->update($request->all());
		return redirect()->route('admin.view-department', [$faculty]);
	}

	public function view_department_graduate(Request $request, Faculty $faculty, Department $department)
	{

		$user_id = Auth::id();
		$search = '';

		if (isset($request->search)) {
			$search = $request->search;
			$students = Student::where('university_id', auth()->user()->university->id)
				->leftJoin('faculty', 'faculty.id', '=', 'students.faculty_id')
				->leftJoin('department', 'department.id', '=', 'students.department_id')
				->where('students.faculty_id', $faculty->id)
				->where('department_id', $department->id)
				->where(function ($query) use ($search) {
					$query->where('students.name', 'like', '%' . $search . '%')
						->orWhere('department.name', 'like', '%' . $search . '%')
						->orWhere('students.matric_number', 'like', '%' . $search . '%');
				})
				->select('students.id', 'students.department_id', 'students.faculty_id', 'faculty.name as faculty_name', 'department.name as department_name', 'students.name as name', 'students.matric_number', 'students.qr_code_path')
				->orderBy('pdf_doc_path')
				->orderBy('students.name')
				->paginate(15);
		} else {
			$students = Student::where('university_id', auth()->user()->university->id)
				->where('faculty_id', $faculty->id)
				->where('department_id', $department->id)
				->orderBy('pdf_doc_path')
				->orderBy('students.name')
				->paginate(15);
		}

		return view('backend.university.department.graduatestudent', compact('students', 'faculty', 'department', 'search'));
	}
}
