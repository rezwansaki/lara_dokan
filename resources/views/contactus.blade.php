@extends('admin.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Contact Us</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container">
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>Main Branch</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>Dokan</b></h2>
                        <p class="text-muted text-sm">A small shop.</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center p-0">
                        <img src="{{'adminlte'}}/dist/img/photo.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection