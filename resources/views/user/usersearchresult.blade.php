@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users Search Result</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <p class="text-lg text-red-500"><b>{{$message_data_not_found}}</b></p>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Total Users: {{count($usersearchresult)}}</h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($usersearchresult as $usersearchresult)
                    <tr>
                        <td>{{$usersearchresult->id}}</td>
                        <td>{{$usersearchresult->name}}</td>
                        <td>{{$usersearchresult->contact}}</td>
                        <td>{{$usersearchresult->email}}</td>
                        <td>
                            @foreach($usersearchresult->getRoleNames() as $userrole)
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
                            <a href="/user/edit/{{$usersearchresult->id}}" class="btn btn-primary btn-xs btn-block">Edit</a>
                            <a href="/user/delete/{{$usersearchresult->id}}" class="btn btn-danger btn-xs btn-block" id="delete">Delete</a>
                        </td>
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