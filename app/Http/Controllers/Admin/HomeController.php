<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller {
    public function index() {
        $products = Product::get()->count();
        $categories = Category::get()->count();

        return view('admin.dashboard', compact('products', 'categories'));
    }
}