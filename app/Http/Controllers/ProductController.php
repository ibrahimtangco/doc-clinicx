<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $productModel, $productService;

    public function __construct(ProductService $productService, Product $productModel)
    {
        $this->productService = $productService;
        $this->productModel = $productModel;
    }


    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('availability', '1')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = $this->productModel->storeProduct($validated);

        if (!$product) {
            emotify('error', 'Failed to add product');
            return redirect()->route('products.index');
        }

        emotify('success', 'Product added successfully');
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('availability', '1')->get();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product = $this->productModel->updateProduct($validated, $product);

        if (!$product) {
            emotify('error', 'Failed to update product');
            return redirect()->route('products.index');
        }

        emotify('success', 'Product updated successfully');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $result = $product->delete();

        if (!$result) {
            emotify('error', 'Failed to delete product');
            return redirect()->route('products.index');
        }

        emotify('succes', 'Product delete successfully');
        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {

        $products = $this->productModel->searchProduct($request->search);
        $searchDisplay = $this->productService->searchResults($products);

        return response($searchDisplay);
    }
}
