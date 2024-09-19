@extends('vouchers.layout')


@section('breadcrumb')
    Edit Product
@endsection
@section('content')
    <section>
        <form method="post" action="{{ route('item.update', $item->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="max-w-4xl mx-auto p-4">
                <!-- Product Photo -->

                <div class="border border-gray-300 rounded-sm max-w-4xl mb-4">
                    <label class="text-sm font-mono text-gray-500 ms-3 mt-4">{{ $item->name }} Image</label>
                    <img src="{{ asset('storage/item_images/' . $item->image) }}" class="w-[300px] mx-auto" alt="">
                </div>
                <div class="mb-4">

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        file</label>
                    <input name="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                        800x400px).</p>

                    @error('image')
                        <p class="text-red-600  text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Product Title, Category, Price, and Stock -->
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="product-title" class="block text-sm font-medium text-gray-700">Product Title</label>
                        <input type="text" value="{{ old('name', $item->name) }}" name="name" id="product-title"
                            name="product-title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />

                        @error('name')
                            <p class="text-red-600  text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="product-category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="product-category" name="category_id" name="product-category"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $item->category_id == $category->id ? 'selected' : '') }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600  text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="product-price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" value="{{ old('price', $item->price) }}" name="price" id="product-price"
                            name="product-price"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />

                        @error('price')
                            <p class="text-red-600  text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="product-stock" class="block text-sm font-medium text-gray-700">Stock</label>
                        <input type="number" value="{{ old('stock', $item->stock) }}" name="stock" id="product-stock"
                            name="product-stock"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" />

                        @error('stock')
                            <p class="text-red-600  text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="product-description" class="block text-sm font-medium text-gray-700">Product
                        Description</label>
                    <textarea id="product-description" name="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $item->description) }}</textarea>

                    @error('description')
                        <p class="text-red-600  text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Save and Cancel Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('item.index') }}" type="button"
                        class="text-gray-700 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-md text-sm px-4 py-2 hover:bg-gray-100 hover:text-blue-700">Cancel</a>
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-md text-sm px-4 py-2">Save</button>
                </div>
            </div>
        </form>
    </section>
@endsection
