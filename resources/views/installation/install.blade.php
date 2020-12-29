@extends('admin.admin')

@section('content')

<div class="container my-4">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Install The App or Recover SuperAdmin</h5>
            </div>
            <div class="card-body">
                <p><a href="/recoversuperadmin" class="btn btn-sm btn-primary">Recover SuperAdmin</a></p>
                <p><b>RecoverSuperAdmin method will not remove any data from database. It just try to see the superadmin and user ID 1 information.</b></p>
                <hr>
                <!-- Installation -->
                <p><a href="/installstepone" class="btn btn-lg btn-primary">Install The App</a></p>
                <p>Instruction:</p>
                <ul>
                    <li>1. Remove all data from database. So run 'php artisan migrate:refresh</li>
                    <li>2. Then click the button 'Install The App'.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <p>{{ $superadmin }}</p>
    <p><b>{{ $msg }}</b></p>
    <p>{{ $user }}</p>
</div>

@endsection