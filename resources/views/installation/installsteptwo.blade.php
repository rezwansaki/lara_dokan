@extends('admin.admin')

@section('content')

<div class="container my-4">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Install: Step-2</h5>
            </div>
            <div class="card-body">
                <form role="form" id="quickForm" action="{{url('/install')}}" method="post">
                    @csrf
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="address">User Name</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter user name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">User Contact</label>
                            <input type="text" name="usercontact" class="form-control" id="usercontact" placeholder="Enter user contact" required>
                        </div>
                        <div class="form-group">
                            <label for="address">User Email</label>
                            <input type="text" name="useremail" class="form-control" id="useremail" placeholder="Enter user email address" required>
                        </div>
                        <div class="form-group">
                            <label for="address">User Password</label>
                            <input type="password" name="userpassword" class="form-control" id="userpassword" placeholder="Enter user password" required>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit and Install</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection