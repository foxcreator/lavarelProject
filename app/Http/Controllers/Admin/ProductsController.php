<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\CreateProductRequest;
//use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
//use App\Repositories\Contracts\ProductRepositoryContract;
//use App\Services\Contracts\FileStorageServiceContract;
//use App\Services\FileStorageService;
use App\Services\FileStorageService;
use App\Services\ImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin/products/index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin/products/create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $category = Category::find($data['category']);
            $product = $category->products()->create($data);

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('status', "The product #{$product->id} was success");

        } catch (\Exception $e){
            DB::rollBack();
            logs()->warning($e);

            return redirect()->back()->with('warn', 'OOooopsss thats wrong');
        }
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin/products/edit', compact('product', 'categories'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(Request $request, Product $product)
    {
       //
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        //
    }
}
