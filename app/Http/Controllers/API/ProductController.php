<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //to dreate
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'price' => 'required|numeric'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ]);
    }

    //to show product by id
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ]);
        }

        return response()->json([
            'data' => $product
        ]);
    }

    //to update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ]);
        }

        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products,code,' . $id,
            'price' => 'required|numeric'
        ]);

        $product->update([
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price
        ]);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }
    // to delete product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ]);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
