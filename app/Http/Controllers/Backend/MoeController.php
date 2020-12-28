<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\University;

class MoeController extends Controller
{
    public function index()
    {
        return view('backend.moe.index');
    }
    
    public function registration()
    {
        return view('backend.moe.registration');
    }

    public function blockExplorer()
    {
        return view ('backend.moe.blockExplorer');
    }

    public function dataSummary()
    {
        return view('backend.moe.dataSummary');
    }

    public function uniPage()
    {
        return view('backend.moe.uniPage');
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // dd($data);
        $university = new University;
        $university->name = $request->uniName;
        $university->blockchainAddress = $request->uniAddress;
        $university->acronym = $request->uniAcronym;
        $university->user_id = auth()->user()->id; //nanti letak id MOE
        // $university->save();
        
        #create or update your data here

        if($university->save())
        {
            return response()->json(['success'=>'University is succesfully registered']);
        }
        else{
            return response()->json(['error'=>'University is not succesfully registered, there is an error']);
        }
        
        // return $request->all();
    }
}
