@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-md shadow-md">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-700">Manage Product</h2>
    <a href="{{ route('product.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
      + Add New
    </a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">
      {{ session('success') }}
    </div>
  @endif

  <table class="w-full table-auto border-collapse border border-gray-200">
    <thead>
      <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
        <th class="py-3 px-6 text-left border border-gray-300">ID</th>
        <th class="py-3 px-6 text-left border border-gray-300">Name</th>
        <th class="py-3 px-6 text-left border border-gray-300">Category</th>
        <th class="py-3 px-6 text-left border border-gray-300">Description</th>
        <th class="py-3 px-6 text-left border border-gray-300">Image</th>
        <th class="py-3 px-6 text-center border border-gray-300">Actions</th>
      </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
      @forelse ($products as $product)
      <tr class="border-b border-gray-200 hover:bg-gray-50">
        <td class="py-3 px-6 text-left border border-gray-300">{{ $product->id }}</td>
        <td class="py-3 px-6 text-left border border-gray-300">{{ $product->name }}</td>
        <td class="py-3 px-6 text-left border border-gray-300">
                @foreach ($product->categories as $category)
                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-1 px-2.5 py-0.5 rounded">
                        {{ $category->name }}
                    </span>
                @endforeach
        </td>
        <td class="py-3 px-6 text-left border border-gray-300">
          {{ Str::limit($product->description, 50, '...') }}
        </td>
        <td class="py-3 px-6 text-left border border-gray-300">
            <img src="{{ asset($product->image) }}" class="w-24" alt="{{ $product->name }}">
        </td>
        <td class="py-3 px-6 text-center border border-gray-300">
          <div class="flex item-center justify-center space-x-2">
            <a href="{{ route('product.edit', $product->id) }}"
               class="text-white bg-green-500 hover:bg-green-600 px-4 py-1 rounded-md shadow-md transition duration-300" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-white bg-red-500 hover:bg-red-600 px-4 py-1 rounded-md shadow-md transition duration-300" title="Delete">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="4" class="text-center py-6 text-gray-500">No categories found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
