<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use App\Models\Category;

use DB;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::orderBy('id', 'DESC')
        ->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        $categories = Category::where('parent_id', 0)
        ->where('status', 1)
        ->with('subCategory')
        ->get()
        ->toArray();

        return view('admin.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request) {
        $insert_data = $request->all();

        Category::create($insert_data);

        return redirect()->route('admin.category.index');
    }

    public function show(Category $category) {
        //
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)
        ->whereNotIn('id', [$id])
        ->where('status', 1)
        ->with('subCategory')
        ->get()
        ->toArray();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, $id) {
        $insert_data = $request->all();

        $category = Category::findOrFail($id);
        $category->update($insert_data);

        return redirect()->route('admin.category.index');
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete($id);
        Category::where('parent_id', $id)->delete();

        return redirect()->route('admin.category.index');
    }
}
