<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories =  Category::orderByDesc('name')->paginate(15);

        return view('welcome')->with('categories', $categories);
    }

    public function show(Category $category){

        $products = $category->products()->with('user')->paginate(15);

        return view('categories.show')->with(['category' => $category, 'products' => $products]);
    }
}
