@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Employee Create</h1>
                <p class="m-0 text-red">
                    Note: An employee must have a user id! So, first the employee has to register!
                </p>
                <p class="m-0 text-sm text-black">
                    Tips: Go to User->'Create User' then go to 'Create Employee' then select 'User_ID' and other information then click the button 'Create Employee'.
                </p>
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
            <form role="form" id="quickForm" action="{{url('/user/employee/store')}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        @php
                        $total_employees = \DB::table('users AS t1')
                        ->select('t1.id', 't1.name')
                        ->leftJoin('employees AS t2','t2.user_id','=','t1.id')
                        ->whereNull('t2.user_id')
                        ->get();
                        @endphp
                        <label for="user_id">User_ID</label> </br>
                        <small class="m-0 text-black">(user_id - user_name)</small>
                        <select name="user_id" id="user_id" class="form-control input-sm">
                            @foreach($total_employees as $user_id)
                            <option value="{{ $user_id->id }}">
                                {{ $user_id->id }} - {{ $user_id->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <label for="gender">Gender</label>
                    <div class="form-group">
                        <select name="gender" id="gender" class="form-control input-sm">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" required>
                    </div>
                    <label for="district">District</label>
                    <div class="form-group">
                        @php
                        $districts = ["Barisal", "Chittagong", "Comilla", "Dhaka", "Gazipur", "Khulna", "Mymensingh", "Narayanganj", "Rajshahi", "Rangpur", "Sylhet"];
                        @endphp
                        <select name="district" id="district" class="form-control input-sm">
                            @foreach($districts as $district)
                            <option value="{{ $district }}">
                                {{ $district }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" required>
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" name="salary" class="form-control" id="salary" placeholder="Enter salary" required>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Employee</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection