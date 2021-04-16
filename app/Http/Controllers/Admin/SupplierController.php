<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Supplier/Index', [
            'suppliers' => Supplier::select('id', 'name', 'slug')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Supplier/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:250', 'unique:suppliers'],
            'details' => ['nullable', 'string']
        ]);

        $data['slug'] = Str::of($request->name)->limit(100)->slug();
        
        Supplier::create($data);

        session()->flash('flash.message', 'Supplier created Successfully');
        session()->flash('flash.messageStyle', 'success');

        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('Admin/Supplier/Edit', [
            'supplier' => $supplier->only('id', 'slug', 'name', 'details')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:250', Rule::unique('suppliers')->ignore($supplier->id)],
            'details' => ['nullable', 'string']
        ]);
        
        $supplier->name = $request->name;
        $supplier->details = $request->details;

        if($supplier->isDirty('name'))
        {
            $supplier->slug = Str::of($request->name)->limit(100)->slug();
        }

        $supplier->save();

        session()->flash('flash.message', 'Supplier Updated Successfully');
        session()->flash('flash.messageStyle', 'success');

        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        
        session()->flash('flash.message', 'Supplier deleted Successfully');
        session()->flash('flash.messageStyle', 'success');

        return back();
    }
}
