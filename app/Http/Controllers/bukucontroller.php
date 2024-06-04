<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class bukucontroller extends Controller
{
    public function index()
    {
        $bukus = Buku::paginate(10);

        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
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

        return to_route('buku.index')->with('success', 'Buku created successfully');
    }

    public function show(Buku $bukus)
    {
        return view('buku.show', compact('bukus'));
    }

    public function edit($bukus)
    {
        return view('buku.edit', compact('bukus'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);

        $bukus = Buku::find($id);

        if ($request->hasFile('cover_image')) {
            Storage::delete($bukus->cover_image);

            $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        $bukus->update($validatedData);

        return to_route('buku.index')->with('success', 'Buku updated successfully');
    }

    public function destroy($id)
    {
        $bukus = Buku::find($id);

        Storage::delete('public/'.$bukus->cover_image);

        $bukus->delete();

        return to_route('buku.index')->with('success', 'Buku deleted successfully');
    }
}
