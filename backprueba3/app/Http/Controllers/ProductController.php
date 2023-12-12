<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            return response()->json(Product::orderBy('id', 'desc')->get());
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $fields=$request->validate([
                'name' => 'required|string',
                'image' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|string',
                'quantity' => 'required|string',
                'status' => 'required|string'
            ]);
            $product = Product::create([
                'name' => $fields['name'],
                'image' => $fields['image'],
                'description' => $fields['description'],
                'price' => $fields['price'],
                'quantity' => $fields['quantity'],
                'status' => $fields['status']
            ]);
            return response()->json($product,200);
        }catch (\Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prod = Product::find($id);

        if (!$prod) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'image' => 'string|max:255',
            'description' => 'email|max:255',
            'price' => 'string|max:255',
            'quantity' => 'string|max:255',
            'status' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $prod->update($request->all());

        return response()->json(['user' => $prod], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
