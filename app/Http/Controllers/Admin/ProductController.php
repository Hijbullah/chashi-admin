<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Product/Index', [
            'products' => Product::latest()->get()
        ]);
    }

    public function createVitalInfo()
    {
        return Inertia::render('Admin/Product/Create/VitalInfo', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ]);
    }


    public function storeVitalInfo(Request $request)
    {
        $request->validate([
            'category' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:250'],
            'unit' => ['required', 'string'],
            'standard_price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'quantity' => ['nullable', 'numeric']
        ]);

        $product = new Product;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->limit(100)->slug();
        $product->standard_price = $request->standard_price;
        $product->offer_price = $request->offer_price;
        $product->unit = $request->unit;
        $product->quantity = $request->quantity;

        $product->save();

        return redirect()->route('admin.products.edit.images', $product->slug);
    }

    public function editVitalInfo(Product $product)
    {
        return Inertia::render('Admin/Product/Edit/VitalInfo', [
            'categories' => Category::withDepth()->latest()->get()->toTree(),
            'product' => $product->only('id', 'slug', 'category_id', 'name', 'standard_price', 'offer_price', 'unit', 'quantity')
        ]);
    }

    public function updateVitalInfo(Request $request, Product $product)
    {
        $request->validate([
            'category' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:250'],
            'unit' => ['required', 'string'],
            'standard_price' => ['required', 'numeric'],
            'offer_price' => ['nullable', 'numeric'],
            'quantity' => ['nullable', 'numeric']
        ]);

        $product->category_id = $request->category;
        $product->name = $request->name;

        if($product->isDirty('name')) {
            $product->slug = Str::of($request->name)->limit(100)->slug();
        } 
        $product->standard_price = $request->standard_price;
        $product->offer_price = $request->offer_price;
        $product->unit = $request->unit;
        $product->quantity = $request->quantity;

        $product->save();

        return redirect()->route('admin.products.edit.images', $product->slug);
    }

    public function editImages(Product $product)
    {
        // return $product->getMedia();
        return Inertia::render('Admin/Product/Edit/Images', [
            'product' => $product->only('id', 'name', 'slug'),
            'images' => $product->getMedia()->map(function(Media $media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl()
                ];
            })
        ]);
    }

    public function storeImage(Request $request, Product $product)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048']
        ]);
        $product
            ->addMedia($request->photo)
            ->toMediaCollection();
        return back();
    }

    public function destroyImage($imageId)
    {
        Media::find($imageId)->delete();
        return back();
    }

    public function editDescription(Product $product)
    {
        return Inertia::render('Admin/Product/Edit/Description', [
            'product' => $product->only('id', 'slug', 'name', 'excerpt', 'description')
        ]);
    }

    public function updateDescription(Request $request, Product $product)
    {
        $request->validate([
            'excerpt' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string']
        ]);

        $product->excerpt = $request->excerpt;
        $product->description = $request->description;
        $product->status = true;
        $product->save();

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('flash.message', 'Product deleted Successfully');
        session()->flash('flash.messageStyle', 'success');

        return back();
    }
}
