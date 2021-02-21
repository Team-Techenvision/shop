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
use App;
use Auth;
use PDF;
use redirect;
use Session;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        $Count_stock1 = DB::select("SELECT DISTINCT `products_id` as count_product FROM `shop_stocks` WHERE shop_id=$shop_id"); 
        $expiry_stock1 = DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,`expiry_date` from shop_stocks where expiry_date < now() + INTERVAL 30 day AND shop_id=$shop_id"); 
        
        $data['Count_Customer'] = count( $Count_Customer1);
        // dd($data['Count_Customer']);
        $data['Count_stock'] = count($Count_stock1);
        // dd($data['Count_stock1']);
        $data['expiry_stock'] = count($expiry_stock1);
        // dd($data['expiry_stock']); 
                   
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
            $data['product'] = DB::table('shop_stocks')
            ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')            
            ->select('products.*','shop_stocks.*')
            ->where('shop_stocks.shop_id','=',$shop_id)
            ->get(); 
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
        // dd($req);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Return Stock';
        $data['flag'] = 15;
        $barcode = $req->barcode;
        $data['stock'] = DB::table('shop_stocks')
                        ->join('products', 'products.products_id', '=', 'shop_stocks.products_id')
                        ->select('shop_stocks.*','products.product_name' )
                        ->where('barcode',$barcode)->first(); 
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
            $stock_info = shop_stock::where('products_id', $req->product_id[$i])->first();
            
            $avl_quantity1 = $stock_info->avl_quantity;
            $avl_quantity = $avl_quantity1 - $purchase_quantity;
            // dd($avl_quantity);
              shop_stock::where('products_id',$req->product_id[$i])->update([
                'avl_quantity' => $avl_quantity
            ]);
              $i++;
             }            
          
            $data['main_breadcrum'] = 'Order';
            $data['page_title'] = 'Customer Oder';
            $data['flag'] = 11;            
            $data['product_order'] = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
            ->join('products', 'products.products_id', '=', 'order_items.prod_id')
            ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
            ->select('orders.*','order_items.*','products.product_name','products.price','gst_tax.*')
            ->where('orders.order_id','=', $order_id )
            ->get(); 
            $data['order_id'] = $order_id;
            //dd($data['product']);      
            
            // send sms when order placed successfully

             $user_info = User::where('id', $cust_id)->first();
            //  dd($user_info);
            if($user_info->phone != null) { 
                $msg=urlencode("Thank you for shopping with DrHelpDesk.
                Order ID - ".$order_id."
                Total Amount - Rs ".$order_amount."
                Payment Mode - Cash 
                Enjoy Shopping on Drhelpdesk. 
                Stay Home !!! Stay Safe !!!");
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
    $data['product_order'] = DB::table('orders')
    ->join('order_items', 'order_items.order_id', '=', 'orders.order_id')
    ->join('products', 'products.products_id', '=', 'order_items.prod_id')
    ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
    ->select('orders.*','order_items.*','products.product_name','products.price','gst_tax.*')
    ->where('orders.order_id','=', $order_id )
    ->get(); 
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
    $data['order'] = DB::table('order_items')    
    ->join('products', 'products.products_id', '=', 'order_items.prod_id')
    ->join('gst_tax', 'gst_tax.gst_id', '=', 'products.gst_id')             
    ->select('order_items.*','products.product_name','products.price','gst_tax.gst_value_percentage')
    ->where('order_items.order_id','=', $order_id )
    ->get(); 
    //  dd($orderDetails);
   $data['orderDetails'] = $orderDetails;
//    $data['order'] = $orders;
   $data['orderStatus'] = $orderStatus;
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
        // echo $p_id ;
        $product = DB::table('shop_stocks')       
        ->join('products', 'shop_stocks.products_id', '=', 'products.products_id') 
        ->join('gst_tax','gst_tax.gst_id', '=', 'shop_stocks.tax')          
        ->select('products.price','products.product_name','products.special_price','shop_stocks.*','gst_tax.gst_value_percentage')
        ->where('shop_stocks.barcode','=',$p_id )
        ->get(); 

       $producttest['data'] =  $product; 
   echo json_encode($producttest);
   exit; 

    }

    public function avaliable_quantity()
    {
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Available Quantity';
        $data['flag'] = 14;       
        $shop_id = Auth::user()->shop_id;         
        $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity asc");       
        // $data['product']=DB::select("SELECT products.product_name,SUM(shop_stocks.avl_quantity) as total FROM shop_stocks INNER JOIN products ON(products.products_id = shop_stocks.products_id) GROUP BY (shop_stocks.products_id)");       
        // $data['product']=DB::select("select * from shop_stocks where  shop_id=$shop_id;"); 
        // dd($data['product'] );
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);

    }
// ======================================================
// select Drop Downlist option in show Product Expiry date
    public function check_expiry(Request $req)
    {
        // dd($req->Exp_date);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Available Quantity';
        $data['flag'] = 14;       
        $shop_id = Auth::user()->shop_id;  
        $expiry_day = $req->Exp_date;
        // $currentDate = date('Y-m-d'); 
        // echo  $currentDate;die();      
        // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity DESC");       
        // $data['product']=DB::select("SELECT * FROM `shop_stocks` WHERE (DATEDIFF(`expiry_date`,  $currentDate) <= 15) && (`shop_id` = 13)"); 
        $data['product']=DB::select("select * from shop_stocks where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id;"); 

        //  dd($data['product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    public function daily_update()
    {        
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Daily Update';
        $data['flag'] = 3;       
        $shop_id = Auth::user()->shop_id;
        // echo $shop_id;
        $data['daily_report']=DB::select("SELECT date(created_at) AS Date ,SUM(amount) as tatal_amount FROM orders where (shop_id =$shop_id) GROUP BY (date(created_at))");
        // dd($data['daily_report'] );       
        return view('admin/webviews/store_all_report',$data);

    }
    public function daily_sell_update($date)
    {
        echo $date; die();
    }

    public function product_exp_report()
    {
        $data['main_breadcrum'] = 'Store';
        $data['page_title'] = 'Product Expiry';
        $data['flag'] = 2;       
        $shop_id = Auth::user()->shop_id;      
        $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,expiry_date from shop_stocks where shop_id=$shop_id ORDER BY `expiry_date` ASC");               
        return view('admin/webviews/store_all_report',$data);
    }
    public function check_expiry2(Request $req)
    {
        // dd($req->Exp_date);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Available Quantity';
        $data['flag'] = 2;       
        $shop_id = Auth::user()->shop_id;  
        $expiry_day = $req->Exp_date;
        // $currentDate = date('Y-m-d'); 
        // echo  $currentDate;die();      
        // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity DESC");       
        // $data['product']=DB::select("SELECT * FROM `shop_stocks` WHERE (DATEDIFF(`expiry_date`,  $currentDate) <= 15) && (`shop_id` = 13)"); 
        $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,`expiry_date` from shop_stocks where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id"); 

        //  dd($data['product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }
    public function top_sell_product()
    {
        // echo "Hello";die();        
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Top Selling Product';
        $data['flag'] = 4;       
        $shop_id = Auth::user()->shop_id;           
         
        $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 

        //  dd($data['product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }

    public function top_selling(Request $req)
    {
        // dd($req->within_date);
        $data['main_breadcrum'] = 'Stock';
        $data['page_title'] = 'Top Selling Product';
        $data['flag'] = 4;       
        $shop_id = Auth::user()->shop_id;           
         
        $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) WHERE (order_items.created_at > now() - INTERVAL $req->within_date day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 

        //  dd($data['product']);
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/store_all_report',$data);
    }


}
