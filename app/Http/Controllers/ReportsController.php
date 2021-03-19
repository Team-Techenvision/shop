<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

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
    $data['product']=DB::select("SELECT s_stock.products_id,products.product_name,sizes.size_name, SUM(s_stock.avl_quantity) as avl_quantity,p_attr.per_stript_qty FROM shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id =$shop_id) GROUP BY (s_stock.attribute_id) ORDER BY avl_quantity ASC");       
    // $data['product']=DB::select("select * from shop_stocks where  shop_id=$shop_id;"); 
    // dd($data['product'] );
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
    $data['store_product']=DB::select("select products.product_name,sizes.size_name,timestampdiff(day,now(),s_stock.`expiry_date`) AS expiry_day,s_stock.`avl_quantity`,s_stock.`products_id`,s_stock.expiry_date,p_attr.per_stript_qty from shop_stocks s_stock LEFT JOIN products ON(products.products_id=s_stock.products_id)LEFT JOIN product_attributes p_attr ON(p_attr.id=s_stock.attribute_id)LEFT JOIN sizes ON(sizes.id=p_attr.product_size) where (s_stock.shop_id=$shop_id) ORDER BY (s_stock.`expiry_date`) ASC");               
   
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
public function daily_sell_update($date)
{
    echo $date; die();
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
    $data['top_selling']=DB::select("SELECT order_items.prod_id,SUM(order_items.quantity) AS MAXsell,products.product_name,sizes.size_name,product_attributes.per_stript_qty FROM order_items LEFT JOIN orders ON (orders.order_id=order_items.order_id)LEFT JOIN product_attributes ON(product_attributes.id=order_items.prod_id) LEFT JOIN products ON (products.products_id = product_attributes.products_id) LEFT JOIN sizes ON(sizes.id=product_attributes.product_size) WHERE (order_items.created_at > now() - INTERVAL 30 day AND orders.shop_id=$shop_id) GROUP BY (order_items.prod_id) ORDER BY MAXsell DESC"); 
    
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

    //  dd($data['return_stock']);
    // $stock = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
    // dd($stock);
    // return Excel::download($stock , 'users.xlsx');
    //  $this->export($data['flag']);
    return view('admin/webviews/store_all_report',$data);
}
// =====================End return_stock_report============================

}
