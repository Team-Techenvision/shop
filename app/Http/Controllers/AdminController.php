<?php

namespace App\Http\Controllers;
use DB;
use App\shop_stock;
use App\gsttax;
use App\product_order;
use App\User;
use App\order_item;
use App;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        $shop_id = "101";
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'View Stock';
        $data['flag'] = 1; 
       // $data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        $data['product'] = DB::table('shop_stocks')
           ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')            
           ->select('products.*','shop_stocks.*')
           ->where('shop_stocks.shop_id','=',$shop_id)
           ->get(); 
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

    public function ShopHome(Request $req)
    {              
        //dd($req);
        $this->validate($req, [
            'login_id' => 'required',
            'login_pass'=> 'required'
        ]);
        $sh_id = $req->login_id;
        $password = $req->login_pass;

        if($sh_id == "1234567890" &&  $password == "12345")
        {
            return view('dashboard');
        }
        else
        {
            return back();
        }

    }
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
        $shop_id = $req->shop_id;        
        $cust_phone = $req->customer_no;
        //dd($shop_id);
        $this->validate($req, [
            'customer_no' => 'required|digits:10|numeric'
        ]);

           $check_customer = DB::table('users')->where('phone',$req->customer_no)->get();
        //    dd($check_customer);
           if($check_customer->isEmpty())
           {
             
             $data1 = new User;
             $data1->phone=$cust_phone;
             $data1->shop_id=$shop_id;
             $data1->save();
             $data['u_id']=$data1->id;
             //dd($data1->id); 
           }
           else
           {   
            $check_customer = DB::table('users')->where('phone',$req->customer_no)->first();               
            $data['u_id']=$check_customer->id;  
           }

           $data['main_breadcrum'] = 'Stock';
           $data['page_title'] = 'Add Customer Order';
           $data['flag'] = 7; 
           //dd($data['u_id']);          
          // $data['product'] = DB::table('products')->where('status',0)->get();
           $data['product'] = DB::table('shop_stocks')
           ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')            
           ->select('products.*')
           ->where('shop_stocks.shop_id','=',$shop_id)
           ->get(); 
        //   dd($data['product']);
           return view('admin/webviews/admin_manage_stock',$data);
         
    }
// ==============================jquery function event=====================================
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

           $producttest['data'] =  $product; 
       echo json_encode($producttest);
       exit; 
      
    }
    // ==============================================================
    public function submitcustorder(Request $req)
    {  //dd($req);
       //dd(count($req->product_name));
       // $lenght = count($req->product_name);
       //for($i=0;i<lenght;$i++)   
       
      $shop_id = $req->shop_id;
      $cust_id = $req->cust_id;
      $total_amt = $req->total;
      $order_id = uniqid();
      $payment_mode = "shop";

      $data1 = new product_order; 
             $data1->shop_id=$shop_id;
             $data1->user_id= $cust_id;
             $data1->amount=$total_amt;                      
             $data1->order_id=$order_id;
             $data1->payment_mode=$payment_mode; 
             $data1->save();
             $last_id=$data1->id;
             $orders = DB::table('orders')->where('id',$last_id)->first();
             $order_id = $orders->order_id;

             //dd( $order_id);
            
             $i = 0;
             foreach($req->product_name as $row)
             {             
              $data = new order_item; 
              $data->order_id= $order_id;
              $data->sub_order_id= $order_id;
              $data->prod_id=$req->product_name[$i];              
              $data->quantity=$req->p_qty[$i];
              $data->order_status=5;
              $data->sub_total=$req->p_price[$i];             
              $data->save();  
              $i++;
             }
            //  =============================== 
            // $data['product'] = DB::table('orders')
            // ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
            // ->join('products', 'products.products_id', '=', 'order_items.prod_id')
            // ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
            // ->select('orders.*','order_items.*','products.*','gst_tax.*')
            // ->where('orders.order_id','=', $order_id )
            // ->get(); 
          
            $data['main_breadcrum'] = 'Order';
            $data['page_title'] = 'Customer Oder';
            $data['flag'] = 11; 
            $data['product_order'] = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
            ->join('products', 'products.products_id', '=', 'order_items.prod_id')
            ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
            ->select('orders.*','order_items.*','products.product_name','gst_tax.*')
            ->where('orders.order_id','=', $order_id )
            ->get(); 
            
            //dd($data['product']);
            // return view('dashboard');
                
         return view('admin/webviews/admin_manage_stock',$data);    
    }
// ==============================================
public function add_shopEmployee()
{
    //echo "Hello";
    $data['main_breadcrum'] = 'Shop';
    $data['page_title'] = 'Add Employee';
    $data['flag'] = 10; 
    return view('admin/webviews/admin_manage_stock',$data);

}

public function show_shopEmployee()
{
    //echo "hello";
    $data['main_breadcrum'] = 'Shop';
    $data['page_title'] = 'Employee';
    $data['flag'] = 9;
    $shop_id = 101;   
    $data['shop_Employee'] = DB::table('users')->where('shop_id',$shop_id)->where('user_type',7)->get(); 
    //dd($data['shop_Employee']);
    return view('admin/webviews/admin_manage_stock',$data);
}

