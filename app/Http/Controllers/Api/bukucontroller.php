<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class bukucontroller extends Controller
{
    public function index()
    {
        $buku = Buku::paginate();

        return response()->json($buku);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);

        $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        buku::create($validatedData);

        return response()->json(['success' => 'Buku created successfully']);
    }

    public function show(Buku $buku)
    {
        return response()->json($buku);
    }

    public function update(Request $request, Buku $buku)
    {
        $validatedData = $request->validate([
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::delete('public/'.$buku->cover_image);

            $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        $buku->update($validatedData);

        return response()->json(['success' => 'buku updated successfully']);
    }

    public function destroy(Buku $buku)
    {
        Storage::delete('public/'.$buku->cover_image);

        $buku->delete();

        return response()->json(['success' => 'buku deleted successfully']);
    }
}
