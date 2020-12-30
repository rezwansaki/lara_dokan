@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Advance</h1>
                <p class="m-0 text-dark">(Note: No advance payment can be made for more than one month.)</p>
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
            <form role="form" id="quickForm" action="{{url('/employee/salaryadvance')}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="publication_id">Select Employee</label> </br>
                        <small class="m-0 text-black">(employee_id - employee_name)</small>
                        <div class="form-group">
                            <select name="employee" id="employee" class="form-control input-sm">
                                @foreach($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->id }} - {{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <input type="text" name="reason" class="form-control" id="reason" placeholder="Reason of loan" required>
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