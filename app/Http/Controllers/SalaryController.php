<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\SalaryAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    //Salary show
    public function index()
    {
        $all_employees = Employee::all();
        $previous_month = date('F', strtotime("last day of previous month")); //to show the last day of the previous month
        $current_year = date('Y', strtotime(now())); //to show the current year 
        return view('salary.salary', compact('all_employees', 'previous_month', 'current_year'));
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

    //salary delete 
    public function salaryDelete($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $salary = Salary::find($id);
            $salary->delete();
            //Toaster Message 
            $notification = array(
                'message' => 'Delete Successfully!',
                'alert-type' => 'success'
            );
            return redirect('/employee/salarydetails')->with($notification);
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // /salary delete 

    //salary advance 
    public function salaryAdvance()
    {
        $all_employees = Employee::all();
        return view('salary.salaryadvance', compact('all_employees'));
    } // /salary advance

    public function salaryAdvanceDone(Request $request)
    {
        $emp_id = $request->employee;
        $employee = Employee::find($emp_id); //get all data of that employee 
        $salary_advance = $employee->salary; //actual salary of that employee 
        $today = date('d-F-Y', strtotime(now())); //current date 
        $reason = $request->reason; //reason of that load (advance means loan)
        $loan_paid_Or_unpaid = 'unpaid'; //'paid','unpaid','' 

        //check if this employee's loan is unpaid
        $loan_status = SalaryAdvance::where('emp_id', $emp_id)->where('loan', 'unpaid')->get();
        if (!$loan_status || count($loan_status) < 1) {
            //if this employee paid all loan then 
            $salaryadvance = new SalaryAdvance;
            $salaryadvance->emp_id = $emp_id;
            $salaryadvance->salary_advance = $salary_advance;
            $salaryadvance->date = $today;
            $salaryadvance->reason = $reason;
            $salaryadvance->loan = $loan_paid_Or_unpaid;
            $salaryadvance->save();
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Advance Salary has been paid successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'The previous loan of this employee has not been repaid.!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
