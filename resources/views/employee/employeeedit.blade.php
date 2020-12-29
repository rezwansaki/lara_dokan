@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Employee Edit</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <!-- <div class="card-header">
            <h5 class="m-0">Create Role</h5>
        </div> -->
        <!-- main card-body -->
        <div class="card-body">
            <!-- form start -->
            <form role="form" id="quickForm" action="{{url('/user/employee/update/'.$employee->id)}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">User_ID</label>
                        <input disabled type="text" name="user_id" value="{{$employee->user_id}}" class="form-control" id="address" placeholder="{{$employee->user_id}}" required>
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
                        <input type="text" name="address" class="form-control" id="address" value="{{$employee->address}}" required>
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
                        <input type="text" name="phone" class="form-control" id="phone" value="{{$employee->phone}}" required>
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" name="salary" class="form-control" id="salary" value="{{$employee->salary}}" required>
                    </div>
                    <div class="form-group">
                        Role:
                        @foreach($emp_roles as $emp_role)
                        @if($emp_role == 'superadmin')
                        <span class="right badge badge-pill badge-danger">
                            {{ $emp_role }}
                        </span>
                        @endif
                        @if($emp_role == 'admin')
                        <span class="right badge badge-pill badge-warning">
                            {{ $emp_role }}
                        </span>
                        @endif
                        @if($emp_role == 'editor')
                        <span class="right badge badge-pill badge-primary">
                            {{ $emp_role }}
                        </span>
                        @endif
                        @if($emp_role == 'salesman')
                        <span class="right badge badge-pill badge-info">
                            {{ $emp_role }}
                        </span>
                        @endif
                        @if($emp_role == 'member')
                        <span class="right badge badge-pill badge-success">
                            {{ $emp_role }}
                        </span>
                        @endif
                        @endforeach
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection