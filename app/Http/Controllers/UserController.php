<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //to show users 
    public function users()
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();

        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            //superadmin can access
            $all_users = User::orderBy('id', 'desc')->paginate(8);
            $total_users = User::all()->count();

            return view('user.users', compact('all_users', 'total_users', 'all_roles'));
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

    public function userCreate()
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $allRoles = Role::all();
            return view('user.usercreate', compact('allRoles'));
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

    public function userStore(Request $request)
    {
        try {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) {
                $user_name = $request->username;
                $user_contact = $request->usercontact;
                $user_email = $request->useremail;
                $user_password = Hash::make($request->userpassword);


                $user = new User;
                $user->name = $user_name;
                $user->contact = $user_contact;
                $user->email = $user_email;
                $user->password = $user_password;

                if (!$user_name || !$user_contact || !$user_email || !$user_password) {
                    //Toaster Message show, when user create fail
                    $notification = array(
                        'message' => 'Create User Fail!',
                        'alert-type' => 'error'
                    );

                    return redirect('/users')->with($notification);
                } else {
                    //when user create successfully 
                    $user->save();

                    $selected_roles = $request->input('roles');
                    //if no role is selected then set 'member' as a user role 
                    if ($selected_roles) {
                    } else {
                        $selected_roles = 'member';
                    }
                    $user->assignRole($selected_roles);

                    //Toaster Message 
                    $notification = array(
                        'message' => 'Create User Successfully!',
                        'alert-type' => 'success'
                    );

                    return redirect('/users')->with($notification);
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
        } catch (\Exception $e) {
            //return $e->getMessage();
        }
    }

    public function userEdit($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $user = User::find($id);
            $allRoles = Role::all();
            $assignedRoles  = $user->roles->pluck('id')->toArray();
            return view('user.useredit', compact('user', 'allRoles', 'assignedRoles'));
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

    public function userUpdate(Request $request, $id)
    {
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

            return redirect('/users')->with($notification);
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

    public function userDelete($id)
    {
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

                return redirect('/users')->with($notification);
            } else {
                //if this user is superadmin
                //Toaster Message 
                $notification = array(
                    'message' => 'You can not remove the superadmin like this!',
                    'alert-type' => 'error'
                );
                return redirect('/users')->with($notification);
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

    //after login user can see only his/her profile
    public function userProfile()
    {
        try {
            $auth_user = Auth::user();
            return view('user.userprofile');
        } catch (\Exception $e) {
            //return $e->getMessage();
        }
    } // /after login user can see only his/her profile

    //admin can view all user's profile
    public function userProfileAll($id)
    {
        try {
            $user_profile = User::find($id);
            return $user_profile;
            //return view('user.userprofile', compact('user_profile'));
        } catch (\Exception $e) {
            //return $e->getMessage();
        }
    } // /admin can view all user's profile

    public function searchUser(Request $request)
    {
        $searchtype = $request->publication_id; //such as id, name, contact, email, created_at, role etc 
        $searchitem = $request->searchtext; //get search item by the user 
        $selected_roles_id = $request->input('roles'); //get role if by the user 
        $selected_roles_name = Role::find($selected_roles_id); //get role name by role id 

        //algorithm for searching by using the information, which are given by the user 
        if ($searchtype == 'id') {
            $usersearchresult = User::where('id', $searchitem)->get();
        } elseif ($searchtype == 'role' && $searchitem == 'superadmin') {
            //get user or users who has a specific role 
            $usersearchresult = User::whereHas('roles', function ($q) {
                $q->where('name', 'superadmin');
            })->get(); // /get user or users who has a specific role 
        } elseif ($searchtype == 'role' && $searchitem == 'admin') {
            //get user or users who has a specific role 
            $usersearchresult = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->get(); // /get user or users who has a specific role 
        } elseif ($searchtype == 'role' && $searchitem == 'editor') {
            //get user or users who has a specific role 
            $usersearchresult = User::whereHas('roles', function ($q) {
                $q->where('name', 'editor');
            })->get(); // /get user or users who has a specific role 
        } elseif ($searchtype == 'role' && $searchitem == 'salesman') {
            //get user or users who has a specific role 
            $usersearchresult = User::whereHas('roles', function ($q) {
                $q->where('name', 'salesman');
            })->get(); // /get user or users who has a specific role 
        } elseif ($searchtype == 'role' && $searchitem == 'member') {
            //get user or users who has a specific role 
            $usersearchresult = User::whereHas('roles', function ($q) {
                $q->where('name', 'member');
            })->get(); // /get user or users who has a specific role             
        } else {
            $usersearchresult = User::where($searchtype, 'like', '%' . $searchitem . '%')->get();
        }
        //algorithm for searching by using the information, which are given by the user 

        //handling search result array 
        if (!$usersearchresult || $usersearchresult == " " || count($usersearchresult) < 1) {
            //if no data found             
            $message_data_not_found = 'No data found!';
            return view('user.usersearchresult', compact('usersearchresult', 'message_data_not_found'));
        } else {
            //if data found
            $message_data_not_found = '';
            return view('user.usersearchresult', compact('usersearchresult', 'message_data_not_found'));
        }
    }
}
