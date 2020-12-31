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
            <h5>Total Employees: {{count($total_employees)}}
                <span class="float-right badge badge-pill badge-primary text-sm">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
            </h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered text-sm">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Emp_ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>District</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>User_ID</th>
                        <th>Role</th>
                        <th>Join Date</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody">
                    @foreach($all_employees as $employee)
                    <tr>
                        <td class="text-center">{{$employee->id}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->gender}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->district}}</td>
                        <td>{{$employee->phone}}</td>
                        <td class="text-right">
                            <h6>
                                <span class="right badge badge-pill badge-warning">
                                    {{number_format($employee->salary,2)}}
                                </span>
                            </h6>
                        </td>
                        <td class="text-center">{{$employee->user_id}}</td>
                        <td>
                            @foreach(App\Models\User::find($employee->user_id)->getRoleNames() as $userrole)
                            @if($userrole == 'superadmin')
                            <span class=" right badge badge-pill badge-danger">
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
                        <td>{{date_format($employee->created_at,'d-M-Y h:i a')}}</td>
                        <td>{{date_format($employee->updated_at,'d-M-Y h:i a')}}</td>
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