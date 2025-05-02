<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

// Resources
use App\Http\Resources\ProductCollection;
use Illuminate\Http\RedirectResponse;

// Requests
use App\Http\Requests\Product\StoreProductRequest;

// Models
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::latest()->paginate(50);

        return Inertia::render('Products', [
            'products' => new ProductCollection($products),
        ]);
    }

    /*  public function show() {}; */

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $input = $request->validated();

        $product                = Product::make();
        $product->name          = $input['name'];
        $product->description   = $input['description'];

        $product->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Product created successfully.',
        ]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Product deleted successfully.',
        ]);
    }
}
