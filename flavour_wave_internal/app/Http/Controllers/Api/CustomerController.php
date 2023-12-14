<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    // get all customers' info
    public function show(){
        return User::latest()->get();
    }

    // create customer account
    public function createUser(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ['required',Rule::unique('users','email')],
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        $cleanData = $validator->validate();
        $user_id='fw-' . fake()->randomNumber(5,true);
        $cleanData['user_id'] = $user_id;
        $cleanData['image_url'] = '/profile/1.png';
        $user = User::create($cleanData);
        auth()->login($user);
        return response()->json([
            'message' => 'Your account has successfully been created',
            'user'=>$user
        ]);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message'=>'Sign out is successful.']);
    }

    // edit customer account
    public function update(User $user, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ['required',Rule::unique('users','email')],
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()]);
        }
        $cleanData = $validator->validate();
        $user->update($cleanData);
        return response()->json(['message'=>'Update your profile is successful.']);
    }
}
