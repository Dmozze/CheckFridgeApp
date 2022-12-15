<?php

namespace App\Http\Controllers;

use App\Models\Fridge;
use App\Models\Product;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class FridgeController extends Controller
{
    public function index() {
        return Fridge::all()->toJson();
    }

    public function create() {
//        $fridge = new Fridge();
//        $fridge->title = "without title";
//        $fridge->save();
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
        ]);
        $fridge = Fridge::create($request->all());
        return response()->json([
            'message' => 'Fridge created',
            'data' => $fridge
        ]);
    }

    public function showProducts($id) {
        $cache = cache()->get('fridge_' . $id);
        if ($cache) {
            return $cache;
        } else {
            $products = Fridge::find($id)->products()->orderBy('title')->get()->toJson(JSON_PRETTY_PRINT);
            cache()->put('fridge_' . $id, $products, 60);
            return $products;
        }
    }

    public function edit($id) {
        //
    }

    public function update($request, $id) {
        $request->validate([
            'title' => 'required',
        ]);
        $fridge = Fridge::find($id);
        $fridge->update($request->all());
        return response()->json([
            'message' => 'Fridge updated',
            'data' => $fridge
        ]);
    }

    public function destroy($fridge_id)
    {
        Fridge::where('id', $fridge_id)->get()->each(function ($fridge) {
            $fridge->products()->detach();
            $fridge->users()->detach();
            $fridge->delete();
        });
        return response()->json([
            'message' => 'Fridge deleted',
        ]);
    }

    public function addProduct($fridge_id, Request $request)
    {
        $fridge = Fridge::find($fridge_id);
        $request->validate([
            'title' => 'required',
        ]);
        // if nothing in the database, then create a new record
        $product = Product::firstOrCreate(array('title' => $request->title));
        $fridge->products()->attach($product->id);
        cache()->forget('fridge_' . $fridge_id);
        return response()->json([
            'message' => 'Product added to fridge',
            'data' => $product
        ]);
    }

    public function removeProduct($fridge_id, $product_id){
        $fridge = Fridge::find($fridge_id);
        $fridge->products()->detach($product_id);
        cache()->forget('fridge_' . $fridge_id);
        return response()->json([
            'message' => 'Product removed from fridge',
        ]);
    }
}
