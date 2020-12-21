<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Faculty;
use App\Models\Dean;
use App\Models\Student;

class DeanController extends Controller
{
	public function view_dean(Faculty $faculty)
	{

		$deans = Dean::where('faculty_id', $faculty->id)
			->orderBy('active', 'desc')
			->paginate(15);

		return view('backend.university.dean.index')->with(compact('deans', 'faculty'));
	}

	public function add_dean(Faculty $faculty)
	{

		return view('backend.university.dean.add')->with(compact('faculty'));
	}

	public function store_dean(Request $request, Faculty $faculty)
	{

		$request->validate([
			'faculty_id' => 'required',
			'name' => 'required',
			'signature' => 'required'
		]);

		$dean = Dean::create($request->all());
		$dean->update(['signature' => $request->file('signature')->store('dean', 'public')]);
		$dean->active = 1;
		$dean->save();

		$students = Student::where('faculty_id', $faculty->id)
			->where('university_id', auth()->user()->university->id)
			->whereNull('pdf_doc_path')
			->get();

		foreach ($students as $student) {
			$student->dean_id = $dean->id;
			$student->save();
		}

		$deans = Dean::where('id', '!=', $dean->id)
			->where('faculty_id', $faculty->id)
			->get();

		foreach ($deans as $data) {
			$data->active = 0;
			$data->save();
		}

		return redirect()->route('admin.view-dean', [$faculty]);
	}

	public function edit_dean(Faculty $faculty, Dean $dean)
	{

		return view('backend.university.dean.edit')->with(compact('dean', 'faculty'));
	}

	public function update_dean(Request $request, Faculty $faculty, Dean $dean)
	{

		$dean->update($request->all());
		if ($request->signature != NULL) {
			$dean->update(['signature' => $request->file('signature')->store('dean', 'public')]);
		}

		return redirect()->route('admin.view-dean', [$faculty]);
	}

	public function activate_dean(Faculty $faculty, Dean $dean)
	{

		$students = Student::where('faculty_id', $faculty->id)
			->where('university_id', auth()->user()->university->id)
			->whereNull('pdf_doc_path')
			->get();

		$deans = Dean::where('id', '!=', $dean->id)
			->where('faculty_id', $faculty->id)
			->get();


		foreach ($students as $student) {
			$student->dean_id = $dean->id;
			$student->save();
		}

		foreach ($deans as $data) {
			$data->active = 0;
			$data->save();
		}

		$dean->active = !$dean->active;
		$dean->save();

		return redirect()->back();
	}
}
