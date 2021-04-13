<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Category/Index', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Category/Create', [
            'categories' => Category::withDepth()->latest()->get()->toTree()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories'],
        ]);
        
        $data['slug'] = Str::of($request->name)->limit(100)->slug();

        if($request->parent)
        {
            $parent = Category::find($request->parent);
            Category::create($data, $parent);
        } else {
            Category::create($data);
        }
        session()->flash('flash.message', 'Category Created Successfully');
        session()->flash('flash.messageStyle', 'success');

        return back();
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Category/Edit', [
            'category' => $category->only('id', 'name', 'slug', 'parent_id'),
            'categories' => Category::withDepth()->whereNotDescendantOf($category)->latest()->get()->toTree()
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('categories')->ignore($category->id)],
        ]);

        $category->name = $request->name;
        $category->parent_id = $request->parent;

        if($category->isDirty('name'))
        {
            $category->slug = Str::of($request->name)->limit(100)->slug();
        }
        $category->save();

        session()->flash('flash.message', 'Category Updated Successfully');
        session()->flash('flash.messageStyle', 'success');

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
