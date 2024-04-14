<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DragDropController extends Controller
{
    public function form(){
        return view('dragdrop.drop-drop');
    }


    public function uploadFiles(Request $request){
        $image = $request->file('file');

        $imageName = time().'.'.$image->extension();

        $path = $image->store('public/images');

        return response()->json(['success' => $imageName]);
    }
}
