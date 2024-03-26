<?php

namespace App\Http\Controllers;

use App\Mail\GeneratePDFWithMail;
use App\Models\User;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\PDF;
use \PDF;
use Illuminate\Support\Facades\Mail;
class PDFreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('pdf.index');

        $user = User::all();
        return view('pdf.data', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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


    public function createpdf()
    {
        $data = User::all();
        // share data to view
        view()->share('employee', $data);
        $pdf = PDF::loadView('pdf.pdf_view', array($data));
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function sendmail(){
        $data['email'] = "arpitgupta19aug1996@gmail.com";
        $data['title'] = "Test Mail PDF";
        $data['body'] = "This is Demo";

        $pdf = PDF::loadView('emails.testmail', $data);
        $data['pdf'] = $pdf;
        Mail::to($data['email'])->send(new GeneratePDFWithMail($data));

        dd('mail sent successfully');
    }
}
