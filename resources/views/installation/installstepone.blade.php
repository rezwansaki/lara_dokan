@extends('admin.admin')

@section('content')

<div class="container my-4">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Install: Step-1</h5>
            </div>
            <div class="card-body">
                <p>Open the terminal and go to the app.</p>
                <p>Run the command 'php artisan migrate:refresh'</p>
                <hr>
                <p><a href="/installsteptwo" class="btn btn-sm btn-primary">Step-2</a></p>
            </div>
        </div>
    </div>
</div>

@endsection