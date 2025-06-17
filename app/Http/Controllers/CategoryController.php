<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'image'=>'mimes:png,jpg,web|max:512'
        ]);

        if($request->hasFile('image')){
           $imgname = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
           $request->image->move('categories', $imgname);
        }else{
            $imgname = 'avater.png';
        }
        Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>'categories/'.$imgname
        ]);

        session()->flash('success', 'Category Created successfully!');
        return redirect()->route('category.index');
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
        $categories = Category::find($id);
        return view('category.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'image'=>'mimes:png,jpg,web|max:512'
        ]);

        $categories = Category::find($id);

        if($request->hasFile('image')){
            if (is_file($categories->image) && file_exists($categories->image)) {
                    unlink($categories->image);
                }
           $imgname = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
           $request->image->move('categories', $imgname);
        }else{
            $imgname = $categories->image;
        }
        $categories->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>'categories/'.$imgname
        ]);

        session()->flash('success', 'Category update successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $categories = Category::find($id);
        if (is_file($categories->image) && file_exists($categories->image)) {
            unlink($categories->image);
        }
        $categories->delete();

        session()->flash('success', 'Category Delete successfully!');
        return redirect()->route('category.index');
    }
}
