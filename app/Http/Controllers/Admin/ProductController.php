<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;

use DB;
use Excel;

class ProductController extends Controller {
    use FileUploadTrait;
    public $category = '';
    public $image = '';

    public function index(Request $request) {
        $products = Product::orderBy('id', 'DESC')->get();

        $status = [
            '' => trans("admin.please_select"),
            '1' => trans("admin.buttons.status.active"),
            '0' => trans("admin.buttons.status.inactive"),
        ]; 

        $categories = Category::where('status', 1)
        ->get()
        ->pluck('title', 'id');

        if (request()->ajax()) {
            $query = Product::query();
            $template = 'admin.partials.actionsTemplate';
            
            $query->select([
                'products.id',
                'products.title',
                'products.sku',
                'products.short_description',
                'products.status',
            ]);

            $query->orderBy('id', 'DESC');

            if($request->search || $request->status != '' || !empty($request->categories)) {
                $table = Datatables::of($query)->filter(function ($query) use ($request) {
                    if ($request->search) {
                        $query->orWhere('title', 'like', '%' . $request->search . '%');
                    }

                    if (!empty($request->categories)) {
                        $product_ids = ProductCategory::whereIn('category_id', $request->categories)
                        ->select(DB::raw('group_concat(product_id) as product_id'))
                        ->value('product_id');

                        if ($product_ids) {
                            $query->whereIn('id', explode(',', $product_ids));
                        }
                    }

                    if ($request->status != '') {
                        $query->where('status', $request->status);
                    }
                });
            } else {
                $table = Datatables::of($query);
            }

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);

            $table->addColumn('category', '');
            $table->addColumn('image', '');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('category', function ($row) {
                $category_ids = ProductCategory::where('product_id', $row->id)
                ->select(DB::raw('group_concat(category_id) as category_id'))
                ->value('category_id');

                if ($category_ids) {
                    $categories = Category::whereIn('id', explode(',', $category_ids))->get();

                    if (count($categories)) {
                        $this->category = '';

                        foreach ($categories as $value) {
                            $this->category .= '<span class="bg-primary rounded p-2 mr-1">' . $value->title . '</span>';
                        }

                        return $this->category;
                    } else {
                        return '-';
                    }
                }
            });

            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'product_';
                $routeKey = 'admin.products';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->editColumn('status', function ($row) {
                if ($row->status) {
                    return '<span class="bg-success rounded p-2 mr-1">' . trans("admin.buttons.status.active") . '</span>';
                } else {
                    return '<span class="bg-danger rounded p-2 mr-1">' . trans("admin.buttons.status.inactive") . '</span>';
                }
            });

            $table->editColumn('image', function ($row) {
                $images = ProductImage::where('product_id', $row->id)->get();

                if (count($images)) {
                    $this->image = '';

                    foreach ($images as $value) {
                        $this->image .= '<img class="prod-img" src="' . url('public/uploads/products/thumb/' . $value->file_name) . '" alt="{{ $value->file_name }}" />';
                    }

                    return $this->image;
                } else {
                    return '-';
                }
            });

            $table->editColumn('short_description', function ($row) {
                return ($row->short_description) ? $row->short_description : '-';
            });

            $table->rawColumns(['actions', 'status', 'category', 'image']);

            return $table->make(true);
        }

        return view('admin.product.index',compact('status', 'categories'));
    }

    public function create() {
        $categories = Category::get()->pluck('title', 'id');

        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request) {
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

    public function update(UpdateProductRequest $request, $id) {
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

    public function productExport() {
        return Excel::download(new ExportData, 'products.csv');
    }
}

class ExportData implements FromCollection, WithHeadings {
    public function collection() {
        return  Product::select('title', 'sku', 'short_description', 'description', 'status')
        ->get();
    }

    public function headings(): array {
        return ['Title', 'SKU', 'Short Description', 'Description', 'Status'];
    }
}