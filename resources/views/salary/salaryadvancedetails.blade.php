@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Advance Information</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>Total Salary Advance:
                @if($total_salary_advance_paid > 0)
                <span class="right badge badge-pill badge-danger">{{number_format($total_salary_advance_paid, 2)}}</span>
                @else
                <span class="right badge badge-pill badge-success">{{number_format($total_salary_advance_paid, 2)}}</span>
                @endif
                tk. has been paid.
                <span class="float-right badge badge-pill badge-primary text-sm">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
            </h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered text-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Sal_Adv_ID</th>
                        <th>Emp_ID</th>
                        <th>Name</th>
                        <th>Salary Advance Paid</th>
                        <th>Date</th>
                        <th>Reason</th>
                        <th>Loan</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($salary_advance_details as $salary)
                    <tr>
                        <td class="text-center">{{$salary->id}}</td>
                        <td class="text-center">{{$salary->emp_id}}</td>
                        <td>{{App\Models\Employee::find($salary->emp_id)->name}}</td>
                        <td>
                            <h6>
                                @if($salary->salary_advance > 0)
                                <span class="right badge badge-pill badge-warning">
                                    {{number_format($salary->salary_advance,2)}}
                                </span>
                                @else
                                <span class="right badge badge-pill badge-success">
                                    {{number_format($salary->salary_advance,2)}}
                                </span>
                                @endif
                            </h6>
                        </td>
                        <td class="text-center">{{$salary->date}}</td>
                        <td class="text-center">{{$salary->reason}}</td>
                        <td class="text-center">{{$salary->loan}}</td>
                        <td>
                            <a href="/employee/salaryloanpay/{{$salary->id}}" class="btn btn-info btn-xs">Pay</a>
                            <a href="#" class="btn btn-primary btn-xs">Edit</a>
                            <a href="#" class="btn btn-danger btn-xs" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $salary_advance_details->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection