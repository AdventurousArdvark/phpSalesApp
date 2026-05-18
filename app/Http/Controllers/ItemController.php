<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller{

    public function index(){
        $query = Item::query();

        if (request('search')) {
            $query->search(request('search'));
        }

        $items = $query->orderBy('name')->paginate(15);

        return view('items.index', compact('items'));
    }

    public function create(){
        return view('items.create');
    }

    public function store(StoreItemRequest $request){
        Item::create($request->validated());

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    public function show(Item $item){
        return view('items.show', compact('item'));
    }

    public function edit(Item $item){
        return view('items.edit', compact('item'));
    }

    public function update(UpdateItemRequest $request, Item $item){
        $item->update($request->validated());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item){
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}