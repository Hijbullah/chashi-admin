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

    public function showVitalInfoForm()
    {
        return Inertia::render('Admin/Product/Create/VitalInfo', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ]);
    }

    // public function create($section = 'vital-info')
    // {
    //     if($section === 'images')
    //     {
    //         return 'image';
    //     }

    //     if($section === 'details')
    //     {
    //         return 'details';
    //     }

    //     return Inertia::render('Admin/Product/Create/VitalInfo', [
    //         'categories' => Category::withDepth()->latest()->get()->toTree()
    //     ]);
    // }

    // public function store(Request $request, $section = 'vital-info')
    // {
    //     if($section === 'images')
    //     {
    //         return 'image';
    //     }

    //     if($section === 'details')
    //     {
    //         return 'details';
    //     }

    //     // $this->storeVitalInfo($request);
    //     return redirect()->route('admin.products.create', 'images');

    //     // $request->validate([
    //     //     'category' => ['required', 'numeric'],
    //     //     'name' => ['required', 'string', 'max:250'],
    //     //     'unit' => ['required', 'string'],
    //     //     'standard_price' => ['required', 'numeric'],
    //     //     'offer_price' => ['nullable', 'numeric'],
    //     //     'quantity' => ['nullable', 'numeric'],
    //     //     'bullet_point_1' => ['required', 'string', 'max:200'],
    //     //     'bullet_point_2' => ['required', 'string', 'max:200'],
    //     //     'bullet_point_3' => ['required', 'string', 'max:200'],
    //     //     'bullet_point_4' => ['nullable', 'string', 'max:200'],
    //     //     'bullet_point_5' => ['nullable', 'string', 'max:200'],
    //     //     'description' => ['nullable', 'string']
    //     // ]);
    
    //     // $product = new Product;
    //     // $product->category_id = $request->category;
    //     // $product->name = $request->name;
    //     // $product->slug = Str::of($request->name)->limit(100)->slug();
    //     // $product->standard_price = $request->standard_price;
    //     // $product->offer_price = $request->offer_price;
    //     // $product->unit = $request->unit;
    //     // $product->quantity = $request->quantity;
    //     // $product->bullet_points = array_filter(array(
    //     //     $request->bullet_point_1, 
    //     //     $request->bullet_point_2,
    //     //     $request->bullet_point_3,
    //     //     $request->bullet_point_4,
    //     //     $request->bullet_point_5,
    //     // ));
    //     // $product->description = $request->description;
    //     // $product->save();

    //     return redirect()->route('admin.products.index');

    // }

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

        return redirect()->route('admin.products.create.images', $product->slug);
    }

    public function showImagesForm(Product $product)
    {
        // return $product->getMedia();
        return Inertia::render('Admin/Product/Create/Images', [
            'product' => $product->only('id', 'name', 'slug'),
            'images' => $product->getMedia()->map(function(Media $media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl()
                ];
            })
        ]);
    }

    public function uploadProductImage(Request $request, Product $product)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048']
        ]);
        $product
            ->addMedia($request->photo)
            ->toMediaCollection();
        return back();
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', [
            'categories' => Category::withDepth()->latest()->get()->toTree(),
            'product' => $product->only('id', 'category_id', 'slug', 'name', 'standard_price', 'offer_price', 'unit', 'quantity', 'bullet_points', 'description')
        ]);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('flash.message', 'Product deleted Successfully');
        session()->flash('flash.messageStyle', 'success');

        return back();
    }
}
