<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function university(){

        $universities = User::role('university')->get(); 
    	return view('backend.university', compact('universities'));
    }

    public function university_profile(){

        $user_id = Auth::id();
        $profile = University::where('user_id', $user_id)->first();
        return view('backend.university-profile', compact('profile'));
    }

     public function update_university_profile(Request $request){

        $user_id = Auth::id();
        DB::table('university')->where('user_id', $user_id)
        ->update([
            'name' => $request->name,
            'keyword' => $request->keyword,
            'rector_name' => $request->rector_name,
            'logo'=> $request->file('uni_logo')->store('university', 'public'),
            'signature'=> $request->file('rector_sign')->store('university', 'public')
             ]);
        
        return redirect('/admin/university-profile');
    }
}
