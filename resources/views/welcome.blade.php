@extends('layouts.app')

@section('content')

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Category</h2>
                <p class="mt-2 text-3xl font-bold text-blue-500">{{ count($category) }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Product</h2>
                <p class="mt-2 text-3xl font-bold text-green-500">{{ count($product) }}</p>
            </div>
        </div>

@endsection

