<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use App\shop_stock;
use App\gsttax;
use App\product_order;
use App\User;
use App\order_item;
use App\DeWallet;
use App\Return_Stock;
use App;
use Auth;
use PDF;
use redirect;
use Session;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    // login code
    public function postlogin(Request $req){
    // dd($req);
    $data['phone'] = $req->get('phone');
    $data['password'] = $req->get('password');

    if(Auth::attempt($data))
    {
        return redirect('/home-bash');
    }else {
            // toastr()->success('Your Address Edit Successfull');
            return back()->with('message','Invalid Username Or Password');
            
        }
    }

    // logout code
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }

    // ========================================
    public function home_dashboard()
    {
        $data['flag'] = 1;
        $shop_id = Auth::user()->shop_id; 
        $Count_Customer1 = DB::select("SELECT * FROM users WHERE shop_id =$shop_id AND user_type=2");
        $Count_staff = DB::select("SELECT * FROM users WHERE (shop_id =$shop_id AND role IS NOT null)");
        $top_selling = DB::select("SELECT SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=104) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC LIMIT 1");
        $data['top_sell']=0;
        foreach($top_selling  as $r)
        {
            $data['top_sell'] = $r->MAXsell;
        }
        $daily_sell = DB::select("select SUM(`amount`) as t_sell from orders where (shop_id=104 AND `created_at` >= CURDATE())");
        // dd($data['daily_sell']);
        foreach($daily_sell  as $r)
        {
            $data['daily_sell1']= $r->t_sell;
        }
        
        $Count_stock1 = DB::select("SELECT DISTINCT `attribute_id` as count_product FROM `shop_stocks` WHERE shop_id=$shop_id"); 
        $expiry_stock1 = DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,`expiry_date` from shop_stocks where expiry_date < now() + INTERVAL 30 day AND shop_id=$shop_id"); 
        $return_stock = DB::select("SELECT * FROM return_stock WHERE shop_id=$shop_id"); 
        
        $data['Count_Customer'] = count( $Count_Customer1);
        // dd($data['Count_Customer']);
        $data['Count_stock'] = count($Count_stock1);
        // dd($data['Count_stock1']);
        $data['expiry_stock'] = count($expiry_stock1);
        // dd($data['expiry_stock']);
        $data['return_stock'] = count($return_stock);
        $data['Count_staff'] = count($Count_staff);
                   
        return view('dashboard',$data);
    }

    // =========================================
 
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

        if(Auth::user()->role == 1)
        {
            $shop_id = Auth::user()->shop_id;
            $data['main_breadcrum'] = 'Stock';
            $data['page_title'] = 'View Stock';
            $data['flag'] = 1; 
            // $data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
            // $data['product'] = DB::table('shop_stocks')
            // ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')            
            // ->select('products.*','shop_stocks.*')
            // ->where('shop_stocks.shop_id','=',$shop_id)
            // ->get(); 
            // $data['product'] = DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name,p_attr.barcode,s_stock.input_quantity,s_stock.expiry_date, SUM(s_stock.avl_quantity) as avl_quantity FROM shop_stocks s_stock INNER JOIN products ON(products.products_id=s_stock.products_id)INNER JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC");       
            $data['product'] = DB::select("SELECT products.products_id,products.product_name,sizes.size_name,shop_stocks.input_quantity,shop_stocks.avl_quantity,shop_stocks.expiry_date,p_atrr.barcode FROM shop_stocks LEFT JOIN products ON (products.products_id=shop_stocks.products_id)LEFT JOIN product_attributes p_atrr ON(p_atrr.id=shop_stocks.attribute_id) LEFT JOIN sizes ON(sizes.id=p_atrr.product_size) WHERE (shop_stocks.shop_id=$shop_id) ORDER BY shop_stocks.avl_quantity ASC");       
            
            //  dd($data['product'] );
            return view('admin/webviews/admin_manage_stock',$data);
        }
        else
        {
            return back();
        }    

    }

    public function StockAdd(){
        
        if(Auth::user()->role == 1)
        {
            $data['main_breadcrum'] = 'Stock';
            $data['page_title'] = 'Add Stock';
            $data['flag'] = 2; 
            $data['product'] = DB::table('products')->where('status',0)->get(); 
            return view('admin/webviews/admin_manage_stock',$data);
        }
        else
        {
            return back();
        }    
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

    public function Returnstock(){
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 15;
        // $data['product'] = DB::table('products')->where('status',0)->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function Productbarcode(Request $req){
        //  dd($req);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 15;
        $barcode = $req->barcode;
        $shop_id = Auth::user()->shop_id;
        $data['stock'] = DB::Select("SELECT products.products_id,products.product_name,sizes.size_name,shop_stocks.avl_quantity,p_atrr.multiple_attribute,shop_stocks.id FROM shop_stocks LEFT JOIN products ON (products.products_id=shop_stocks.products_id)LEFT JOIN product_attributes p_atrr ON(p_atrr.id=shop_stocks.attribute_id) LEFT JOIN sizes ON(sizes.id=p_atrr.product_size) WHERE (shop_stocks.shop_id=$shop_id AND p_atrr.barcode=$barcode) limit 1");
        // $data['stock'] = DB::table('shop_stocks')
        //                 ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
        //                 ->join('product_attributes', 'product_attributes.id', '=', 'shop_stocks.attribute_id')
        //                 ->join('sizes', 'sizes.id', '=', 'product_attributes.product_size')
        //                 ->select('shop_stocks.*','products.product_name','sizes.size_name')
        //                 ->where('product_attributes.barcode',$barcode)
        //                 ->where('shop_stocks.shop_id',$shop_id)
        //                 ->first();
        // dd($data['stock']);                 

        if(!$data['stock'])
        {
            $req->session()->flash('message', 'Product Not InStock!!!!');
        }
        // dd($data);
        return view('admin/webviews/admin_manage_stock',$data);
    }

    public function Productreturnsubmit(Request $req){
       $return_quantity = $req->return_quantity;
       $avl_quantity = $req->avl_quantity;



       if($return_quantity <= $avl_quantity){
        $avl_quantity = $avl_quantity - $return_quantity;
        // dd($avl_quantity);

              $data = new Return_Stock; 
              $data->products_id= $req->products_id;
              $data->return_quantity= $req->return_quantity;
              $data->shop_id= $req->shop_id;
              $data->save();


        shop_stock::where('id',$req->id)->update([
            'avl_quantity' => $avl_quantity           
        ]);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 15;
        $req->session()->flash('message_success', 'Quantity Return Successfully');
        return view('admin/webviews/admin_manage_stock', $data);
       }else{           
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 15;
        $req->session()->flash('message', 'Return Quantity Must Be Less Than Available Quantity');
     return view('admin/webviews/admin_manage_stock', $data);
     
  }
    }

    //new code rahul

    // public function ShopHome(Request $req)
    // {              
    //     //dd($req);
    //     $this->validate($req, [
    //         'login_id' => 'required',
    //         'login_pass'=> 'required'
    //     ]);
    //     $sh_id = $req->login_id;
    //     $password = $req->login_pass;

    //     if($sh_id == "1234567890" &&  $password == "12345")
    //     {
    //         return view('dashboard');
    //     }
    //     else
    //     {
    //         return back();
    //     }

    // }
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
        $shop_id = Auth::user()->shop_id;                
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
             $data1->user_type=2;
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
        $shop_id = Auth::user()->shop_id; 
       // $product = DB::table('products')->where('products_id',$p_id)->first();
        //$gst = DB::table('gst_tax')->where('gst_tax.gst_id',1)->get();
       // $product = DB::table( "SELECT * FROM products INNER JOIN gst_tax ON products.gst_id = gst_tax.gst_id WHERE products.products_id = $p_id");
    //    $product = DB::select("SELECT p_attr.price,p_attr.special_price,gst_tax.gst_value_percentage,products.product_name,sizes.size_name FROM shop_stocks LEFT JOIN products ON (products.products_id=shop_stocks.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=shop_stocks.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) WHERE(shop_stocks.shop_id=$shop_id AND p_attr.barcode=$p_id)");
       $product = DB::table('products')
            ->join('gst_tax', 'products.gst_id', '=', 'gst_tax.gst_id')            
            ->select('products.price','products.special_price','gst_tax.gst_value_percentage')
            ->where('products_id','=',$p_id )
            ->get(); 
    // dd($product);

           $producttest['data'] =  $product; 
       echo json_encode($producttest);
       exit; 
      
    }
    // ==============================================================
    public function submitcustorder(Request $req)
    {  
        // dd($req);
       //dd(count($req->product_name));
       // $lenght = count($req->product_name);
       //for($i=0;i<lenght;$i++)      
       
    //   $shop_id = $req->shop_id;
      $emp_id = Auth::user()->id;
      $shop_id = Auth::user()->shop_id; 
      $cust_id = $req->cust_id;
      $total_amt = $req->total;
      $order_id = uniqid();      
      $payment_mode = "shop";

      $data1 = new product_order; 
             $data1->emp_id= $emp_id;
             $data1->user_id= $cust_id;
             $data1->amount=$total_amt;                      
             $data1->order_id=$order_id;
             $data1->shop_id=$shop_id;
             $data1->payment_mode=$payment_mode; 
             $data1->save();
             $last_id=$data1->id;
             $orders = DB::table('orders')->where('id',$last_id)->first();
             $order_id = $orders->order_id; 
             $order_amount = $orders->amount;           

             //dd( $req->product_name);
            
             $i = 0;
             foreach($req->product_name as $row)
             {                             
              $data = new order_item; 
              $data->order_id= $order_id;
              $data->sub_order_id= $order_id;
              $data->prod_name=$req->product_name[$i]; 
              $data->prod_id=$req->product_id[$i];             
              $data->quantity=$req->p_qty[$i];
              $data->order_status=5;
              $data->sub_total=$req->p_price[$i];             
              $data->save();  

            $purchase_quantity = $req->p_qty[$i];
            $stock_info = shop_stock::where('attribute_id', $req->product_id[$i])->first();
            
            $avl_quantity1 = $stock_info->avl_quantity;
            $avl_quantity = $avl_quantity1 - $purchase_quantity;
            // dd($avl_quantity);
              shop_stock::where('attribute_id',$req->product_id[$i])->update([
                'avl_quantity' => $avl_quantity
            ]);
              $i++;
             }            
          
            $data['main_breadcrum'] = 'Order';
            $data['page_title'] = 'Customer Oder';
            $data['flag'] = 11;  
            // $data['product_order'] = DB::select("SELECT order_items.prod_id,order_items.prod_name,order_items.quantity,order_items.sub_total,product_attributes.price,gst_tax.gst_value_percentage,(product_attributes.price-order_items.sub_total)*order_items.quantity AS Discount FROM orders 
            // INNER JOIN order_items ON(order_items.order_id=orders.order_id)INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id)
            // INNER JOIN products ON(products.products_id=product_attributes.products_id)INNER JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)
            // INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.order_id=$order_id)");
            // $data['product_order'] = DB::select("WHERE (shop_stocks.shop_id=$shop_id AND order_items.order_id= $order_id)");
            $data['product_order'] = DB::table('order_items')
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('shop_stocks', 'shop_stocks.attribute_id', '=', 'order_items.prod_id')
            ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
            ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')
            ->join('product_attributes','product_attributes.id','=','order_items.prod_id')                       
            ->select('order_items.prod_name','product_attributes.price','order_items.sub_total','order_items.prod_id','order_items.quantity','gst_tax.gst_value_percentage','orders.amount','orders.order_id')
            ->where('orders.order_id','=', $order_id)
            ->where('shop_stocks.shop_id','=',$shop_id)
            ->get(); 
            $data['order_id'] = $order_id;
            //  dd($data['product_order']);      


            // add D-coin after placed order 
            $user_dcoin_info = DB::table('de_wallets')->where('user_id', $cust_id)->first();

            //  allready customer is present then do this 

            if($user_dcoin_info !== null ){
             $dcoin = $user_dcoin_info->coin;
             $total_dcoin = $dcoin + round(($total_amt / 5));
            // dd($total_dcoin);
            $affected = DeWallet::where('id',$user_dcoin_info->id)
              ->update(['coin' => $total_dcoin]);
            }else{
                //  new user do this 
                $total_dcoin = round(($total_amt / 5));
                $data2 = new DeWallet;              
             $data2->user_id= $cust_id;
             $data2->coin=$total_dcoin;
             $data2->save();
            }

        
            // send sms when order placed successfully
            $user_dcoin_info = DB::table('de_wallets')->where('user_id', $cust_id)->first();
             $user_info = User::where('id', $cust_id)->first();
            //  dd($user_info);
            if($user_info->phone != null) { 
                $msg=urlencode("Thank you for shopping with DrHelpDesk. 
            Order ID - ".$order_id."
            Total Amount - Rs ".$order_amount."
            Payment Mode - Cash 
            Dcoin Added In Your Account ".$user_dcoin_info->coin."
            To Redeem Dcoin Visit Our
            Website http://drhelpdesk.in Or Download App
            Enjoy Shopping With Us. ");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRDESK&sendto=".$user_info->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            } 

                
         return view('admin/webviews/admin_manage_stock',$data);    
    }
// ==============================================
public function add_shopEmployee()
{
    //echo "Hello";
    if(Auth::user()->role == 1)
    {
        $data['main_breadcrum'] = 'Shop';
        $data['page_title'] = 'Add Employee';
        $data['flag'] = 10; 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    else
    {
        return back();
    }    

}

public function show_shopEmployee()
{
    //echo "hello";
    if(Auth::user()->role == 1)
    {
        $data['main_breadcrum'] = 'Shop';
        $data['page_title'] = 'Employee';
        $data['flag'] = 9;
        $shop_id = Auth::user()->shop_id;   
        $data['shop_Employee'] = DB::table('users')->where('shop_id',$shop_id)->where('user_type',7)->orderBy('role','asc')->get(); 
        // dd($data['shop_Employee']);
        return view('admin/webviews/admin_manage_stock',$data);
    }
    else
    {
        return back();
    }
    
   
}

public function submit_shopEmp(Request $req)
{
    //dd($req);
    $this->validate($req,[
        'emp_name'=>'required',        
        'email'=>'nullable|email',
        'phone_no'=>'required|numeric',             
        'password'=>'required|max:8|Min:5'
     ]);
        
    //    $password = "123456";
    //   =========================================
    $result = DB::table('users')->where('phone', $req->phone_no)->first(); 

    if(!$result)
    {   
    // ======================================
    
       $shop_id = Auth::user()->shop_id;
       $user_type = 7; //(7- shop Employee)
       $role = 2;
     
        $data = new User;
            $data->name=$req->emp_name;
            $data->email=$req->email;
            $data->phone=$req->phone_no;
            $data->password= Hash::make($req->password);            
            $data->user_type=$user_type;
            $data->shop_id=$shop_id;
            $data->role= $role;
        $result = $data->save();
        if($result)
        {
            $req->session()->flash('alert-success', 'Employee was Successfully Added!');
        }
        else
        {
            $req->session()->flash('alert-danger', 'Employee Not Added!!!');
        } 
    }
    else
    {
        $req->session()->flash('alert-danger', 'Phone No Already Exists!!!');
    }         

     return back(); 
}

public function cust_order_list($order_id)
{
  
    $data['main_breadcrum'] = 'Order';
    $data['page_title'] = 'Customer Oder';
    $data['flag'] = 11; 
    $shop_id = Auth::user()->shop_id;
    $data['product_order'] = DB::table('order_items')
    ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
    ->join('shop_stocks', 'shop_stocks.attribute_id', '=', 'order_items.prod_id')
    ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
    ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')
    ->join('product_attributes','product_attributes.id','=','order_items.prod_id')                       
    ->select('order_items.prod_name','product_attributes.price','order_items.sub_total','order_items.prod_id','order_items.quantity','gst_tax.gst_value_percentage','orders.amount','orders.order_id')
    ->where('orders.order_id','=', $order_id)
    ->where('shop_stocks.shop_id','=',$shop_id)
    ->get(); 


    // $data['product_order'] = DB::table('orders')
    // ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
    // ->join('products', 'products.products_id', '=', 'order_items.prod_id')
    // ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
    // ->select('orders.*','order_items.*','products.product_name','products.price','gst_tax.*')
    // ->where('orders.order_id','=', $order_id )
    // ->get(); 

    $data['order_id'] = $order_id;
    //  dd($data['product_order']); 
    return view('admin/webviews/admin_manage_stock',$data);
}

// ========================================


// Print invoice
public function downloadInvoice($order_id){ 
    $orderDetails = DB::table('orders')->where('order_id', $order_id)->first();
    // $orders = DB::table('order_items')->where('order_id',$order_id)->get();
    $orderStatus = DB::table('order_status')->get();
    $shop_id = Auth::user()->shop_id;
    // $data['order'] = DB::table('order_items')    
    // ->join('products', 'products.products_id', '=', 'order_items.prod_id')
    // ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
    // ->select('order_items.*','products.product_name','products.price','gst_tax.gst_value_percentage')
    // ->where('order_items.order_id','=', $order_id )
    // ->get(); 
     $data['order'] = DB::table('order_items')
            ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('shop_stocks', 'shop_stocks.attribute_id', '=', 'order_items.prod_id')
            ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
            ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')
            ->join('product_attributes','product_attributes.id','=','order_items.prod_id')                       
            ->select('order_items.prod_name','product_attributes.price','order_items.sub_total','order_items.prod_id','order_items.quantity','gst_tax.gst_value_percentage','orders.amount','orders.order_id')
            ->where('orders.order_id','=', $order_id)
            ->where('shop_stocks.shop_id','=',$shop_id)
            ->get(); 
    //  dd($data['order']);
   $data['orderDetails'] = $orderDetails;
//    $data['order'] = $orders;
   $data['orderStatus'] = $orderStatus;
 
//    $data['gst_count']=DB::select("select gst_tax.gst_value_percentage,SUM(order_items.sub_total * order_items.quantity) AS total from shop_stocks INNER join gst_tax ON(gst_tax.gst_id = shop_stocks.tax) INNER JOIN order_items ON(shop_stocks.products_id=order_items.prod_id) INNER JOIN orders ON(orders.order_id=order_items.order_id) WHERE( shop_stocks.shop_id= $shop_id AND orders.order_id=$order_id) GROUP BY(gst_tax.gst_value_percentage)"); 
//    $data['gst_count']=DB::select("SELECT * FROM order_items LEFT JOIN product_attributes p_attr ON(p_attr.id=order_items.prod_id)LEFT JOIN products ON(products.products_id=p_attr.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)WHERE(order_items.order_id=60439d3c4fc06) GROUP BY(gst_tax.gst_id)"); 
   $data['gst_count'] = DB::table('order_items')
   ->join('orders', 'orders.order_id', '=', 'order_items.order_id')
            ->join('product_attributes', 'product_attributes.id', '=', 'order_items.prod_id')
            ->join('products', 'products.products_id', '=', 'product_attributes.products_id')
            ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')                                
            ->selectRaw('SUM(order_items.sub_total * order_items.quantity) AS total,order_items.prod_name , product_attributes.price,order_items.sub_total,order_items.prod_id,order_items.quantity,gst_tax.gst_value_percentage,orders.amount,orders.order_id')
            ->where('order_items.order_id','=', $order_id)
            ->groupBy('gst_tax.gst_id')
            ->get(); 

//    dd($data['gst_count']);
   return view('admin/common/downloadinvoice', $data);
   
//    $pdf = PDF::loadView('admin/common/downloadinvoice', $data);
//    return $pdf->download('invoice.pdf');
}


    // public function pdf_view()
    //  {  
    //     $pdf = PDF::loadView('invoice');
    //     return $pdf->download('invoice.pdf');

    // }
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
        $shop_id = Auth::user()->shop_id;  
        $seven_random_number = mt_rand(1000000, 9999999); 
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
        $emp_id = Auth::user()->id;
        $shop_id = Auth::user()->shop_id;
        // echo $shop_id;
        $data['main_breadcrum'] = 'Shop';
        $data['page_title'] = 'Shop Order List';
        $data['flag'] = 13; 
        $data['shop_orders'] = DB::table('users')
        ->join('orders', 'users.id', '=','orders.emp_id')
        ->select('orders.*','users.phone','users.name')
        ->where('users.shop_id','=', $shop_id)
        ->orderBy('orders.created_at', 'DESC')
        ->get(); 
        // dd( $data['shop_orders']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    // ====================================================

    public function user_profile()
    {
        $data['main_breadcrum'] = 'Profile';
        $data['page_title'] = 'My Profile';
        $data['flag'] = 1;
        $user_id = Auth::user()->id;        
        $data['user'] = DB::table('users')->where('id',$user_id)->first(); 
        // dd( $data['user']); 
        return view('admin/webviews/user_manage',$data);

    }

    public function update_profile(Request $req)
    {
        // dd($req);
        $this->validate($req,[
            'emp_name'=>'required|alpha',        
            'email'=>'nullable|email',
            'phone_no'=>'required|numeric' 
         ]);
         $user_id = Auth::user()->id;         
         $update = DB::table('users')->where('id', $user_id) ->update([ 'name' => $req->emp_name, 'email' => $req->email, 'phone' => $req->phone_no]); 
         if($update)
         {

            $req->session()->flash('alert-success', 'Profile Updated Successfully!!');             
        }
        else
        {
          $req->session()->flash('alert-danger', 'Profile Not Updated!!'); 

         }
         return back();
    }

    public function change_password()
    {
        // echo "hello";
        $data['main_breadcrum'] = 'Profile';
        $data['page_title'] = 'Change Password';
        $data['flag'] = 2;        
        return view('admin/webviews/user_manage',$data);
    }
    public function submit_Password(Request $req)
    {
        // dd($req);
        $this->validate($req,[
            'old_pass'=>'required',        
            'new_pass'=>'required',
            'confirm_pass'=>'required' 
         ]);
         if($req->new_pass == $req->confirm_pass)
         {  
            if(Hash::check($req->old_pass, Auth::user()->password))
            { 
                $user_id = Auth::user()->id;         
                $update = DB::table('users')->where('id', $user_id)->update(['password'=> Hash::make($req->new_pass)]); 
                if($update)
                {
                    $req->session()->flash('alert-success', 'Profile Updated Successfully!!');             
                }
                else
                {
                    $req->session()->flash('alert-danger', 'Profile Not Updated!!');
                }
            }
            else
            {
                $req->session()->flash('alert-danger', 'Old Password Not Match!!');
            }   
        }
        else
        {
            $req->session()->flash('alert-danger', 'New Password And Confirm Password Must be Same!!');
        }    
         return back();
    }
    

    // =====================================================
                    // 10/2/21
    // public function BarCode_Order()
    // {
    //     $data['main_breadcrum'] = 'BarCode';
    //     $data['page_title'] = 'Create BarCode';
    //     $data['flag'] = 14;
    //     $data['u_id'] = 120;
    //     $shop_id = Auth::user()->shop_id; 
    //     $data['product'] = DB::table('shop_stocks')
    //     ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')            
    //     ->select('products.*','shop_stocks.*')
    //     ->where('shop_stocks.shop_id','=',$shop_id)
    //     ->get(); 
    //     //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    //     return view('admin/webviews/admin_manage_stock',$data);

    // }  
    
    public function br_product_detail()
    {
        $p_id  = $_POST['product'];
        $shop_id = Auth::user()->shop_id;
        // dd($p_id);
        // echo $p_id ; 
        // echo "<br>";
        // $product=DB::select("SELECT product_attributes.id,product_attributes.price,product_attributes.special_price,products.product_name,sizes.size_name,gst_tax.gst_value_percentage FROM `shop_stocks` INNER JOIN products ON (products.products_id=shop_stocks.products_id) INNER JOIN gst_tax ON (gst_tax.gst_id=products.gst_id)INNER JOIN product_attributes ON (product_attributes.id=shop_stocks.attribute_id)INNER JOIN sizes ON (sizes.id=product_attributes.product_size) WHERE (product_attributes.barcode=$p_id)");       
        $product = DB::select("SELECT p_attr.id,p_attr.price,p_attr.special_price,gst_tax.gst_value_percentage,products.product_name,sizes.size_name FROM shop_stocks LEFT JOIN products ON (products.products_id=shop_stocks.products_id)LEFT JOIN gst_tax ON(gst_tax.gst_id=products.gst_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=shop_stocks.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) WHERE(shop_stocks.shop_id=$shop_id AND p_attr.barcode=$p_id)");
        // $product = DB::table('shop_stocks')       
        // ->join('products', 'shop_stocks.products_id', '=', 'products.products_id') 
        // ->join('product_attributes','product_attributes.id', '=', 'shop_stocks.attribute_id') 
        // ->join('gst_tax','gst_tax.gst_id', '=', 'products.tax')
        // ->join('sizes','sizes.id', '=', 'product_attributes.product_size')            
        // ->select('product_attributes.price','products.product_name','product_attributes.special_price','shop_stocks.*','gst_tax.gst_value_percentage')
        // ->where('product_attributes.barcode','=',$p_id )
        // ->get(); 
        // dd($product);
       $producttest['data'] =  $product; 
   echo json_encode($producttest);
   exit; 

    }
// ======================avaliable_quantity================================
    public function avaliable_quantity()
    {
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Available Quantity';
        // $data['flag'] = 14;   
        $data['flag'] = 1;     
        $shop_id = Auth::user()->shop_id;         
        // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity asc");
        // $data['product']=DB::select("SELECT shop_stocks.products_id,products.product_name, SUM(shop_stocks.avl_quantity) as avl_quantity FROM `shop_stocks` INNER JOIN products ON(products.products_id=shop_stocks.products_id) where (shop_stocks.shop_id =$shop_id) GROUP BY (shop_stocks.attribute_id) ORDER BY avl_quantity ASC");       
        $data['product']=DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name, SUM(s_stock.avl_quantity) as avl_quantity FROM shop_stocks s_stock INNER JOIN products ON(products.products_id=s_stock.products_id)INNER JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC");       
        // $data['product']=DB::select("select * from shop_stocks where  shop_id=$shop_id;"); 
        // dd($data['product'] );
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        // return view('admin/webviews/admin_manage_stock',$data);
        return view('admin/webviews/store_all_report',$data);

    }
// ========================End avaliable_quantity=================
// =====================check_expiry===================
// select Drop Downlist option in show Product Expiry date
    // public function check_expiry(Request $req)
    // {
    //     // dd($req->Exp_date);
    //     $data['main_breadcrum'] = 'Stock';
    //     $data['page_title'] = 'Available Quantity';
    //     $data['flag'] = 14;       
    //     $shop_id = Auth::user()->shop_id;  
    //     $expiry_day = $req->Exp_date;
    //     // $currentDate = date('Y-m-d'); 
    //     // echo  $currentDate;die();      
    //     // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity DESC");       
    //     // $data['product']=DB::select("SELECT * FROM `shop_stocks` WHERE (DATEDIFF(`expiry_date`,  $currentDate) <= 15) && (`shop_id` = 13)"); 
    //     $data['product']=DB::select("select * from shop_stocks where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id;"); 

    //     //  dd($data['product']);
    //     //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    //     return view('admin/webviews/admin_manage_stock',$data);
    // }
    public function daily_update()
    {        
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Daily Update';
        $data['flag'] = 3;       
        $shop_id = Auth::user()->shop_id;
        // echo $shop_id;
        $data['daily_report']=DB::select("SELECT date(created_at) AS Date ,SUM(amount) as tatal_amount FROM orders where (shop_id =$shop_id) GROUP BY (date(created_at)) order by created_at desc");        
        // dd($data['daily_report'] );       
        return view('admin/webviews/store_all_report',$data);

    }
    public function daily_sell_update($date)
    {
        echo $date; die();
    }
// ==================product_exp_report========================
    public function product_exp_report()
    {
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Product Expiry';
        $data['flag'] = 2;       
        $shop_id = Auth::user()->shop_id;      
        // $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,expiry_date from shop_stocks where shop_id=$shop_id ORDER BY `expiry_date` ASC");               
        // $data['store_product']=DB::select("select products.product_name,timestampdiff(day,now(),shop_stocks.`expiry_date`) AS expiry_day,shop_stocks.`avl_quantity`,shop_stocks.`products_id`,expiry_date from shop_stocks INNER JOIN products ON(products.products_id=shop_stocks.products_id) where shop_stocks.shop_id=$shop_id ORDER BY shop_stocks.`expiry_date` ASC");               
        $data['store_product']=DB::select("select products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date from shop_stocks s_stock INNER JOIN products ON(products.products_id=s_stock.products_id)INNER JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id=$shop_id) ORDER BY (s_stock.`expiry_date`) ASC");               
       
        // dd($data['store_product']);
        return view('admin/webviews/store_all_report',$data);
    }
    public function check_expiry2(Request $req)
    {
        // dd($req->Exp_date);
        $data['main_breadcrum'] = 'store';
        $data['page_title'] = 'Available Quantity';
        $data['flag'] = 2;       
        $shop_id = Auth::user()->shop_id;  
        $expiry_day = $req->Exp_date;
        // $currentDate = date('Y-m-d'); 
        // echo  $currentDate;die();      
        // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity DESC");       
        // $data['product']=DB::select("SELECT * FROM `shop_stocks` WHERE (DATEDIFF(`expiry_date`,  $currentDate) <= 15) && (`shop_id` = 13)"); 
        // $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,`expiry_date` from shop_stocks where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id"); 
        // $data['store_product']=DB::select("select timestampdiff(day,now(),shop_stocks.`expiry_date`) AS expiry_day,shop_stocks.`avl_quantity`,shop_stocks.`products_id`,shop_stocks.`expiry_date`,products.product_name from shop_stocks INNER JOIN products ON(products.products_id=shop_stocks.products_id) where shop_stocks.expiry_date < now() + INTERVAL $expiry_day day AND shop_stocks.shop_id=$shop_id"); 
        $data['store_product']=DB::select("select timestampdiff(day,now(),shop_stocks.`expiry_date`) AS expiry_day,shop_stocks.`avl_quantity`,shop_stocks.`products_id`,shop_stocks.`expiry_date`,products.product_name,sizes.size_name from shop_stocks INNER JOIN products ON(products.products_id=shop_stocks.products_id) INNER JOIN product_attributes p_attr ON(p_attr.id=shop_stocks.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where shop_stocks.expiry_date < now() + INTERVAL 60 day AND shop_stocks.shop_id=$shop_id"); 
        //  dd($data['store_product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }
    // ======================End product_exp_report======================
    // ======================top_sell_product============================
    public function top_sell_product()
    {
        // echo "Hello";die();        
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Top Selling Product';
        $data['flag'] = 4;       
        $shop_id = Auth::user()->shop_id;           
         
        // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,products.product_name FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) as product_name FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id) INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id)INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        
        //  dd($data['top_selling']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }

    public function top_selling(Request $req)
    {
        // dd($req->within_date);
        $data['main_breadcrum'] = 'store';
        $data['page_title'] = 'Top Selling Product';
        $data['flag'] = 4;       
        $shop_id = Auth::user()->shop_id;           
         
        // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) WHERE (order_items.created_at > now() - INTERVAL $req->within_date day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,products.product_name FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id) WHERE (order_items.created_at > now() - INTERVAL $req->within_date day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) AS product_name FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id)INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id)INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL $req->within_date day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 

        //  dd($data['product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }
    // ===================End top_sell_product===============================
    // =====================return_stock_report============================
    public function return_stock_report()
    {
        // echo "Hello";die();        
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 5;       
        $shop_id = Auth::user()->shop_id;           
         
        // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
        $data['return_stock']=DB::select("SELECT products.product_name,products.products_id,return_stock.return_quantity FROM return_stock INNER JOIN products ON(products.products_id=return_stock.products_id) WHERE (return_stock.shop_id=$shop_id)"); 

    //   dd($data['return_stock']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }
    public function search_return_qty(Request $req)
    {
        // dd($req->within_date);
        $data['main_breadcrum'] = 'store';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 5;       
        $shop_id = Auth::user()->shop_id;      
         
        $data['return_stock']=DB::select("SELECT products.product_name,products.products_id,return_stock.return_quantity FROM return_stock INNER JOIN products  ON(products.products_id=return_stock.products_id) WHERE (return_stock.created_at > now() - INTERVAL $req->within_date day AND return_stock.shop_id=$shop_id)"); 

        //  dd($data['return_stock']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return Excel::download(new UsersExport, 'users.xlsx');
        return view('admin/webviews/store_all_report',$data);
    }
     public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


}
