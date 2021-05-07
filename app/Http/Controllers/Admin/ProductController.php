<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Product/Index', [
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Product/Create', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:250'],
            'unit' => ['required', 'string'],
            'standard_price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'quantity' => ['nullable', 'numeric'],
            'bullet_point_1' => ['required', 'string', 'max:200'],
            'bullet_point_2' => ['required', 'string', 'max:200'],
            'bullet_point_3' => ['required', 'string', 'max:200'],
            'bullet_point_4' => ['nullable', 'string', 'max:200'],
            'bullet_point_5' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string']
        ]);
    
        $product = new Product;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->limit(100)->slug();
        $product->standard_price = $request->standard_price;
        $product->offer_price = $request->offer_price;
        $product->unit = $request->unit;
        $product->quantity = $request->quantity;
        $product->quantity = $request->quantity;
        $product->bullet_points = array_filter(array(
            $request->bullet_point_1, 
            $request->bullet_point_2,
            $request->bullet_point_3,
            $request->bullet_point_4,
            $request->bullet_point_5,
        ));
        $product->description = $request->description;
        $product->save();
        return redirect()->route('admin.products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'categories' => Category::withDepth()->latest()->get()->toTree(),
            'product' => $product->only('id', 'category_id', 'slug', 'name', 'standard_price', 'offer_price', 'unit', 'quantity', 'bullet_points', 'description')
        ]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('flash.message', 'Product deleted Successfully');
        session()->flash('flash.messageStyle', 'success');

        return back();
    }
}
