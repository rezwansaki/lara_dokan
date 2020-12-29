@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Due (Current Year): '{{date('Y', strtotime(now()))}}'</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>Total Salary Due: <span class="right badge badge-pill badge-info">{{number_format((float)$salary_due_of_the_current_year->sum('salary'), 2)}}</span> tk.
                <span class="float-right badge badge-pill badge-primary text-sm">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
            </h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered table-hover text-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Sal_ID</th>
                        <th>Emp_ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Month</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($salary_due_of_the_current_year as $salary)
                    <tr>
                        <td class="text-center">{{$salary->id}}</td>
                        <td class="text-center">{{$salary->emp_id}}</td>
                        <td>{{App\Models\Employee::find($salary->emp_id)->name}}</td>
                        <td>{{App\Models\Employee::find($salary->emp_id)->salary}}</td>
                        @php
                        $monthNum = $salary->month;
                        $dateObj = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        @endphp
                        <td>{{$monthName}}</td>
                        <td>{{$salary->year}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">

            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection