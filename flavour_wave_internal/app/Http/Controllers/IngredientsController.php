<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientsRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function show(){
        return Ingredient::latest()->get();
    }

    public function create(IngredientsRequest $request){
        $cleanData = $request->validated();
        Ingredient::create($cleanData);
        return response()->json(['message'=>'Create ingredient is successful.']);
    }
}
