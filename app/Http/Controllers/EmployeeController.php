<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //create employee
    public function createEmployees()
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            return view('employee.employeecreate');
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // /create employee

    //store employee data in database
    public function storeEmployees(Request $request)
    {
        try {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) { //authenticated user can access this  
                $emp_user_id = $request->user_id;
                $emp_name = User::find($emp_user_id)->name;
                $emp_gender = $request->gender;
                $emp_address = $request->address;
                $emp_district = $request->district;
                $emp_phone = $request->phone;
                $emp_salary = $request->salary;

                $employee = new Employee;
                $employee->name = $emp_name;
                $employee->gender = $emp_gender;
                $employee->address = $emp_address;
                $employee->district = $emp_district;
                $employee->phone = $emp_phone;
                $employee->salary = $emp_salary;
                $employee->user_id = $emp_user_id;

                if (!$emp_name || !$emp_gender || !$emp_address || !$emp_district || !$emp_phone || !$emp_salary || !$emp_user_id) {
                    //Toaster Message show, when user create fail
                    $notification = array(
                        'message' => 'Create Employee Fail!',
                        'alert-type' => 'error'
                    );

                    return redirect('/user/employee/create')->with($notification);
                } else {
                    //when user create successfully 
                    $employee->save();

                    //Toaster Message 
                    $notification = array(
                        'message' => 'Create User Successfully!',
                        'alert-type' => 'success'
                    );

                    return redirect('/user/employee/create')->with($notification);
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
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Oops!! Fail the process! An employee can only open one account using the same user ID. An employee must have a user id! So, first the employee has to register!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    } // /store employee data 

    //show all employees
    public function allEmployees()
    {
        $auth_user = Auth::user();
        $all_roles = Role::all();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            //superadmin can access
            $all_employees = Employee::paginate(8);
            //get all employees
            $total_employees = Employee::all();
            return view('employee.allemployee', compact('all_employees', 'total_employees'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    } // /show all employees

    //edit employee
    public function employeeEdit($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $employee = Employee::find($id);
            $user_id = User::find($employee->user_id);
            $emp_roles = $user_id->getRoleNames();
            return view('employee.employeeedit', compact('employee', 'emp_roles'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // /edit employee

    //update employee
    public function employeeUpdate(Request $request, $id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            //
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) {
                $employee = Employee::find($id);

                $new_user_id = $request->user_id;
                $new_user_name = $request->name;
                $new_gender = $request->gender;
                $new_address = $request->address;
                $new_district = $request->district;
                $new_phone = $request->phone;
                $new_salary = $request->salary;

                $new_user_id = $employee->user_id;
                if (!$new_user_name) {
                    $new_user_name = $employee->name;
                }
                if (!$new_gender) {
                    $new_gender = $employee->gender;
                }
                if (!$new_address) {
                    $new_address = $employee->address;
                }
                if (!$new_district) {
                    $new_district = $employee->district;
                }
                if (!$new_phone) {
                    $new_phone = $employee->phone;
                }
                if (!$new_salary) {
                    $new_salary = $employee->salary;
                }

                $employee->name = $new_user_name;
                $employee->gender = $new_gender;
                $employee->address = $new_address;
                $employee->district = $new_district;
                $employee->phone = $new_phone;
                $employee->salary = $new_salary;
                $employee->user_id = $new_user_id;

                $employee->save();

                //Toaster Message 
                $notification = array(
                    'message' => 'Update Successfully!',
                    'alert-type' => 'success'
                );

                return redirect('/user/allemployees')->with($notification);
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
    } // /update employee

    //employee delete 
    public function employeeDelete($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $employee = Employee::find($id);
            $selected_roles = 'member';
            $user = User::find($employee->user_id);
            $user->syncRoles($selected_roles);
            $employee->delete();
            //Toaster Message 
            $notification = array(
                'message' => 'Delete Successfully!',
                'alert-type' => 'success'
            );
            return redirect('/user/allemployees')->with($notification);
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // /employee delete 

}