public function submit_shopEmp(Request $req)
{
    //dd($req);
    $this->validate($req,[
        'emp_name'=>'required|alpha',        
        'email'=>'nullable|email',
        'phone_no'=>'required|numeric',             
        'password'=>'required|max:8|Min:5'
     ]);
        
       $password = "123456";
       $shop_id = 101;
       $user_type = 7; //(7- shop Employee)
     
        $data = new User;
            $data->name=$req->emp_name;
            $data->email=$req->email;
            $data->phone=$req->phone_no;
            $data->password=$password;            
            $data->user_type=$user_type;
            $data->shop_id=$shop_id;
        $result = $data->save();
        if($result)
        {
            $req->session()->flash('alert-success', 'Employee was Successfully Added!');
        }
        else
        {
            $req->session()->flash('alert-danger', 'Employee Not Added!');
        }       

     return back(); 
}

public function cust_order_list($order_id)
{
    // echo "hello";
    //  $order_id = "601b66e5319f4";
    // $order_id = $order_id;
    $data['main_breadcrum'] = 'Order';
    $data['page_title'] = 'Customer Oder';
    $data['flag'] = 11; 
    $data['product_order'] = DB::table('orders')
    ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
    ->join('products', 'products.products_id', '=', 'order_items.prod_id')
    ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
    ->select('orders.*','order_items.*','products.product_name','gst_tax.*')
    ->where('orders.order_id','=', $order_id )
    ->get(); 
    //dd($data['product_order']); 
    return view('admin/webviews/admin_manage_stock',$data);
}

// ========================================


    public function pdf_view()
     {  
        $pdf = PDF::loadView('invoice');
        return $pdf->download('invoice.pdf');

       // return view('admin/webviews/order_pdf');
         //   $p_id = 512;
    //     $product = DB::table('products')->where('products_id',$p_id)->first();
    //     view()->share('items',$product);        
        
    //         $pdf = PDF::loadView('order_pdf');
    //        $pdf->download('order_pdf.pdf');
    // $pdf = App::make('dompdf.wrapper');
    // $data = "<table style='border:1px solid black;width:95%;margin:auto;'><thead><tr><th>Product</th><th>Price</th><th>Quntity</th></tr></thead><tbody><tr><th>ABC</th><th>100</th><th>10</th></tr></tbody></table>";
    // // $pdf->loadhtml('<h1>Welcome</h1>');
    // $pdf->loadhtml($data);
    // return $pdf->stream();
        // return view('admin/webviews/order_pdf');
    }
    public function vieworder(Request $req)
    {
        $data['main_breadcrum'] = 'Order';
        $data['page_title'] = 'Customer Oder';
        $data['flag'] = 8; 
        $data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    //new code 
    public function addproductorder(Request $req)
    {
        // dd($req);
        $this->validate($req,[
            'p_qty'=>'required|numeric',
            'exp_date'=>'required|date'
         ]);
        $product_id = $req->product_name;
        $product_qty = $req->p_qty;        
        $product_expiry = $req->exp_date;
        $gst = DB::table('products')->where('products_id', $product_id)->first();       
         $tax = $gst->gst_id;
         //dd($tax);
        $shop_id = 101;  
        $seven_random_number = mt_rand(0, 9999999); 
        $barcode =  $shop_id.$seven_random_number; 
        // dd($barcode);

        $data1 = new shop_stock;           
            $data1->products_id=$product_id;
            $data1->shop_id= $shop_id;
            $data1->input_quantity=$product_qty;
            $data1->avl_quantity= $product_qty;
            $data1->expiry_date=$product_expiry;
            $data1->tax=$tax;
            $data1->barcode =$barcode; 
            $result = $data1->save();
            if($result)
            {
                $req->session()->flash('alert-success', 'Product was Successful Added!');
            }
            else
            {
                $req->session()->flash('alert-danger', 'Product Not Added!');
            }
            return back(); 
        
    }
    public function print_Barcode()
    {
        $data['main_breadcrum'] = 'BarCode';
        $data['page_title'] = 'Create BarCode';
        $data['flag'] = 12; 
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    public function change_emp_status(Request $req)
    {
        //dd($req);
        $shop_emp_id = $req->emp_id;
        $isblock_status = $req->emp_isblock;
        //dd($isblock_status);
        $ch_value="";
        if($isblock_status == "0")
        {
            $ch_value = 1;
        }
        else{
            $ch_value = 0;
        }

        //dd($ch_value);
        $affected = DB::table('users')
              ->where('id',$shop_emp_id)
              ->update(['is_block' => $ch_value]);
          if($affected)
          {             
            $req->session()->flash('alert-success', 'Employee Status Updated Successfully!!');             
          }
          else
          {
            $req->session()->flash('alert-danger', 'Employee Status Not Updated!!');            
          }    
        return back();
    }
    // new new code
    public function show_shop_invoice()
    {
        $shop_id = 101;
        $data['main_breadcrum'] = 'Shop';
        $data['page_title'] = 'Shop Order List';
        $data['flag'] = 13; 
        $data['shop_orders'] = DB::table('users')
        ->join('orders', 'users.id', '=','orders.user_id')
        ->select('orders.*','users.phone')
        ->where('orders.shop_id','=', $shop_id)
        ->get(); 
        // dd( $data['shop_orders']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
}
