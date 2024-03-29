@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Paid Information</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>Total Salary: <span class="right badge badge-pill badge-info">{{number_format($total_salary_paid, 2)}}</span> tk. has been paid.
                <span class="float-right badge badge-pill badge-primary text-sm">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
            </h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered text-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Sal_ID</th>
                        <th>Emp_ID</th>
                        <th>Name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Salary Paid</th>
                        <th>Salary Paid</th>
                        <th>Salary Edited</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($salary_details as $salary)
                    <tr>
                        <td class="text-center">{{$salary->id}}</td>
                        <td class="text-center">{{$salary->emp_id}}</td>
                        <td>{{App\Models\Employee::find($salary->emp_id)->name}}</td>
                        @php
                        $monthNum = $salary->month;
                        $dateObj = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        @endphp
                        <td>{{$monthName}}</td>
                        <td>{{$salary->year}}</td>
                        <td>
                            <h6>
                                <span class="right badge badge-pill badge-warning">
                                    {{number_format($salary->salary,2)}}
                                </span>
                            </h6>
                        </td>
                        <td>{{date_format($salary->created_at,'d-M-Y h:i a')}}</td>
                        <td>{{date_format($salary->updated_at,'d-M-Y h:i a')}}</td>
                        <td>
                            <a href="/employee/salaryedit/{{$salary->id}}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="/employee/salarydelete/{{$salary->id}}" class="btn btn-danger btn-xs" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $salary_details->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection