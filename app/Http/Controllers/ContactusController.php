<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactusController extends Controller
{
    //contactus
    public function contactUs()
    {
        return view('contactus');
    }
}
