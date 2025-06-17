<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string',
        'price'=> 'required|numeric',
        'category_id' => 'required|array',
        'category_id.*' => 'exists:categories,id',
        ]);

        if($request->hasFile('image')){
           $imgname = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
           $request->image->move('products', $imgname);
        }else{
            $imgname = 'avater.png';
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image'=>'products/'.$imgname
        ]);

            $data = [];
            foreach ($request->category_id as $catId) {
                $data[$catId] = [
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $product->categories()->attach($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
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
        $categories = Category::all();
        $products = Product::find($id);
        return view('product.edit', compact('categories','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'name' => 'required|string',
        'price'=>'required|numeric',
        'category_id' => 'required|array',
        'category_id.*' => 'exists:categories,id',
        ]);

        $product = Product::find($id);

        if($request->hasFile('image')){
            if (is_file($product->image) && file_exists($product->image)) {
                    unlink($product->image);
            }
           $name = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
           $request->image->move('products', $name);
           $imgname = 'products/'.$name;
        }else{
            $imgname = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image'=>$imgname
        ]);
            $data = [];

            foreach ($request->category_id as $catId) {
                $data[$catId] = [
                    'updated_at' => now(),
                ];
            }
            $product->categories()->sync($data);

        return redirect()->route('product.index')->with('success', 'Product update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
