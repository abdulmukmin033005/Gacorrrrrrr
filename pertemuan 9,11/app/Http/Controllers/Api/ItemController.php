<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Daftar semua barang barter beserta pemiliknya
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Item::with('user:id,name')->latest()->get(),
        ]);
    }

    // Menawarkan barang baru (pemilik = user dari token)
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'barang_dicari' => 'required|string|max:255',
        ]);

        $item = auth('api')->user()->items()->create($data);

        return response()->json(['data' => $item], 201);
    }

    // Detail satu barang
    public function show($id): JsonResponse
    {
        return response()->json([
            'data' => Item::with('user:id,name')->findOrFail($id),
        ]);
    }

    // Mengubah barang (hanya pemilik)
    public function update(Request $request, $id): JsonResponse
    {
        $item = Item::findOrFail($id);

        if ($item->user_id !== auth('api')->id()) {
            return response()->json(['message' => 'Bukan barang milik Anda'], 403);
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'barang_dicari' => 'required|string|max:255',
            'status' => 'in:open,traded',
        ]);

        $item->update($data);

        return response()->json(['data' => $item]);
    }

    // Menghapus barang (hanya pemilik)
    public function destroy($id): JsonResponse
    {
        $item = Item::findOrFail($id);

        if ($item->user_id !== auth('api')->id()) {
            return response()->json(['message' => 'Bukan barang milik Anda'], 403);
        }

        $item->delete();

        return response()->json(['message' => 'Barang dihapus']);
    }
}