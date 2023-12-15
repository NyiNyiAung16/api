<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    

    // update sales issue
    private function inputSalesQty($product_id, $sales_issue){
        $total = Warehouse::where('product_id', $product_id)->select('sales_issue')->get();
        $total += $sales_issue;
        return ['sales_issue'=>$total];
    }

    // update availability
    private function subtractSales($product_id, $sales_issue){
        $total = Warehouse::where('product_id', $product_id)->select('availability')->get();
        $total -= $sales_issue;
        return ['availability'=>$total];
    }

    
}
