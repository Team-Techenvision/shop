<?php

namespace App\Http\Controllers;
use DB;
use App\shop_stock;
use App\gsttax;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function UserList(){
        $data['flag'] = 1;
        $data['page_title'] = 'View User';
        $data['users'] = DB::table('users')->orderBy('id','desc')->get(); 
        return view('admin/components/admin_user_list',$data);
    }
    public function UserAdd(){
        $data['flag'] = 2;
        $data['page_title'] = 'Add User';
        return view('admin/webviews/admin_user_add',$data);
    }

    //Shop stock Add
    public function StockList(){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'View Stock';
        $data['flag'] = 1; 
        $data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function StockAdd(){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Add Stock';
        $data['flag'] = 2; 
        $data['product'] = DB::table('products')->where('status',0)->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function StockEdit($shop_stock_id){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Edit Stock';
        $data['flag'] = 3; 
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function StockUpdate($shop_stock_id){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Update Stock';
        $data['flag'] = 4; 
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function StockDelete($shop_stock_id){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Delete Stock';
        $data['flag'] = 5; 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    //new code rahul
    public function customerorder()
    {
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Customer Order';
        $data['flag'] = 6;
        // $data['product'] = DB::table('products')->where('status',0)->get(); 
        return view('admin/webviews/admin_manage_stock',$data);

    }
    public function add_cust_order(Request $req)
    {
        // dd($req);
        $this->validate($req, [
            'customer_no' => 'required|digits:10|numeric'
        ]);

           $check_customer = DB::table('users')->where('phone',$req->customer_no)->get();
           //dd($check_customer);
           if($check_customer->isEmpty())
           {
             dd($check_customer); 
           }
           else
           {
                $data['main_breadcrum'] = 'Stock';
                $data['page_title'] = 'Add Customer Order';
                $data['flag'] = 7;
                $data['product'] = DB::table('products')->where('status',0)->get(); 
                return view('admin/webviews/admin_manage_stock',$data);
           }

        // $data['main_breadcrum'] = 'Stock';
        // $data['page_title'] = 'Add Customer Order';
        // $data['flag'] = 7;
        // $data['product'] = DB::table('products')->where('status',0)->get(); 
        // return view('admin/webviews/admin_manage_stock',$data);
    }

    public function product_detail()
    {
        $p_id  = $_POST['product'];
       // $product = DB::table('products')->where('products_id',$p_id)->first();
        //$gst = DB::table('gst_tax')->where('gst_tax.gst_id',1)->get();

       // $product = DB::table( "SELECT * FROM products INNER JOIN gst_tax ON products.gst_id = gst_tax.gst_id WHERE products.products_id = $p_id");
        
       $product = DB::table('products')
            ->join('gst_tax', 'products.gst_id', '=', 'gst_tax.gst_id')            
            ->select('products.price','products.special_price','gst_tax.gst_value_percentage')
            ->where('products_id','=',$p_id )
            ->get(); 
        // $product1['price'] = $product->price;
        // $product1['gst'] = $product->gst_value_percentage;
          
        return $product;    
     //return response()->JSON.parse('{ "price":"$product->price", "gst":"$product->gst_value_percentage"}');
     //return json(result('price'->$product->price,'gst'->$gst->gst_value_percentage));
        
    }
    //new code 
    public function addproductorder(Request $req)
    {
        // dd($req);
        $product_id = $req->product_name;
        $product_qty = $req->p_qty;
        $product_expiry = $req->exp_date;
        $tax = $req->product_tax;
        $shop_id = 101;

        // $this->validate($request,[
        //     'p_qty'=>'required|numeric',
        //     'exp_date'=>'required|date'
        //  ]);

        $data1 = new shop_stock;           
            $data1->products_id=$product_id;
            $data1->shop_id= $shop_id;
            $data1->input_quantity=$product_qty; 
            $data1->expiry_date=$product_expiry;
            $data1->tax=$tax; 
            $data1->save();
            return back(); 
        
    }

}
