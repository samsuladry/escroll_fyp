<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
