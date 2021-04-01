<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Mail;
// use Excel;
use Illuminate\Http\Request;
// use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    //   
   

    // ======================avaliable_quantity Reports================================
public function avaliable_quantity()
{
    $data['main_breadcrum'] = 'Stock';
    $data['page_title'] = 'Available Quantity';
    // $data['flag'] = 14;   
    $data['flag'] = 1;     
    $shop_id = Auth::user()->shop_id;         
    // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity asc");
    // $data['product']=DB::select("SELECT shop_stocks.products_id,products.product_name, SUM(shop_stocks.avl_quantity) as avl_quantity FROM `shop_stocks` INNER JOIN products ON(products.products_id=shop_stocks.products_id) where (shop_stocks.shop_id =$shop_id) GROUP BY (shop_stocks.attribute_id) ORDER BY avl_quantity ASC");       
    // $data['product']=DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name, SUM(s_stock.avl_quantity) as avl_quantity FROM shop_stocks s_stock INNER JOIN products ON(products.products_id=s_stock.products_id)INNER JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC");       
    // =========================
    // $data['product']=DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name, SUM(s_stock.avl_quantity) as avl_quantity,p_attr.per_stript_qty FROM shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC");       

    $data['product'] = DB::table('shop_stocks as s_stock')
    ->select(DB::raw('s_stock.products_id,products.product_name,sizes.size_name,SUM(s_stock.avl_quantity) as avl_quantity,p_attr.per_stript_qty'))
    ->join('products','products.products_id','=','s_stock.products_id')
    ->join('product_attributes as p_attr','p_attr.id','=','s_stock.attribute_id')
    ->join('sizes','sizes.id','=','p_attr.product_size')
    ->where('s_stock.shop_id',$shop_id)
    ->orderBy('s_stock.avl_quantity', 'ASC')
    ->groupBy('s_stock.attribute_id')
    ->get();
    // $record = $product->groupBy('s_stock.attribute_id');
    // dd($record);
    // $data['product']=DB::select("select * from shop_stocks where  shop_id=$shop_id;"); 
    // dd($data['product']);
    //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    // return view('admin/webviews/admin_manage_stock',$data);
    return view('admin/webviews/store_all_report',$data);

}

// ======================avaliable_quantity================================

// ==================product_exp_report========================
public function product_exp_report()
{
    $data['main_breadcrum'] = 'Store';
    $data['page_title'] = 'Product Expiry';
    $data['flag'] = 2;       
    $shop_id = Auth::user()->shop_id;      
    // $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,expiry_date from shop_stocks where shop_id=$shop_id ORDER BY `expiry_date` ASC");               
    // $data['store_product']=DB::select("select products.product_name,timestampdiff(day,now(),shop_stocks.`expiry_date`) AS expiry_day,shop_stocks.`avl_quantity`,shop_stocks.`products_id`,expiry_date from shop_stocks INNER JOIN products ON(products.products_id=shop_stocks.products_id) where shop_stocks.shop_id=$shop_id ORDER BY shop_stocks.`expiry_date` ASC");               
    // $data['store_product']=DB::select("select products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date from shop_stocks s_stock INNER JOIN products ON(products.products_id=s_stock.products_id)INNER JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)INNER JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id=$shop_id) ORDER BY (s_stock.`expiry_date`) ASC");               
    // ==========================================
    // $data['store_product']=DB::select("select products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date,p_attr.per_stript_qty from shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id=$shop_id) ORDER BY (s_stock.`expiry_date`) ASC");               


    $data['store_product'] = DB::table('shop_stocks as s_stock')
    ->select(DB::raw('products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date,p_attr.per_stript_qty'))
    ->join('products','products.products_id','=','s_stock.products_id')
    ->join('product_attributes as p_attr','p_attr.id','=','s_stock.attribute_id')
    ->join('sizes','sizes.id','=','p_attr.product_size')
    ->where('s_stock.shop_id',$shop_id)
    ->orderBy('s_stock.expiry_date', 'ASC')   
    ->get();



    $data['record_Date']="0";
    // dd($data['store_product']);
    return view('admin/webviews/store_all_report',$data);
}

public function check_expiry2(Request $req)
{
    // dd($req->Exp_date);
    $data['main_breadcrum'] = 'store';
    $data['page_title'] = 'Product Expiry';
    $data['flag'] = 2;       
    $shop_id = Auth::user()->shop_id;  
    $expiry_day = $req->Exp_date;
    // $currentDate = date('Y-m-d'); 
    // echo  $currentDate;die();      
    // $data['product']=DB::select("SELECT products_id,SUM(avl_quantity) as avl_quantity FROM `shop_stocks` where (shop_id =$shop_id)  GROUP BY (products_id) ORDER BY avl_quantity DESC");       
    // $data['product']=DB::select("SELECT * FROM `shop_stocks` WHERE (DATEDIFF(`expiry_date`,  $currentDate) <= 15) && (`shop_id` = 13)"); 
    // $data['store_product']=DB::select("select timestampdiff(day,now(),`expiry_date`) AS expiry_day,`avl_quantity`,`products_id`,`expiry_date` from shop_stocks where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id"); 
    // $data['store_product']=DB::select("select timestampdiff(day,now(),shop_stocks.`expiry_date`) AS expiry_day,shop_stocks.`avl_quantity`,shop_stocks.`products_id`,shop_stocks.`expiry_date`,products.product_name from shop_stocks INNER JOIN products ON(products.products_id=shop_stocks.products_id) where shop_stocks.expiry_date < now() + INTERVAL $expiry_day day AND shop_stocks.shop_id=$shop_id"); 
    
    $data['store_product']=DB::select("select timestampdiff(day,now(),shop_stocks.expiry_date) AS expiry_day,shop_stocks.avl_quantity,shop_stocks.products_id,shop_stocks.expiry_date,products.product_name,sizes.size_name,p_attr.per_stript_qty from shop_stocks LEFT JOIN product_attributes p_attr ON(p_attr.id=shop_stocks.attribute_id)LEFT JOIN products ON(products.products_id=shop_stocks.products_id)LEFT join sizes ON(sizes.id=p_attr.product_size) where expiry_date < now() + INTERVAL $expiry_day day AND shop_id=$shop_id");               
    

    //  dd($data['store_product']);

    $data['product'] = DB::table('shop_stocks as s_stock')
    ->select(DB::raw('s_stock.products_id,products.product_name,sizes.size_name,SUM(s_stock.avl_quantity) as avl_quantity,p_attr.per_stript_qty'))
    ->join('products','products.products_id','=','s_stock.products_id')
    ->join('product_attributes as p_attr','p_attr.id','=','s_stock.attribute_id')
    ->join('sizes','sizes.id','=','p_attr.product_size')
    ->where('s_stock.shop_id',$shop_id)
    ->orderBy('s_stock.avl_quantity', 'ASC')
    ->groupBy('s_stock.attribute_id')
    ->get();
    $data['record_Date']=$expiry_day;
    //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    return view('admin/webviews/store_all_report',$data);
}

// ======================End product_exp_report======================

// ====================== daily Sell update======================

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
// send email for daily sell update
public function daily_sell_update($date, $amount)
{
    // echo $date; echo $amount; die();
    $shop_id = Auth::user()->shop_id;
    $shop_name = DB::table('shop_infos')->where('id',$shop_id)->first('shop_name');
    // dd($shop_name->shop_name);
    $to = 'contactprashantpp@gmail.com';
    $subject = 'Daily Sell Report';
    $message = "Your $date Daily Sell Amount is $amount From Store $shop_name->shop_name.";
    $headers = 'From:support@drhelpdesk.in';
   
    Mail::send('emails.daily_report', ['msg' => $message, 'user' => "demo"] , function($message) use ($to){
    $message->to($to, 'User')->subject('Daily Sell Report');
    $message->from('support@drhelpdesk.in','Drhelpdesk');
});
return redirect('daily-update')->with('message','Mail Sent Successfully!');

}

// ======================End daily Sell update======================

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
    // $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) as product_name FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id) INNER JOIN products ON (products.products_id = order_items.prod_id) INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id)INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) AS product_name,product_attributes.per_stript_qty FROM order_items LEFT JOIN orders ON (orders.order_id=order_items.order_id)LEFT JOIN product_attributes ON(product_attributes.id=order_items.prod_id) LEFT JOIN products ON (products.products_id = product_attributes.products_id) LEFT JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    $data['record_Date']="0";
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
    $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) AS product_name,product_attributes.per_stript_qty  FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id)INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id) INNER JOIN products ON (products.products_id =product_attributes.products_id)INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL $req->within_date day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    $data['record_Date']= $req->within_date;
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
    // $data['return_stock']=DB::select("SELECT products.product_name,products.products_id,return_stock.return_quantity FROM return_stock INNER JOIN products ON(products.products_id=return_stock.products_id) WHERE (return_stock.shop_id=$shop_id)"); 
    $data['return_stock']=DB::select("SELECT products.product_name,sizes.size_name,return_stock.return_quantity,p_attr.per_stript_qty FROM return_stock INNER JOIN product_attributes p_attr ON(p_attr.id=return_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)INNER JOIN products ON(products.products_id=p_attr.products_id) WHERE (return_stock.shop_id=$shop_id)"); 
    
    $data['record_Date']="0";
    // dd($this->report_data);
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

    $data['return_stock']=DB::select("SELECT products.product_name,sizes.size_name,return_stock.return_quantity,p_attr.per_stript_qty FROM return_stock INNER JOIN product_attributes p_attr ON(p_attr.id=return_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)INNER JOIN products ON(products.products_id=p_attr.products_id) WHERE (return_stock.created_at > now() - INTERVAL $req->within_date day AND return_stock.shop_id=$shop_id)"); 
    $data['record_Date']= $req->within_date;
    //  dd($data['return_stock']);
    // $stock = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    // dd($stock);
    // return Excel::download($stock , 'users.xlsx');
    //  $this->export($data['flag']);
    return view('admin/webviews/store_all_report',$data);
}
// =====================End return_stock_report============================

