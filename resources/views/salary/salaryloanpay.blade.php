@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Loan Pay By The Employee</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <!-- main card-body -->
        <div class="card-body">
            <!-- form start -->
            <form role="form" id="quickForm" action="#" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <!-- Table Start -->
                    <table id="example2" class="table table-bordered text-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Salary_Advance_ID</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Salary Advance</th>
                                <th>Loan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="text-center">{{$salary_advance->id}}</td>
                                <td class="text-center">{{$salary_advance->emp_id}}</td>
                                <td class="text-center">{{App\Models\Employee::find($salary_advance->emp_id)->name}}</td>
                                <td class="text-center">{{$salary_advance->salary_advance}}</td>
                                <td class="text-center">{{$salary_advance->loan}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /Table End -->
                    <form role="form" id="quickForm" action="{{url('/employee/salaryloanpay/.{{$salary_advance->id')}}" method="post">
                        @csrf
                    </form>
                    <div class="form-group mt-2">
                        <div class="form-group">
                            <label for="reason">Pay</label>
                            <input type="text" name="pay" class="form-control" id="pay" placeholder="Amount of money" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection