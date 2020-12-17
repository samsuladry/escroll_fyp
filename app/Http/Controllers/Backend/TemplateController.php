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
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class TemplateController extends Controller
{
    public function view_template()
    {
        $templates = EscrollTemplate::university()->orderBy('active', 'desc')->orderBy('created_at', 'desc')->get();
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
        // dd(Storage::disk('public')->exists('image_template'));

        if(!Storage::disk('public')->exists('image_template')){
            Storage::disk('public')->makeDirectory('image_template');
        }
            // dd(storage_path('public'));
        $template = EscrollTemplate::where('active', 1)
                                   ->university()
                                   ->update([
                                       'active'     => 0,
                                   ]);

        $template = EscrollTemplate::create($request->all());
        $template->update(['image_template'=> $request->file('image_template')->store('image_template', 'public')]);
        $escroll_setup = EscrollSetup::create([
            'escroll_template_id'   =>  $template->id,
        ]);
        
        return redirect('/admin/template');
    }

    public function edit_template(EscrollTemplate $template)
    {
        return view('backend.university.escroll-templates.edit')->with(compact('template', 'students'));
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

        if(isset($request->serial_no_position)){
            $request->serial_no_position = 'left:'.$request->serial_no_position['left'].'; '.'top:'.$request->serial_no_position['top'].'; '.'width:'.$request->serial_no_position['width'].'; '.'height:'.$request->serial_no_position['height'].';';
            $template->serial_no_position = $request->serial_no_position;
        }

        if(isset($request->date_endorse_position)){
            $request->date_endorse_position = 'left:'.$request->date_endorse_position['left'].'; '.'top:'.$request->date_endorse_position['top'].'; '.'width:'.$request->date_endorse_position['width'].'; '.'height:'.$request->date_endorse_position['height'].';';
            $template->date_endorse_position = $request->date_endorse_position;
        }

        $template->save();

        return;
    }

    public function view_escroll(EscrollTemplate $template)
    {
        $rector = Rector::university()
                        ->where('active', 1)
                        ->first();
        $dean = Dean::where('active', 1)
                    ->first();
        $student = Student::orderby('id','desc')->first();
        $downloaded = 0;

        if($template->escrollSetup->landscape == 1){
            $landscape = 'landscape';
            $width = 1080;
            $height = 790;
        }
        else{
            $landscape = 'portrait';
            $height = 1080;
            $width = 790;
        }

        return view('backend.university.escroll.index')->with(compact('template', 'rector', 'dean', 'student', 'downloaded', 'width', 'height'));
    }

    public function download_escroll(EscrollTemplate $template)
    {
        $rector = Rector::university()
                        ->where('active', 1)
                        ->first();
        $dean = Dean::where('active', 1)
            ->first();

        $downloaded = 1;
        $student = Student::first();

        if($template->escrollSetup->landscape == 1){
            $landscape = 'landscape';
            $width = 1080;
            $height = 790;
        }
        else{
            $landscape = 'portrait';
            $height = 1080;
            $width = 790;
        }
        $pdf = PDF::loadView('backend.university.escroll.index', compact('template', 'student','rector','dean', 'downloaded', 'height', 'width'))->setPaper('a4', $landscape);
        // dd(public_path('storage/pdf_template').'/'.time().'.pdf');
        // dd('test1');
        // Storage::put('public/storage/pdf_template'.'/'.time().'.pdf', $pdf->output());
        $file = public_path('storage/pdf_template').'/'.time().'.pdf';
        $pdf->save($file);
        // dd('test2');
        // dd($pdf->download('escroll.pdf'));
        // return $pdf->download('escroll.pdf');
        // return response()->json(['success'=>'s'], 200);
        return response()->download($file);
    }

    public function activate_template(EscrollTemplate $template){
        if($template->active == 1) return redirect()->back()->with('flash_warning', 'Template already active!');
        EscrollTemplate::university()
                                    ->where('active', 1)
                                    ->update([
                                        'active'        => 0,
                                    ]);
        $template->active = 1;
        $template->updated_at = Carbon::now();
        $template->save();

        return redirect()->back()->with('flash_success', 'Template actived');
    }
}
