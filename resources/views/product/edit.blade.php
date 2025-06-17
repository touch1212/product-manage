@extends('layouts.app')

@section('content')

<div class="max-w mx-auto mt-10 p-6 bg-white rounded-md shadow-md">

    <div class="max-w-xs w-full h-auto rounded mx-auto flex justify-center py-2">
        <img src="{{ asset($products->image) }}" width="100" alt="{{ $products->name }}">
    </div>

  <h2 class="text-2xl font-semibold text-gray-700 mb-6">Create New Product</h2>

  <form action="{{ route('product.update',$products->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700">Select Categories</label>
        <select name="category_id[]" multiple class="w-full border rounded p-2">
            <option value="" disabled>--Select Category--</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ collect(old('category_id', $products->categories->pluck('id')->toArray()))->contains($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

      @error('category_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Product Name -->
    <div>
      <label for="name" class="block text-gray-600 font-medium mb-1">Product Name <span class="text-red-500">*</span></label>
      <input type="text" id="name" name="name" placeholder="Enter product name" value="{{ old('name') ?? $products->name}}"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="price" class="block text-gray-600 font-medium mb-1">Product Price <span class="text-red-500">*</span></label>
      <input type="number" id="price" name="price" placeholder="Enter product name" value="{{ old('price') ?? $products->price }}"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      @error('price')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Product Description -->
    <div>
      <label for="description" class="block text-gray-600 font-medium mb-1">Description (optional)</label>
      <textarea
        id="description"
        name="description"
        rows="3"
        placeholder="Add a short description"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
      >{{ old('description') ?? $products->description }}</textarea>
      @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
<!-- Image -->
    <div>
      <label for="image" class="block text-gray-600 font-medium mb-1">Product Image</label>
      <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" />
      @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Submit Button -->
    <div>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition-colors" >
        Update Product
      </button>
    </div>
  </form>
</div>


@endsection

