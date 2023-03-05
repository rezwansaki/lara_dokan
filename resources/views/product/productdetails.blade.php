@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product Information</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="col-sm-12">
    <div class="card card-primary card-outline">
        <!-- main card-body -->
        <div class="card-body">
            <!-- Table Start -->
            <table id="example2" class="table table-bordered text-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Product_ID</th>
                        <th>Product_Name</th>
                        <th>Product_Quantity</th>
                        <th>Product_Rate</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($product_details as $product)
                    <tr>
                        <td class="text-center">{{$product->id}}</td>
                        <td class="text-center">{{$product->name}}</td>
                        <td class="text-center">{{$product->quantity}}</td>
                        <td class="text-center">{{$product->rate}}</td>
                        <td>
                            <a href="/product/productedit/{{$product->id}}" class="btn btn-primary btn-xs">Edit</a>
                            <a href="/product/productdelete/{{$product->id}}" class="btn btn-danger btn-xs" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /Table End -->

            <!-- pagination -->
            <div class="col-md-12 mt-2 mb-4">
                {{ $product_details->links() }}
            </div>
            <!-- /end of pagination -->
        </div>
        <!-- /main card-body -->
    </div>
</div>

@endsection