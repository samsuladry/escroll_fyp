<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Rector;

class RectorController extends Controller
{
    public function view_rector(){

        $user_id = Auth::id();
        $rectors = Rector::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('backend.university.rector.index')->with(compact('rectors'));
    }

  	public function add_rector(){
        
        return view('backend.university.rector.add');
    }

    public function store_rector(Request $request){

        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'signature' => 'required',
        ]);

        $rector = Rector::create($request->all());
        $rector->update(['signature'=> $request->file('signature')->store('rector', 'public')]);
        return redirect('admin/rector');
    }

      public function edit_rector(Rector $rector){

        return view('backend.university.rector.edit')->with(compact('rector'));
    }

      public function update_rector(Request $request,Rector $rector){

        $rector->update($request->all());
        if($request->signature != NULL){
            $rector->update(['signature'=> $request->file('signature')->store('rector', 'public')]);
        }

        return redirect('admin/rector');
    }
}
