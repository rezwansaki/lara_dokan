<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $superadmin = "";
        $msg = "";
        $user = "";

        //check superadmin 
        $superadmin = User::whereHas('roles', function ($q) {
            $q->where('name', 'superadmin');
        })->get();

        if (!$superadmin || count($superadmin) < 1) {
            $msg = 'superadmin is not found! Please, recover superadmin or install the app again.';
            return view('installation.install', compact('superadmin', 'msg', 'user'));
        } else {
            return view('welcome');
        }
    } //index
}
