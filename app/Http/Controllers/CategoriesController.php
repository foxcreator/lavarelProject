<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController
{
    public function index()
    {
        $categories = Category::with('products')
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->paginate(5);

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): Renderable
    {
        $products = $category->products()->paginate(5);

        return view('categories.show', compact('category', 'products'));
    }
}
