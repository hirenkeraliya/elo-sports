<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SpamWordExport;
use App\Http\Controllers\Controller;
use App\Imports\SpamFilterFile;
use App\Imports\SpamWordsImport;
use App\Models\SpamWords;
use Illuminate\Http\Request;
use Excel;
use Validator;

class FilterController extends Controller
{
    
    // this function will shows the spam word 
    public function index(){
        $words = SpamWords::pluck('name')->toArray();
        return view('backend.filter')->with('words',$words);
    }
    // this function will store the spam word
    public function store(Request $request){
       
        $data =[
            'file'=>'required|file'
        ];
        $validation =    Validator::make($request->all(),$data);
        if ($validation->passes()) {
        $data = Excel::import(new SpamWordsImport, $request->file);
         return redirect()->to('/filter-word-lists');
        }
        return redirect()->back();
    }

    // this function will delte the spam word lists
    public function destroy(){
         SpamWords::truncate();
        return redirect()->to('/filter-word-lists');
    }
    // this function will download the span words on file
    public function export() 
    {
        return Excel::download(new SpamWordExport, 'spam_word.xlsx');
    }
}
