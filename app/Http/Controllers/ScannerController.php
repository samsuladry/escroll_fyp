<?php

namespace App\Http\Controllers;

use App\Models\ScanController;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function scan()
    {
        return view('scanQr');
    }

    public function display(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'matricNumber' => 'required'
        ]);

        $matricNumber = $request->matricNumber;

        // // return response()->json(['success'=>'QR code is valid']);
        // return redirect()-> route('display', compact('address', 'matricNumber'));
        return view('display', compact('matricNumber'));
    }

    // public function viewDisplay($address, $matricNumber)
    // {
    //     return view('display', ['address' => $address, 'matricNumber' => $matricNumber]);
    // }
}
