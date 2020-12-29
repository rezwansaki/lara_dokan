@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Salary Edit</h1>
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
            <form role="form" id="quickForm" action="{{url('/employee/salaryupdate/'.$salary->id)}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="publication_id">Select Employee</label> </br>
                        <small class="m-0 text-black">(employee_id - employee_name)</small>
                        <div class="form-group">
                            <select name="employee" id="employee" class="form-control input-sm">
                                <option hidden value="{{ $salary->emp_id }}" selected>{{ $salary->emp_id }} - {{ App\Models\Employee::find($salary->emp_id)->name }}</option>
                                @foreach($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->id }} - {{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="publication_id">Select Month</label>
                        <div class="form-group">
                            <select name="month" id="month" class="form-control input-sm">
                                <option hidden value="{{ $salary->month }}" selected>{{ $salary->month }}</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <label for="publication_id">Select Year</label>
                        <div class="form-group">
                            <select name="year" id="year" class="form-control input-sm">
                                <option hidden value="{{ $salary->year }}">{{ $salary->year }}</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salary Provide</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection