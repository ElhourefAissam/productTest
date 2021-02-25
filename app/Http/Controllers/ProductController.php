<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json(['products' => $product], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        }
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            if ($request->image) {

                $file = $request->file('image');
                $name = '/product/' . uniqid() . '.' . $file->extension();
                $file->storePubliclyAs('public', $name);
                $product->image = $name;
            }
            $product->price = $request->price;
            $product->save();
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 422);
        }
        return response()->json(['product' => $product], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['product' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 422);
        }
        try {
            $product = Product::findOrFail($request->id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            if ($request->image) {

                $file = $request->file('image');
                $name = '/product/' . uniqid() . '.' . $file->extension();
                $file->storePubliclyAs('public', $name);
                $product->image = $name;
            }
            $product->price = $request->price;
            $product->save();
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 422);
        }
        return response()->json(['product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([], 200);
    }
}
