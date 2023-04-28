@extends('admin.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sale - ePOS</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container">
    <div class="row">
        {{-- Left side --}}
      <div class="col-4">
        <a href="{{ url('/sales/newsale') }}" type="button" class="btn btn-success">New Sale</a>
       <div class="container pr-5">
         <!-- form start -->
         <form role="form" id="quickForm" action="{{url('/sales/addsale')}}" method="post">
            @csrf
            <div class="form-group">
                @php
                $total_products = App\Models\Product::orderBy('id','asc')->get();
                @endphp
                <label for="product_id">Product List</label> </br>
                <select name="product_id" id="product_id" class="form-control input-sm">
                    @foreach($total_products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->id }} - {{ $product->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="usercontact">Quantity</label>
                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="quantity" required>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <!-- /form end -->
       </div>
      </div>
      {{-- Left side --}}

      {{-- Right side --}}
      @php
      $invoice_id_max = App\Models\Invoice::all()->max('id');
      $sales = App\Models\Sales::orderBy('id','asc')->where('sale_id',$invoice_id_max)->get();
      $grand_total_price = App\Models\Sales::where('sale_id',$invoice_id_max)->sum('price');
      @endphp
      <div class="col-8">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <div><b>Sale/Invoice ID: </b> {{$invoice_id_max}}</div>
                </div>
            </div>
            <div class="col-sm-4">
                {{-- <div class="form-group">
                   <form action="{{url('/sales/addCustomerWithASingleSale')}}" method="post">
                    @csrf
                    <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="customer_id">
                    <button type="submit" class="btn btn-primary">Add</button>
                   </form>
                </div> --}}
            </div>
            <div class="col-sm-4">
                <div><b>Date: </b> {{ date('d-F-Y')}}</div>
            </div>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">P_ID</th>
                <th scope="col">Product</th>
                <th scope="col" style="text-align: right;">Rate</th>
                <th scope="col" style="text-align: center;">Quantity</th>
                <th scope="col" style="text-align: right;">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
              <tr>
                <td>{{$sale->product_id}}</td>
                <td>{{$sale->product_name}}</td>
                <td style="text-align: right;">{{ number_format((float)$sale->product_rate, 2, '.', '')}}</td>
                <td style="text-align: center;">{{$sale->sale_quantity}}</td>
                <td style="text-align: right;">{{ number_format((float)$sale->price, 2, '.', '')}}</td>
                <td>
                    {{-- <i class="fas fa-edit"></i> --}}
                    <a href="/sales/deletesale/{{$sale->id}}" class="btn btn-danger btn-xs" id="delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr class="table-primary">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>G.Total</b></td>
                    <td style="text-align: right;"><b>{{ number_format((float)$grand_total_price, 2, '.', '')}}</b></td>
                </tr>
            </tfoot>
          </table>
      </div>
       {{-- Right side --}}
    </div>
  </div>

@endsection