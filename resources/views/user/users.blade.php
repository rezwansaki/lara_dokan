@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">All Users</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <!-- Search Box -->
    <form action="/user/search" method="post">
        @csrf
        <!-- Search Type -->
        <label for="publication_id">Search Category</label>
        <div class="form-group">
            <select name="publication_id" id="publication_id" class="form-control input-sm">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="contact">Contact</option>
                <option value="email">Email</option>
                <option value="created_at">Created_At</option>
                <option value="role">Role</option>
                <option value="role">Join</option>
            </select>
        </div>
        <!-- show all roles from database -->
        <p class="mb-0">You can search by user role. All roles are:
            @foreach($all_roles as $role)
            <label class="ml-2">
                {{ $role->name }}
            </label>
            @endforeach
        </p>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="searchtext" placeholder="search... ex. 40 or, lorem or, 2020-12-24 or, @gmail.com or, 01245 or, editor ">
            <div class="input-group-append">
                <button class="input-group-text">Search</button>
            </div>
        </div>
    </form>
    <!-- /Search Box -->

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>Total Users: {{$total_users}}
                <span class="float-right badge badge-pill badge-primary text-sm">{{date('d-M-Y h:i a', strtotime(now()))}}</span>
            </h5>
        </div>
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered text-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>User_ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Join Date</th>
                        <th>Last Update</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_users as $user)
                    <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->contact}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @foreach($user->getRoleNames() as $userrole)
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
                        <td>{{date_format($user->created_at,'d-M-Y')}}</td>
                        <td>{{date_format($user->updated_at,'d-M-Y')}}</td>
                        <td>
                            <a href="/user/edit/{{$user->id}}" class="btn btn-primary btn-xs btn-block">Edit</a>
                            <a href="/user/delete/{{$user->id}}" class="btn btn-danger btn-xs btn-block" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $all_users->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection