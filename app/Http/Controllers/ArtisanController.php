<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class ArtisanController extends Controller
{
    public function Index(Request $request)
    {
        if($request->pass == 'mypass'){
            $response = Artisan::call($request->command);
            dd($response);
        }
        else
        {
            dd('Authentication Error !!');
        }
    }
}
