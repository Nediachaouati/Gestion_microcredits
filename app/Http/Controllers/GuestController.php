<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function home(){
        
        return view('guest.home');
    }

    public function contact(){
       

        return view('guest.contact');
    }
}
