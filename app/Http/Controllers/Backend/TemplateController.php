<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\EscrollTemplate;
use App\Models\EscrollSetup;
use App\Models\Student;
use App\Models\Rector;
use App\Models\Dean;

class TemplateController extends Controller
{
    public function view_template()
    {
        $templates = EscrollTemplate::where('university_id', auth()->user()->university->id)->get();
        return view('backend.university.escroll-templates.index')->with(compact('templates'));
    }

    public function add_template()
    {
        return view('backend.university.escroll-templates.add');
    }

    public function store_template(Request $request)
    {
        $request->validate([
            'university_id' => 'required',
            'description' => 'required',
            'image_template' => 'required',
        ]);

        $template = EscrollTemplate::create($request->all());
        $escroll_setup = EscrollSetup::create([
            'escroll_template_id'   =>  $template->id,
        ]);
        $template->update(['image_template'=> $request->file('image_template')->store('image_template', 'public')]);

        return redirect('/admin/template');
    }

    public function edit_template(EscrollTemplate $template)
    {
        return view('backend.university.escroll-templates.edit')->with(compact('template'));
    }

     public function update_template(Request $request, EscrollTemplate $template){
        // dd($request->name_position['left']);
        if(isset($request->name_position)){
            $request->name_position = 'left:'.$request->name_position['left'].'; '.'top:'.$request->name_position['top'].'; '.'width:'.$request->name_position['width'].'; '.'height:'.$request->name_position['height'].';';
            $template->name_position = $request->name_position;
        } 
        if(isset($request->bachelor_position)){
            $request->bachelor_position = 'left:'.$request->bachelor_position['left'].'; '.'top:'.$request->bachelor_position['top'].'; '.'width:'.$request->bachelor_position['width'].'; '.'height:'.$request->bachelor_position['height'].';';
            $template->bachelor_position = $request->bachelor_position;
        }
        if(isset($request->left_signature_position)){
            $request->left_signature_position = 'left:'.$request->left_signature_position['left'].'; '.'top:'.$request->left_signature_position['top'].'; '.'width:'.$request->left_signature_position['width'].'; '.'height:'.$request->left_signature_position['height'].';';
            $template->left_signature_position = $request->left_signature_position;
        }
        if(isset($request->right_signature_position)){
            $request->right_signature_position = 'left:'.$request->right_signature_position['left'].'; '.'top:'.$request->right_signature_position['top'].'; '.'width:'.$request->right_signature_position['width'].'; '.'height:'.$request->right_signature_position['height'].';';
            $template->right_signature_position = $request->right_signature_position;
        }
        if(isset($request->qr_position)){
            $request->qr_position = 'left:'.$request->qr_position['left'].'; '.'top:'.$request->qr_position['top'].'; '.'width:'.$request->qr_position['width'].'; '.'height:'.$request->qr_position['height'].';';
            $template->qr_position = $request->qr_position;
        }

        $template->save();

        return;
    }

    public function view_escroll()
    {
        $template = EscrollTemplate::where('university_id', auth()->user()->university->id )->first();
        $rector = Rector::where('university_id', auth()->user()->university->id)
                        ->where('active', 1)
                        ->first();
        $dean = Dean::where('active', 1)
                    ->first();
        $student = Student::where('matric_number', 1511688)->first();
        return view('backend.university.escroll.index')->with(compact('template', 'rector', 'dean', 'student'));
    }
}
