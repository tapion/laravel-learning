<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Session extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('role');
        $this->middleware('show.session');
       
    }

    public function session(){
        
        echo "Si llego";
    }
}
