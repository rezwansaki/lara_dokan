<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    public function installStepOne()
    {
        return view('installation.installstepone');
    }

    public function installStepTwo()
    {
        return view('installation.installsteptwo');
    }

    //Install the app when you run this app at the first time 
    public function installTheApp(Request $request)
    {
        try {
            $superadmin = "";
            $msg = "";
            $user = "";

            //create the first user 
            $user = new User;
            $user_name = $request->username;
            $user_contact = $request->usercontact;
            $user_email = $request->useremail;
            $user_password = $request->userpassword;

            $user->name = $user_name;
            $user->contact = $user_contact;
            $user->email = $user_email;
            $user->password = Hash::make($user_password);
            $user->save();

            //create default user roles 
            $role_name = ['superadmin', 'admin', 'editor', 'salesman', 'member'];
            $total_roles = 5;
            for ($i = 0; $i < $total_roles; $i++) {
                $role = Role::create(['name' => $role_name[$i]]);
            }

            //assign superadmin with the first user id
            $selected_roles = 'superadmin';
            $user = User::find(1);
            User::find($user->id)->assignRole($selected_roles);

            $msg = 'Create superadmin successfull! You can login using ' . $user_email . ' and ' . $user_password . ' Now you are a ' .  $selected_roles . '. Please, login first then change the information of ' .  $selected_roles . '.';
            return view('installation.install', compact('superadmin', 'msg', 'user'));
        } catch (\Exception $e) {
            //$msg = $e->getMessage();
            $msg = "Please, follow the instruction of the installation, if you want to install this app. Or check the database and recover superadmin!";
            return view('installation.install', compact('superadmin', 'msg', 'user'));
        }
    } // /Install the app when you run this app at the first time 



    //recoverSuperAdmin
    public function recoverSuperAdmin()
    {
        $superadmin = "";
        $msg = "";
        $user = "";

        //create a superadmin user 
        $superadmin = User::whereHas('roles', function ($q) { //check superadmin from database 
            $q->where('name', 'superadmin');
        })->get();

        $user = User::find(1);

        if ($superadmin) {
            $msg = "Super admin at the top and user ID 1 information at the bottom. The two data should be kept the same. Check the database or install the app again.";
        }
        if ($user) {
            $msg = "Super admin at the top and user ID 1 information at the bottom. The two data should be kept the same. Check the database or install the app again.";
        }

        return view('installation.install', compact('superadmin', 'msg', 'user'));
    } // /recoverSuperAdmin
}
