<?php

namespace App\Http\Controllers;

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



}
