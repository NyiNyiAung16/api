<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    // get all customers' info
    public function show(){
        return Customer::latest()->get();
    }

    // create customer account
    public function createcustomer(CustomerRequest $request){
        $cleanData = $request->validated();
        $customer_id='fw-' . fake()->randomNumber(5,true);
        $cleanData['$customer_id'] = $customer_id;
        $customer = Customer::create($cleanData);
        return response()->json([
            'message' => 'Your account has successfully been created',
            'customer'=>$customer
        ]);
    }

}
