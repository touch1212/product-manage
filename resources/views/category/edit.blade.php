@extends('layouts.app')

@section('content')

<!-- resources/views/category/create.blade.php -->

<div class="max-w mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
    <div class="max-w-xs w-full h-auto rounded mx-auto flex justify-center py-2">
        <img src="{{ asset($categories->image) }}" width="100" alt="{{ $categories->name }}">
    </div>
  <h2 class="text-2xl font-semibold text-gray-700 mb-6">Create New Category</h2>
  <form action="{{ route('category.update',$categories->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @method('PUT')

    <!-- Category Name -->
    <div>
      <label for="name" class="block text-gray-600 font-medium mb-1">Category Name <span class="text-red-500">*</span></label>
      <input type="text" id="name" name="name" placeholder="Enter category name" value="{{ old('name') ?? $categories->name}}"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Category Description -->
    <div>
      <label for="description" class="block text-gray-600 font-medium mb-1">Description (optional)</label>
      <textarea id="description" name="description" rows="3" placeholder="Add a short description"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
      >{{ old('description') ?? $categories->description }}</textarea>
      @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
<!-- Image -->
    <div>
      <label for="image" class="block text-gray-600 font-medium mb-1">Category Image</label>
      <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none" />
      @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Submit Button -->
    <div>
      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition-colors"
      >
        Update Category
      </button>
    </div>
  </form>
</div>


@endsection

