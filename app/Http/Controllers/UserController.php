<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::get();

        // return $user;

        $data = [
            'title' => 'How to create PDF file using DOM PDF In Laravel - 9',
            'date' => date('d/m/Y'),
            'users' => $user
        ];

        // return $data;
        if($request->has('download')){
            $pdf = PDF::loadView('users.index', $data);

            return $pdf->download('test.pdf');
        }

        return view('users.index', compact('user'));
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
        $user_detail = User::where('id', $id)->get();
        // return $user_detail;
        return view('users.detail', compact('user_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_data = User::where('id', $id)->get();

        // return $user_data;
        return view('users.edit', compact('user_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $user_update = User::where('id', $id)->update(['email' =>$request->email,
                'phone' => $request->phone_number,
                'password' => $request->password
            ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete_data = User::where('id', $id)->delete();

        return redirect()->back();
    }
}
