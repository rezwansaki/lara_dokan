<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //show all employees
    public function allCustomer()
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $all_customers = User::whereHas('roles', function ($q) {
                $q->whereIn('name', ['member']);
            })->paginate(8);

            //get all customer
            $total_customers = User::whereHas('roles', function ($q) {
                $q->whereIn('name', ['member']);
            })->get();

            return view('customer.allcustomer', compact('all_customers', 'total_customers'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function customerEdit($id)
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) {
                $user = User::find($id);
                $allRoles = Role::all();
                $assignedRoles  = $user->roles->pluck('id')->toArray();
                return view('customer.customeredit', compact('user', 'allRoles', 'assignedRoles'));
            } else {
                //If not superadmin 
                //Toaster Message show, when user create fail
                $notification = array(
                    'message' => 'This section is not for you!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function customerUpdate(Request $request, $id)
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) {
                $user = User::find($id);

                $new_user = $request->username;
                $new_contact = $request->usercontact;
                $new_email = $request->useremail;
                $new_password = Hash::make($request->userpassword);

                if (!$new_user) {
                    $new_user = $user->name;
                }
                if (!$new_contact) {
                    $new_contact = $user->contact;
                }
                if (!$new_email) {
                    $new_email = $user->email;
                }
                if (!$new_password) {
                    $new_password = $user->password;
                }

                $user->name = $new_user;
                $user->contact = $new_contact;
                $user->email = $new_email;
                $user->password = $new_password;

                $user->save();

                $selected_roles = $request->input('roles');
                //if no role is selected then set 'member' as a user role 
                if ($selected_roles) {
                } else {
                    $selected_roles = 'member';
                }
                $user->syncRoles($selected_roles);

                //Toaster Message 
                $notification = array(
                    'message' => 'Update Successfully!',
                    'alert-type' => 'success'
                );

                return redirect('/user/customer')->with($notification);
            } else {
                //If not superadmin 
                //Toaster Message show, when user create fail
                $notification = array(
                    'message' => 'This section is not for you!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function customerDelete($id)
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) {
                $user = User::find($id);
                $checksuperadmin = '';
                if ($user->hasRole('superadmin')) {
                    $checksuperadmin = 'true';
                } else {
                    $checksuperadmin = 'false';
                }
                //if this user is not superadmin 
                if ($checksuperadmin == 'false') {
                    $user->roles()->detach();
                    $user->delete();

                    //Toaster Message 
                    $notification = array(
                        'message' => 'Delete Successfully!',
                        'alert-type' => 'success'
                    );

                    return redirect('/user/customer')->with($notification);
                } else {
                    //if this user is superadmin
                    //Toaster Message 
                    $notification = array(
                        'message' => 'You can not remove the superadmin like this!',
                        'alert-type' => 'error'
                    );
                    return redirect('/user/customer')->with($notification);
                }
            } else {
                //If not superadmin 
                //Toaster Message show, when user create fail
                $notification = array(
                    'message' => 'This section is not for you!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
