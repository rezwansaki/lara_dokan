<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

use PDF; //or 'use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;'

class SaleController extends Controller
{
    //index 
    public function index()
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            return view('sale.sale');
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } //index

    //new sales - when click the 'New Sale' button 
    public function newSale()
    {
        $invoice_id_max = Invoice::all()->max('id');
        $sale = Sales::where('sale_id', $invoice_id_max)->get();
        if (!$sale->isEmpty()) {
            $invoice = new Invoice;
            $invoice->save();
            return redirect()->back();
        } else {
            //Toaster Message 
            $notification = array(
                'message' => 'Please add sale item!',
                'alert-type' => 'error'
            );

            return redirect('/sales/epos')->with($notification);
        }
    } //new sales

    //add sale
    public function addSale(Request $request)
    {
        $invoice_id_max = Invoice::all()->max('id');
        $newSaleId = $invoice_id_max;

        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) { //authenticated user can access this  
            $product_id = $request->product_id;
            $product_name = Product::find($product_id)->name;
            $sale_id = $newSaleId;
            $product_rate = Product::find($product_id)->rate;
            $sale_quantity = $request->quantity;
            $price = $product_rate * $sale_quantity;

            $sale = new Sales;
            $sale->sale_id = $sale_id;
            $sale->product_id = $product_id;
            $sale->product_name = $product_name;
            $sale->product_rate = $product_rate;
            $sale->sale_quantity = $sale_quantity;
            $sale->price = $price;

            $sale->save();

            //Toaster Message 
            $notification = array(
                'message' => 'Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect('/sales/epos')->with($notification);
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } //add sale

    //product delete 
    public function deleteSale($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $sale = Sales::find($id);
            $sale->delete();
            //Toaster Message 
            $notification = array(
                'message' => 'Delete Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } //product delete 

    // to generate invoice 
    public function gen_invoice()
    {
        $pdf = PDF::loadView('sale.invoice'); //load html file for converting a pdf file 
        return $pdf->stream('invoice.pdf'); //open pdf in browser
    }
}
