<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(5);
        $categories = Category::all();
        return view('item.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        if ($request->image) {
            $file = $request->image;
            $newName = "item_image" . uniqid() . "." . $file->extension();
            $file->storeAs('public/item_images', $newName);
        }

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->image = $newName;
        $item->save();

        return redirect()->route('item.index')->with('create', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;

        if ($request->image) {
            $file = $request->image;
            $newName = "item_images" . uniqid() . '.' . $file->extension();
            $file->storeAs('public/item_images', $newName);
        }

        $item->image = $newName;

        $item->update();

        return redirect()->route('item.index')->with('update', 'Item updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if ($item) {
            $item->delete();
        }

        return redirect()->route('item.index')->with('delete', 'Item Deleted Successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where('name', 'LIKE', "%{$query}%")->paginate(5);
        return view('item.index', compact('items'));
    }

    public function filter(Request $request)
    {
        $categories = Category::all();
        $min = $request->input('min');
        $max = $request->input('max');
        $category = $request->input('category');

        $items = Item::where('price', '>=', $min)
            ->where('price', '<=', $max)
            ->where('category_id', $category)->paginate(5);

        return view("item.index", compact('items', 'categories'));

        // return $request;

    }
}
