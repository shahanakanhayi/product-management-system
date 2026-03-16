<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //to dreate
    public function createProduct(Request $request)
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

    // to create warehouse
    public function createWarehouse(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $warehouse = Warehouse::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Warehouse created successfully',
            'data' => $warehouse
        ]);
    }

    //to create store
    public function createStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $store = Store::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Store created successfully',
            'data' => $store
        ]);
    }

    // add products to warehouse
    public function addProductsToWarehouse(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $stock = Stock::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();

        if ($stock) {
            // Increase stock
            $stock->increment('quantity', $request->quantity);
        } else {
            // Create new stock
            $stock = Stock::create([
                'product_id' => $request->product_id,
                'warehouse_id' => $request->warehouse_id,
                'quantity' => $request->quantity
            ]);
        }
    }

    //add stock to store
    public function addProductsToStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'store_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Get warehouse stock
        $warehouseStock = Stock::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first();

        if (!$warehouseStock || $warehouseStock->quantity < $request->quantity) {
            return response()->json([
                'message' => 'Insufficient stock in warehouse'
            ]);
        }

        // Reduce warehouse stock
        $warehouseStock->decrement('quantity', $request->quantity);

        // Add to store
        $storeStock = Stock::where('product_id', $request->product_id)
            ->where('store_id', $request->store_id)
            ->first();

        if ($storeStock) {
            $storeStock->increment('quantity', $request->quantity);
        } else {
            $storeStock = Stock::create([
                'product_id' => $request->product_id,
                'store_id' => $request->store_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'message' => 'Stock transferred successfully',
            'data' => $storeStock
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
