@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create Product</h1>
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
            <form role="form" id="quickForm" action="{{url('/product/store')}}" method="post">
                @csrf
                <!-- card-body -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="productname">Product Name</label>
                        <input type="text" name="productname" class="form-control" id="productname" placeholder="productname" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" name="rate" class="form-control" id="rate" placeholder="rate" required>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
            </form>
            <!-- /form start -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection