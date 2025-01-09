<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();

            return response()->json(['message' => 'Products retrieved successfully', 'data' => $products], 200);
        } catch (QueryException) {
            return response()->json(['message' => 'Error retrieving products'], 500);
        }
    }
    
    public function show(string $id){
        $product = Product::find($id);

        if($product) {
            return response()->json(['message' => 'Product found', 'data' => $product]);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'profit_margin' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'vat' => 'required|numeric',
            'total_sale_price' => 'required|numeric',
            'image' => 'required|string',
            'stock' => 'required|numeric',

        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->purchase_price = $request->purchase_price;
            $product->profit_margin = $request->profit_margin;
            $product->sale_price = $request->sale_price;
            $product->vat = $request->vat;  
            $product->total_sale_price = $request->total_sale_price;
            $product->image = $request->image;
            $product->stock = $request->stock;
            $product->created_by_user = auth()->user()->id;
            $product->save();

            return response()->json(['message' => 'Product created successfully']);
        } catch (QueryException) {
            return response()->json(['message' => 'Error creating product'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'profit_margin' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'vat' => 'required|numeric',
            'total_sale_price' => 'required|numeric',
            'image' => 'required|string',
            'stock' => 'required|numeric',
        ]);

        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->purchase_price = $request->purchase_price;
            $product->profit_margin = $request->profit_margin;
            $product->sale_price = $request->sale_price;
            $product->vat = $request->vat;  
            $product->total_sale_price = $request->total_sale_price;
            $product->image = $request->image;
            $product->stock = $request->stock;
            $product->updated_by_user = auth()->user()->id;
            $product->save();

            return response()->json(['message' => 'Product updated successfully']);
        } catch (QueryException  $e) {
            return response()->json(['message' => 'Error updating event: ' . $e->getMessage()], 500);
        }
    }

    public function delete(string $id){
        $product = Product::find($id);

        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }


}
