@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create User</h1>
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
            <form role="form" id="quickForm" action="{{url('/userstore')}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="name" required>
                    </div>
                    <div class="form-group">
                        <label for="usercontact">Contact</label>
                        <input type="text" name="usercontact" class="form-control" id="usercontact" placeholder="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="useremail">Email</label>
                        <input type="text" name="useremail" class="form-control" id="useremail" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" name="userpassword" class="form-control" id="userpassword" placeholder="password" required>
                    </div>

                    <!-- User Roles -->
                    @foreach($allRoles as $role)
                    <label class="checkbox-inline mr-4 ml-4">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}">
                        {{$role->name}}
                    </label>
                    @endforeach

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection