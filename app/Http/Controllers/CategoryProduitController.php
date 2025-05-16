<?php

namespace App\Http\Controllers;
use App\Models\CategoryProduit;  // Import the CategoryProduit model
use Illuminate\Http\Request;

class CategoryProduitController extends Controller
{
    // Display all categories (including soft-deleted ones)
    public function index()
    {
        $categories = CategoryProduit::withTrashed()->get();  // Fetch all categories, including soft-deleted ones
        return view('categories.index', compact('categories'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'nom' => 'required|string|max:255',  // Ensure the category name is provided
        ]);

        // Create the category
        CategoryProduit::create([
            'nom' => $request->nom,
        ]);

        // Redirect with success message
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès!');
    }

    // Show details of a specific category
    public function show(CategoryProduit $category)
    {
        return view('categories.show', compact('category'));
    }

    // Show the form to edit an existing category
    public function edit(CategoryProduit $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update an existing category
    public function update(Request $request, CategoryProduit $category)
    {
        // Validate inputs
        $request->validate([
            'nom' => 'required|string|max:255',  // Ensure the category name is provided
        ]);

        // Update the category
        $category->update([
            'nom' => $request->nom,
        ]);

        // Redirect with success message
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès!');
    }

    // Soft delete a category
    public function destroy(CategoryProduit $category)
    {
        $category->delete();  // Soft delete
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès!');
    }

    // Show archived (soft-deleted) categories
    public function archive()
{
    $categoriesSupprimees = CategoryProduit::onlyTrashed()->get(); // Fetch soft-deleted categories
    return view('categories.archive', compact('categoriesSupprimees'));
}



    // Restore a soft-deleted category
    public function restore($id)
    {
        $category = CategoryProduit::withTrashed()->findOrFail($id);  // Retrieve soft-deleted category
        $category->restore();  // Restore the category
        return redirect()->route('categories.archive')->with('success', 'Catégorie restaurée avec succès.');
    }

    // Permanently delete a category
    public function forceDelete($id)
    {
        $category = CategoryProduit::withTrashed()->findOrFail($id);  // Retrieve soft-deleted category
        $category->forceDelete();  // Permanently delete the category
        return redirect()->route('categories.archive')->with('success', 'Catégorie supprimée définitivement.');
    }

    // Display only soft-deleted categories (trashed)
    public function trashed()
    {
        $categories = CategoryProduit::onlyTrashed()->get();  // Fetch only soft-deleted categories
        return view('categories.trashed', compact('categories'));
    }
}
