<?php

namespace App\Http\Controllers\API;

use App\Models\ClothingItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClothingItemController extends Controller
{
    public function index()
    {
        return ClothingItem::where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $item = ClothingItem::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->json($item, 201);
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'category' => 'sometimes|string',
            'description' => 'nullable|string',
        ]);

        $clothingItem->update($request->only(['name', 'category', 'description']));

        return response()->json($clothingItem);
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $clothingItem->delete();
        return response()->json(null, 204);
    }
}