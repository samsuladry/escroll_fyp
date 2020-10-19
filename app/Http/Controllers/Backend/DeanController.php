<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Faculty;
use App\Models\Dean;

class DeanController extends Controller
{
    public function view_dean(Faculty $faculty){

        $deans = Dean::where('faculty_id', $faculty->id )->get();
        return view('backend.university.dean.index')->with(compact('deans','faculty'));
    }

    public function add_dean(Faculty $faculty){
 
        return view('backend.university.dean.add')->with(compact('faculty'));
    }

     public function store_dean(Request $request, Faculty $faculty){

        $request->validate([
            'faculty_id' => 'required',
            'name' => 'required',
            'signature' => 'required'
        ]);

        $dean = Dean::create($request->all());
        $dean->update(['signature'=> $request->file('signature')->store('dean', 'public')]);
        return redirect()->route('admin.view-dean', [$faculty]);
    }

     public function edit_dean(Faculty $faculty,Dean $dean){

        return view('backend.university.dean.edit')->with(compact('dean','faculty'));
    }

     public function update_dean(Request $request,Faculty $faculty, Dean $dean){

        $dean->update($request->all());
        if($request->signature != NULL){
            $rector->update(['signature'=> $request->file('signature')->store('rector', 'public')]);
        }
        
        return redirect()->route('admin.view-dean', [$faculty]);
    }
}
