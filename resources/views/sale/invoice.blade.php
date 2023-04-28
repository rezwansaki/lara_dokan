<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>   
</head>
<body>

    <style>
        body {
            font-size: 12px;
        }
        #g-total {
            text-align: right;
            margin-top: 8px;
            border-top: 1px solid black;             
            border-bottom: 1px solid black;             
        }
        #footer-info {
            margin-top: 30px; 
            text-align: center;
            font-size: 8px; 
        }
        .float-parent-element { 
            width: 100%; 
            margin-bottom: 5px; 
        } 
        .float-child-element { 
            float: left; 
            width: 50%; 
        } 
        td {
        width: 80px;
        padding-bottom: 5px;
        }
    </style>

     {{-- Invoice --}}
 @php
 $invoice_id_max = App\Models\Invoice::all()->max('id');
 $sales = App\Models\Sales::orderBy('id','asc')->where('sale_id',$invoice_id_max)->get();
 $grand_total_price = App\Models\Sales::where('sale_id',$invoice_id_max)->sum('price');
 @endphp

 <div id="invoice">
    <h2 style="text-align:center;">Invoice</h2>
    <div class="float-parent-element">
        <div class="float-child-element">
          <div class="red"> Sale/Invoice ID: {{$invoice_id_max}}</div>
        </div>
        <div class="float-child-element">
          <div class="yellow">Date: {{ date('d-F-Y')}}</div>
        </div>
      </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col" style="text-align: left; padding-right:20px; border-bottom: 1px solid black;">Product</th>
                <th scope="col" style="text-align: right;padding-right:5px;border-bottom: 1px solid black;">Rate</th>
                <th scope="col" style="text-align: center; padding-right:5px;border-bottom: 1px solid black;">Qnty</th>
                <th scope="col" style="text-align: right;padding-right:5px;border-bottom: 1px solid black;">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
              <tr>
                <td style="text-align: left;">{{$sale->product_name}} new product name</td>
                <td style="text-align: right;">{{ number_format((float)$sale->product_rate, 2, '.', '')}}</td>
                <td style="text-align: center;">{{$sale->sale_quantity}}</td>
                <td style="text-align: right;">{{ number_format((float)$sale->price, 2, '.', '')}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div id="g-total"><b>Total: {{ number_format((float)$grand_total_price, 2, '.', '')}}</b></div>

          <div id="footer-info">
            Thank you! <br>
            Billing from {{ Auth::user()->name }} <br>
            Lara Dokan <br>
            Mirpur, Dhaka, Bangladesh. <br>
          </div>
 </div>
  {{-- Invoice --}}
</body>
</html>