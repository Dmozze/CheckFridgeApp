<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{


    public function index()
    {
        return Product::all()->toJson();
    }

    public function create()
    {
//        $product = new Product();
//        $product->title = "without title";
//        $product->save();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        // if nothing in the database, then create a new record
        $product = Product::firstOrCreate(array('name' => $request->name));
        return response()->json([
            'message' => 'Product created',
            'data' => $product
        ]);
    }

    public function show($id)
    {
        return Product::find($id)->toJson();
    }

    public function edit($id)
    {
        //
    }

    public function update($request, $id) {
        $request->validate([
            'title' => 'required',
        ]);
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json([
            'message' => 'Product updated',
            'data' => $product
        ]);
    }

    public function destroy($id) {
        $product = Product::find($id);

    }
}
