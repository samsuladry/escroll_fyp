<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Export\CsvImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

use App\Models\Student;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    	$students = Student::all();
    	
        return view('frontend.user.dashboard', compact('students'));
    }

    public function import_student_csv(){


    	Excel::import(new StudentsImport, request()->file('file'));
    	return redirect('/dashboard');

    }
}
