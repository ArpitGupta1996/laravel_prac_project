<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadedvideo(Request $request)
    {
        return view('form.video');
    }

    public function uploadVideo(Request $request)
    {

        // dd($request->all());
        // $request->validate([
        //     'title' => 'required',
        //     'video' => 'required | file'
        // ]);

        // $video = new Video;

        // $video->title = $request->title;

        // if ($request->hasFile('video')) {
        //     $file = $request->file('video');
        //     $filename = 'custom_name.' . $file->getClientOriginalExtension();
        //     $path = $file->storeAs('public/videos', $filename);

        //     // Save video file path in the database
        //     $video->video_path = 'videos/' . $filename;
        //     // if ($file->isValid()) {
        //     //     $filename = 'custom_name.' . $file->getClientOriginalName();
        //     //     $path = $file->storeAs('public/videos', $filename); // Store in storage/app/public/videos
        //     //     $video->video = $path; // Save the path relative to storage directory
        //     // }
        // }
        // $video->save();




        $request->validate([
            'title' => 'required',
            'video' => 'required', // Adjust max file size as needed
        ]);

        $title = $request->title;
        $video = $request->file('video');
        $filename = time() . '_' . $video->getClientOriginalName();
        $video->move(public_path('videos'), $filename);

        $videoRecord = new Video([
            'title' => $title,
            'video' => $filename,
        ]);
        $videoRecord->save();


        // $fileName = $request->video->getClientOriginalName();

        // $filePath = 'videos/' . $fileName;

        // $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));

        // // File URL to access the video in frontend
        // $url = Storage::disk('public')->url($filePath);

        // if ($isFileUploaded) {
        //     $video = new Video();
        //     $video->title = $request->title;
        //     $video->video = $filePath;
        //     $video->save();

        //     return back()
        //         ->with('success', 'Video has been successfully uploaded.');
        // }

        // return back()
        //     ->with('error', 'Unexpected error occured');
    }
}
