<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;

use DB;

class ProductController extends Controller {
    use FileUploadTrait;

    public function index() {
        $products = Product::orderBy('id', 'DESC')->get();

        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $categories = Category::get()->pluck('title', 'id');

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request) {
        $input_data = $request->only(['title', 'sku', 'short_description', 'description', 'status']);
        $category_ids = $request->get('category_id', '');
        $photos = [];

        if (isset($request->images)) {
            $photos = $this->uploadFiles($request->images, 'products');
        }

        $product = Product::create($input_data);

        if ($product->id) {
            foreach ($category_ids as $key => $value) {
                ProductCategory::create(['product_id' => $product->id, 'category_id' => $value]);
            }

            if (count($photos)) {
                foreach ($photos as $key => $value) {
                    ProductImage::create(['product_id' => $product->id, 'file_name' => $value]);
                }
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        $selected_categories = ProductCategory::where('product_id', $product->id)
        ->select(DB::raw('group_concat(category_id) as category_id'))
        ->value('category_id');

        if ($selected_categories) {
            $selected_categories = explode(',', $selected_categories);
        }

        return view('admin.product.edit', compact('product', 'categories', 'selected_categories'));
    }

    public function update(Request $request, $id) {
        $input_data = $request->only(['title', 'sku', 'short_description', 'description', 'status']);
        $category_ids = $request->get('category_id', '');
        $photos = [];

        if (isset($request->images)) {
            $photos = $this->uploadFiles($request->images, 'products');
        }

        $product = Product::findOrFail($id);
        $product->update($input_data);

        if ($product->update($input_data)) {
            ProductCategory::where('product_id', $product->id)->delete();

            foreach ($category_ids as $key => $value) {
                ProductCategory::create(['product_id' => $product->id, 'category_id' => $value]);
            }

            if (count($photos)) {
                foreach ($photos as $key => $value) {
                    ProductImage::create(['product_id' => $product->id, 'file_name' => $value]);
                }
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete($id);
        ProductCategory::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();

        return redirect()->route('admin.products.index');
    }
}
