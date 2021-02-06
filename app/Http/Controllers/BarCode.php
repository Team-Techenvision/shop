<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class BarCode extends Controller
{

    public function quantity($barcode){
        $data['barcode'] = $barcode;
        // dd($data['barcode']);

        // return view('admin/common/print', $data);
        $data['main_breadcrum'] = 'BarCode';
        $data['page_title'] = 'Create BarCode';
        $data['flag'] = 12; 
        //$data['stock'] = DB::table('shop_stocks')->orderBy('id','asc')->get(); 
        return view('admin/webviews/admin_manage_stock',$data);
    }
    //
    public function barcode(Request $req){
        $barcode = $req->barcode;
        $quantity = $req->quantity;
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $barcode_data= $d->getBarcodeHTML($barcode, 'UPCA', 2,55,'black', true);
        $quantity = $quantity; 
        return view('admin/common/barcode', compact('barcode_data', 'quantity'));

        
    }
}
