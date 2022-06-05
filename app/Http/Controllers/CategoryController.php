<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(){
        if(auth()->user()->isAdmin == 0) return redirect("/dashboard");
        
        $mimiCategories = Category::where('shopName', 'Mimi Baby')->get();
        $kabineCategories = Category::where('shopName', 'Kabine')->get();
        $cornerCategories = Category::where('shopName', 'Baby Corner')->get();
        return view('categories', compact('mimiCategories', 'kabineCategories', 'cornerCategories'));
    }
}
