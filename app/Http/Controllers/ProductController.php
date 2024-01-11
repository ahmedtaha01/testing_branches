<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // $this->middleware('is_admin')->except(['index','show']);
    } 
    public function index()
    {
        if(request()->ajax()){
            $products = Product::all();
            $html = view('products.table',compact('products'))->render();
            return response()->json(['html' => $html]);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ids)
    {
        return 'success';
    }

    public function destroyAll(Request $request)
    {
        Product::whereIn('id', $request->ids)->get()->each->delete();
        return 'deleted success';
    }
}
