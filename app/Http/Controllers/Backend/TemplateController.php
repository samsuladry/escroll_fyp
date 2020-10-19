<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\EscrollTemplate;

class TemplateController extends Controller
{
    public function view_template(){

        $user_id = Auth::id();
        $templates = EscrollTemplate::where('user_id', $user_id )->get();
        return view('backend.university.escroll-templates.index')->with(compact('templates'));
    }

    public function add_template(){

        return view('backend.university.escroll-templates.add');
    }

     public function store_template(Request $request){

        $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            'image_template' => 'required',
            'pdf_template' => 'required',
        ]);

        $template = EscrollTemplate::create($request->all());
        $template->update(['image_template'=> $request->file('image_template')->store('image_template', 'public')]);
        $template->update(['pdf_template'=> $request->file('pdf_template')->store('pdf_template', 'public')]);

        return redirect('/admin/template');
    }

     public function edit_template(EscrollTemplate $template){

        return view('backend.university.escroll-templates.edit')->with(compact('template'));
    }

     public function update_template(Request $request, EscrollTemplate $template){

        $template->update($request->all());
        return redirect('/admin/template');
    }
}
