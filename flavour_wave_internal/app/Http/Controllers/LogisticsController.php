<?php

namespace App\Http\Controllers;

use App\Models\Logistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LogisticsController extends Controller
{
    public function make(Request $request){
        $validator = Validator::make($request->all(),[
            'preorder_id' => ['required',Rule::exists('preorders','id')],
            'driver_id' => ['required',Rule::exists('drivers','id')],
            'quantity' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        Logistic::create($validator->validate());
        return response()->json([
            'message' => 'Making deliver is successful.'
        ]);
    }

    public function getCount(){
        return Logistic::latest()->count();
    }

    public function getCountWeekly(){
        $today = Carbon::now();
        $startOfWeek = $today->startOfWeek();
        $endOfWeek = $today->endOfWeek();
        $weeklyData = Logistic::whereBetween('created_at',[$startOfWeek,$endOfWeek])->count();
        return $weeklyData;;
    }
}