// public function excel_sheet()
// {
//     $return_stock = DB::table('return_stock')->where('shop_id',104)->get()->toArray();

//     $return_stockarray[] = array('Product Id','Return Qty','Shop Id');

//     foreach($return_stock as $row)
//     {
//         $return_stockarray[] = array('Product Id' => $row->products_id,'Return Qty'=>$row->return_quantity,'Shop Id'=> $row->shop_id);
//     }

//     Excel::create('Return_Stock', function($excel) use ($return_stockarray){
//         $excel->setTitle('Return_Stock');
//         $excel->sheet('Return_Stock', function($sheet) use($return_stockarray){
//             $sheet->formarray($return_stockarray,null,'A1',false,false);
//         });
//     })->download('xlsx');
// }
// ===========================Generate Excel Sheet (Reports)====================================

public function excel_sheet($get_record)
{
    // dd($get_record);
    $shop_id = Auth::user()->shop_id; 
    if($get_record == 0)
    {
        $return_stock=DB::select("SELECT products.product_name,sizes.size_name,return_stock.return_quantity,return_stock.created_at,p_attr.per_stript_qty FROM return_stock INNER JOIN product_attributes p_attr ON(p_attr.id=return_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)INNER JOIN products ON(products.products_id=p_attr.products_id) WHERE (return_stock.shop_id=$shop_id)"); 
    }else
    {
        $return_stock=DB::select("SELECT products.product_name,sizes.size_name,return_stock.return_quantity,return_stock.created_at,p_attr.per_stript_qty FROM return_stock INNER JOIN product_attributes p_attr ON(p_attr.id=return_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size)INNER JOIN products ON(products.products_id=p_attr.products_id) WHERE (return_stock.created_at > now() - INTERVAL $get_record day AND return_stock.shop_id=$shop_id)"); 
    }    
    //   dd($return_stock);
   
    $output = '';
    if($return_stock)
    {
     $output .= '
      <table class="table" bordered="1">  
                       <tr>  
                            <th>Product Name</th>  
                            <th>Return Quantity</th>
                            <th>Unit</th>   
                            <th>Date</th>  
         
                       </tr>
     ';
    //  while($row = mysqli_fetch_array($return_stock))
     foreach($return_stock as $row)
     { 
        if($row->size_name!="Main")
         {
            $product_name = "$row->product_name ($row->size_name)";
            $unit = round($row->return_quantity / $row->per_stript_qty,3);
         }else{
            $product_name = "$row->product_name";
            $unit = round($row->return_quantity / $row->per_stript_qty,3);
         }
      $output .= '
       <tr>  
                            <td>'.$product_name .'</td>  
                            <td>'.$row->return_quantity .'</td> 
                            <td>'.$unit .'</td>  
                            <td>'.$row->created_at .'</td>  
          
                       </tr>
      ';
     }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Return_stock.xls');
        echo $output;
    }  
}

