<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    //Salary show
    public function index()
    {
        $all_employees = Employee::all();
        return view('salary.salary', compact('all_employees'));
    }

    //Salary provide
    public function salaryProvide(Request $request)
    {
        $employee_id = $request->employee;
        $month = $request->month;
        $year = $request->year;

        $employee = Employee::find($employee_id);
        $employee_salary = $employee->salary;
        $salary_provide = $employee_salary;

        //Check if it has been given before 
        $salary_check = Salary::where('emp_id', $employee_id)->where('year', $year)->where('month', $month)->get();

        if (!$salary_check || count($salary_check) < 1) {
            $salary = new Salary;
            $salary->emp_id = $employee_id;
            $salary->month = $month;
            $salary->year = $year;
            $salary->salary = $salary_provide;

            $salary->save();

            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Salary has been paid successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Salary has already been paid!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return redirect()->back();
    }

    //Salary details
    public function salaryDetails()
    {
        $salary_details = Salary::orderBy('id', 'desc')->paginate(8);
        $total_salary_paid = (float)Salary::all()->sum('salary');
        return view('salary.salarydetails', compact('salary_details', 'total_salary_paid'));
    } // /salary details

    //salary edit
    public function salaryEdit($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $salary = Salary::find($id);
            $all_employees = Employee::all();
            return view('salary.salaryedit', compact('salary', 'all_employees'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // /salary edit

    //salary update
    public function salaryUpdate(Request $request, $id)
    {
        $employee_id = $request->employee;
        $month = $request->month;
        $year = $request->year;

        $employee = Employee::find($employee_id);
        $employee_salary = $employee->salary;
        $salary_provide = $employee_salary;

        //Check if it has been given before 
        $salary_check = Salary::where('emp_id', $employee_id)->where('year', $year)->where('month', $month)->get();

        if (!$salary_check || count($salary_check) < 1) {
            $salary = Salary::find($id);
            $salary->emp_id = $employee_id;
            $salary->month = $month;
            $salary->year = $year;
            $salary->salary = $salary_provide;

            $salary->save();

            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Salary has been updated successfully!',
                'alert-type' => 'success'
            );

            return redirect('/employee/salarydetails')->with($notification);
        } else {
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Salary has already been paid!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return redirect()->back();
    } // /salary update
}
