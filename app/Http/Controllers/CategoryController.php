<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Prikaz kategorija
    public function index()
    {
        $categories = Category::all(); // Uzmi sve kategorije iz baze
        return view('categories.index', compact('categories'));
    }

    // Kreiraj novu kategoriju
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_cat' => 'required|string|max:255',
        ]);


        Category::create([
            'vehicle_cat' => $request->vehicle_cat,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Brisanje kategorije
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    // Prikaz forme za izmenu kategorije
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Ažuriranje kategorije
    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_cat' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'vehicle_cat' => $request->vehicle_cat,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
}
