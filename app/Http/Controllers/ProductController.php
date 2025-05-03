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
use App\Models\InventoryLocation;
// Models
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::latest()->with(['inventoryLocations'])->paginate(50);

        return Inertia::render('Products', [
            'products' => new ProductCollection($products),
        ]);
    }

    /*  public function show() {}; */

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $input = $request->validated();

        $product                = Product::make();
        $product->internal_id   = $input['internal_id'];
        $product->name          = $input['name'];
        $product->description   = $input['description'];

        $product->save();

        $inventoryLocation = InventoryLocation::firstOrCreate([
            'name' => $input['inventory_location_name'],
        ]);

        $inventoryLocation->products()->attach($product->id, [
            'quantity' => $input['inventory_location_quantity'],
        ]);

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
