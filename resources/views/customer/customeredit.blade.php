@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Customer Edit</h1>
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
            <form role="form" id="quickForm" action="{{url('/user/customer/update/'.$user->id)}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{$user->name}}" placeholder="{{$user->name}}">
                        <!-- @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror -->
                        <div class="form-group">
                            <label for="usercontact">Contact</label>
                            <input type="text" name="usercontact" class="form-control" id="usercontact" value="{{$user->contact}}" placeholder="{{$user->contact}}">
                            <!-- @error('contact')
                            <span class="text-danger">{{$message}}</span>
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="useremail">Email</label>
                            <input type="text" name="useremail" class="form-control" id="useremail" value="{{$user->email}}" placeholder="{{$user->email}}">
                            <!-- @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" name="userpassword" class="form-control" id="userpassword" placeholder="Type your password">
                            <!-- @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror -->
                        </div>
                    </div>

                    <!-- User Roles -->
                    @foreach($allRoles as $role)
                    <label class="checkbox-inline mr-4 ml-4">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}" {{in_array($role->id, $assignedRoles) ? 'checked' : ''}}>
                        {{$role->name}}
                    </label>
                    @endforeach

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