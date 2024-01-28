<?php

namespace App\Http\Controllers;

use App\Models\Navbar;
use Illuminate\Http\Request;
use PDO;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('form.index');
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
        $data = $request->title;

        Navbar::create(['title' => $data]);

        return redirect()->back()->with('success','Form Submitted Successfully');
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


    public function navbar(Request $request)
    {
        // $data = Navbar::get('title');
        // return $data;

        // Fetch all records as an array of associative arrays
        $titles = Navbar::get(['title'])->pluck('title')->toArray();

        // Implode the titles with a space
        $data = implode(' ', $titles);

        // return $data;

        // Now $concatenatedTitles is a string with titles separated by space

        // Use or display the concatenated titles as needed
        // return $concatenatedTitles;



        return view('form.navbar', compact('data'));
    }

}
