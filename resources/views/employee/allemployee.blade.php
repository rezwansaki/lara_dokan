@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">All Employees</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Total Employees: {{count($total_employees)}}</h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Emp_ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>District</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>User_ID</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($all_employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->gender}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->district}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->salary}}</td>
                        <td>{{$employee->user_id}}</td>
                        <td>
                            @foreach(App\Models\User::find($employee->user_id)->getRoleNames() as $userrole)
                            @if($userrole == 'superadmin')
                            <span class="right badge badge-pill badge-danger">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'admin')
                            <span class="right badge badge-pill badge-warning">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'editor')
                            <span class="right badge badge-pill badge-primary">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'salesman')
                            <span class="right badge badge-pill badge-info">
                                {{ $userrole }}
                            </span>
                            @endif
                            @if($userrole == 'member')
                            <span class="right badge badge-pill badge-success">
                                {{ $userrole }}
                            </span>
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="/user/employee/edit/{{$employee->id}}" class="btn btn-primary btn-xs btn-block">Edit</a>
                            <a href="/user/employee/delete/{{$employee->id}}" class="btn btn-danger btn-xs btn-block" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $all_employees->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection