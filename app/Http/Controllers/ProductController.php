<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //create product
    public function index()
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            return view('product.productcreate');
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // create product 

    //store product 
    public function storeProduct(Request $request)
    {
        try {
            $auth_user = Auth::user();
            if ($auth_user->hasRole(['superadmin', 'admin'])) { //authenticated user can access this  
                $product_name = $request->productname;
                $product_quantity = $request->quantity;
                $product_rate = $request->rate;

                $product = new Product;
                $product->name = $product_name;
                $product->quantity = $product_quantity;
                $product->rate = $product_rate;

                if (!$product_name || !$product_quantity || !$product_rate) {
                    //Toaster Message show, when user create fail
                    $notification = array(
                        'message' => 'Create Employee Fail!',
                        'alert-type' => 'error'
                    );

                    return redirect('/product')->with($notification);
                } else {
                    //when user create successfully 
                    $product->save();

                    //Toaster Message 
                    $notification = array(
                        'message' => 'Create Product Successfully!',
                        'alert-type' => 'success'
                    );

                    return redirect('/product')->with($notification);
                }
            } else {
                //If not superadmin 
                //Toaster Message show, when user create fail
                $notification = array(
                    'message' => 'This section is not for you!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            //return $e->getMessage();
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'Oops!! Fail the process!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    } // /store product 

    //show all products
    public function allProducts()
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $product_details = Product::orderBy('id', 'desc')->paginate(8);
            return view('product.productdetails', compact('product_details'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } //show all products

    //edit product
    public function productEdit($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $product = Product::find($id);
            return view('product.productedit', compact('product'));
        } else {
            //If not superadmin 
            //Toaster Message show, when user create fail
            $notification = array(
                'message' => 'This section is not for you!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } //edit product 

    //product update
    public function productUpdate(Request $request, $id)
    {
        $product = Product::find($id);
        $product_name = $request->productname;
        $product_quantity = $request->quantity;
        $product_rate = $request->rate;

        $product->name = $product_name;
        $product->quantity = $product_quantity;
        $product->rate = $product_rate;

        $product->save();

        //Toaster Message show, when user create fail
        $notification = array(
            'message' => 'Product has been updated successfully!',
            'alert-type' => 'success'
        );

        return redirect('/product/show')->with($notification);
    } //product update

    //product delete 
    public function productDelete($id)
    {
        $auth_user = Auth::user();
        if ($auth_user->hasRole(['superadmin', 'admin'])) {
            $salary = Product::find($id);
            $salary->delete();
            //Toaster Message 
            $notification = array(
                'message' => 'Delete Successfully!',
                'alert-type' => 'success'
            );
            return redirect('/product/show')->with($notification);
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
}
