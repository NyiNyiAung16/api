<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Preorder;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function show(){
        return Order::latest()->get();
    }

    public function store(OrderRequest $request){
        $cleanData = $request->validated();
        Order::create($cleanData);
        return $this->acceptOrder($cleanData['preorder_id']);
        return response()->json(['message'=>"Order is successful."]);
    }

    public function cancel(Request $request){
        $cleanData = $request->validate([
            'preorder_id' => ['required',Rule::exists('preorders','id')],
            'cancel_reason'=>'required'
        ]);
        $this->cancelOrder($cleanData['preorder_id'],$cleanData['cancel_reason']);
        return response()->json(['message'=>'The order has been cancelled.']);
    }

    // change status
    public function acceptOrder($id){
        $accept = $this->acceptOrderStatus();
        Preorder::where('id', $id)->update($accept);
        $p = Preorder::find($id);
        $preorder = $p->products;        
        foreach($preorder as $product){
            $quantity = $p->order_quantity;
            $product->inventory()->update(['sales_issue'=>$quantity]);
            $get = $product->inventory->availability - $quantity;
            $product->inventory()->update(['availability'=>$get]);
        }
    }

    public function cancelOrder($id, $cancel){

        $cancel = $this->cancelOrderStatus();
        Preorder::where('id', $id)->update($cancel);

        $reason = $this->inputCancelReason($cancel);
        Preorder::where('id', $id)->update($reason);
    }

    // accept status
    private function acceptOrderStatus(){
        return [ 'status' => 'accepted' ];
    }

    // cancel status
    private function cancelOrderStatus(){
        return [ 'status' => 'cancelled' ];
    }

    // add cancel reason
    private function inputCancelReason($cancel_reason){
        return ['cancel_reason'=>$cancel_reason];
    }
}
