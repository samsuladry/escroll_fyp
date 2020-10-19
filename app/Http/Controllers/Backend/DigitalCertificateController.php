<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Certificate;


class DigitalCertificateController extends Controller
{
     public function digital_signature(){

        return view('backend.university.digital_sign');
    }

    public function digital_certificate(){

        $user_id = Auth::id();
        $certificates = Certificate::where('user_id', $user_id)->get();
        return view('backend.university.certificate.index', compact('certificates'));
    }

    public function digital_certificate_add(){

        return view('backend.university.certificate.add');
    }

    public function digital_certificate_store(Request $request){

        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'location' => 'required',
            'reason' => 'required',
            'contact_info' => 'required',
        ]);

        Certificate::create($request->all());
        return redirect('admin/digital_certificate');
    }
}
