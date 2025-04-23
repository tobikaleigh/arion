<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

// Resources
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::paginate(50);

        return Inertia::render('Products', [
            'products' => new ProductCollection($products),
        ]);
    }
}
