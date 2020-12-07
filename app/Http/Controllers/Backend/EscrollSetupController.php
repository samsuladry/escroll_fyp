<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EscrollTemplate;
use App\Models\EscrollSetup;
use App\Models\Student;

class EscrollSetupController extends Controller
{
    public function edit(EscrollTemplate $template)
    {
        $students = Student::where('university_id', auth()->user()->university->id)->where('is_import', 1)->get();
        return view('backend.university.escroll-templates.edit')->with(compact('template', 'students'));
    }

    public function update(EscrollTemplate $template, Request $request)
    {
        //validation here
        $escroll_setup = $template->escrollSetup;
        
        if(isset($request->name))               $escroll_setup->name = 1;                else $escroll_setup->name = 0;
        if(isset($request->bachelor))           $escroll_setup->bachelor = 1;            else $escroll_setup->bachelor = 0;
        if(isset($request->left_signature))     $escroll_setup->left_signature = 1;      else $escroll_setup->left_signature = 0;
        if(isset($request->right_signature))    $escroll_setup->right_signature = 1;     else $escroll_setup->right_signature = 0;
        if(isset($request->qr))                 $escroll_setup->qr = 1;                  else $escroll_setup->qr = 0;
        if(isset($request->date_endorse))       $escroll_setup->date_endorse = 1;        else $escroll_setup->date_endorse = 0;
        if(isset($request->serial_no))          $escroll_setup->serial_no = 1;           else $escroll_setup->serial_no = 0;
        if(isset($request->landscape))          $escroll_setup->landscape = 1;           else $escroll_setup->landscape = 0;
        $escroll_setup->save();

        return redirect()->back();
    }
}
