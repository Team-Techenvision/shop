<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class BarCode extends Controller
{
    //
    public function barcode(){

        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $barcode_data= $d->getBarcodeHTML('44456456561', 'C128', 2,55,'black', true);
        return view('admin/common/barcode', compact('barcode_data'));

        
    }
}
