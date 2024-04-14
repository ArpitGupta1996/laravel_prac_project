<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index(){
        return view('image-upload.index');
    }


    public function upload(ImageUploadRequest $request){
        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);


        return back()->with('success', 'Image uploaded successfully')->with('image', $filename);
    }
}
