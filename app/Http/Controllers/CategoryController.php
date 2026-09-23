<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private array $categories = [
        ['id' => 1, 'nama_kategori' => 'Fiksi', 'deskripsi' => 'Buku cerita rekaan seperti novel dan kumpulan cerpen.'],
        ['id' => 2, 'nama_kategori' => 'Teknologi', 'deskripsi' => 'Buku seputar teknologi, pemrograman, dan ilmu komputer.'],
        ['id' => 3, 'nama_kategori' => 'Sejarah', 'deskripsi' => 'Buku bertema sejarah dan biografi tokoh.'],
    ];

    public function index()
    {
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);
        return redirect()->route('categories.index')
            ->with('success', "Kategori \"{$validated['nama_kategori']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        $category->update($validate);
        return redirect()->route('categories.index')->with('success', "Kategori \"{$validate['nama_kategori']}\" berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