public function export_top_selling($get_record)
{
    // dd($get_record);
    $shop_id = Auth::user()->shop_id; 
    if($get_record == 0)
    {
        $top_selling=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) AS product_name,product_attributes.per_stript_qty FROM order_items LEFT JOIN orders ON (orders.order_id=order_items.order_id)LEFT JOIN product_attributes ON(product_attributes.id=order_items.prod_id) LEFT JOIN products ON (products.products_id = product_attributes.products_id) LEFT JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    }else
    {
        $top_selling=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,CONCAT(products.product_name ,' ',sizes.size_name) AS product_name,product_attributes.per_stript_qty  FROM order_items INNER JOIN orders ON (orders.order_id=order_items.order_id)INNER JOIN product_attributes ON(product_attributes.id=order_items.prod_id) INNER JOIN products ON (products.products_id =product_attributes.products_id)INNER JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL $get_record day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    }
    // $return_stock = DB::table('return_stock')->where('shop_id',104)->get()->toArray();
    //   dd($top_selling);
    //   dd($this->report_data);
    $output = '';
    if($top_selling)
    {
     $output .= '
      <table class="table" bordered="1">  
                       <tr>  
                            <th>Product Name</th>  
                            <th>Seeling Quantity</th>
                            <th>Unit</th>   
                         
                       </tr>
     ';
    //  while($row = mysqli_fetch_array($return_stock))
     foreach($top_selling as $row)
     { 
        if(!$row->per_stript_qty)
        {
            $per_strip = 1;
        }
        else{
           $per_strip = $row->per_stript_qty;
        }
        
           $unit = round($row->MAXsell / $per_strip,3);
        
      $output .= '
       <tr>  
                            <td>'.$row->product_name .'</td>  
                            <td>'.$row->MAXsell .'</td> 
                            <td>'.$unit .'</td>                       
          
                       </tr>
      ';
     }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Top_Selling.xls');
        echo $output;
    }  
}

public function Expiry_excel($get_record)
{
    // dd($get_record);
    $shop_id = Auth::user()->shop_id; 
    if($get_record == 0)
    {
        $return_stock=DB::select("select products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date,p_attr.per_stript_qty from shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id=$shop_id) ORDER BY (s_stock.`expiry_date`) ASC"); 
    }else
    {
        $return_stock=DB::select("select timestampdiff(day,now(),shop_stocks.expiry_date) AS expiry_day,shop_stocks.avl_quantity,shop_stocks.products_id,shop_stocks.expiry_date,products.product_name,sizes.size_name,p_attr.per_stript_qty from shop_stocks LEFT JOIN product_attributes p_attr ON(p_attr.id=shop_stocks.attribute_id)LEFT JOIN products ON(products.products_id=shop_stocks.products_id)LEFT join sizes ON(sizes.id=p_attr.product_size) where expiry_date < now() + INTERVAL $get_record day AND shop_id=$shop_id"); 
    }    
    //   dd($return_stock);
   
    $output = '';
    if($return_stock)
    {
     $output .= '
      <table class="table" bordered="1">  
                       <tr>  
                            <th>Product Name</th>  
                            <th>Avaliable Quantity</th>
                            <th>Unit</th>   
                            <th>Expiry Date</th>  
         
                       </tr>
     ';
    //  while($row = mysqli_fetch_array($return_stock))
     foreach($return_stock as $row)
     { 
         if(!$row->per_stript_qty)
         {
             $per_strip = 1;
         }
         else{
            $per_strip = $row->per_stript_qty;
         }
         if($row->size_name!="Main")
         {
            $product_name = "$row->product_name ($row->size_name)";
            $unit = round($row->avl_quantity / $per_strip,3);
         }else{
            $product_name = "$row->product_name";
            $unit = round($row->avl_quantity / $per_strip,3);
         }
      $output .= '
       <tr>  
                            <td>'.$product_name .'</td>  
                            <td>'.$row->avl_quantity .'</td> 
                            <td>'.$unit .'</td>  
                            <td>'.$row->expiry_date .'</td>  
          
                       </tr>
      ';
     }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Prduct_Expiry.xls');
        echo $output;
    }  
}

public function avaliable_Qty()
{
    // dd($get_record);
    $shop_id = Auth::user()->shop_id; 
    $product=DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name, SUM(s_stock.avl_quantity) as avl_quantity,p_attr.per_stript_qty FROM shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC"); 
     
    //   dd($product);
    //   dd($this->report_data);
    $output = '';
    if($product)
    {
     $output .= '
      <table class="table" bordered="1">  
                       <tr>  
                            <th>Product Name</th>  
                            <th>Avaliable Quantity</th>
                            <th>Unit</th>   
                         
                       </tr>
     ';
    //  while($row = mysqli_fetch_array($return_stock))
     foreach($product as $row)
     { 
        if(!$row->per_stript_qty)
        {
            $per_strip = 1;
        }
        else{
           $per_strip = $row->per_stript_qty;
        }
        if($row->size_name!="Main")
        {
           $product_name = "$row->product_name ($row->size_name)";
           $unit = round($row->avl_quantity / $per_strip,3);
        }else{
           $product_name = "$row->product_name";
           $unit = round($row->avl_quantity / $per_strip,3);
        }
          
      $output .= '
       <tr>  
                            <td>'.$product_name .'</td>  
                            <td>'.$row->avl_quantity .'</td> 
                            <td>'.$unit .'</td>                       
          
                       </tr>
      ';
     }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Avalaible Stock.xls');
        echo $output;
    }  
}



// ===========================Generate Excel Sheet (Reports)====================================

}
