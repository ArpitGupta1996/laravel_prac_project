<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;


class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // {
    //     return view()
    // }


    public function screenshot(Request $request)
    {
        // return 'here';
        Browsershot::url('https://laravel.com/docs/10.x/eloquent')
            ->setOption('landscape', true)
            ->windowSize(3840, 2160)
            ->waitUntilNetworkIdle()
            ->save('tutsmake.jpg');

        dd("Done");
    }

    public function ip(Request $request)
    {
        return $request->ip();
    }


    public function sidebar(){
        return view('sidebar');
    }



    #########  Auto COmplete search starts from here
    public function index(){
        return view('searchautocomplete');
    }

    public function searchAutoComplete(Request $request){
        $search = $request->get('term');

        $result = User::where('name', 'LIKE', '%' .$search. '%')->pluck('name');

        return response()->json($result);

    }


    public function address(){

        return view('address');

    }


}
