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
        return view('admin/common/print', $data);
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
