<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($name)
    {
        // Cari kategori berdasarkan name (tanpa case sensitive)
        $category = Category::where('name', $name)->firstOrFail();

        $blogs = $category->blogs()
            ->with(['categories:id,name', 'user:id,name'])
            ->latest()
            ->paginate(12);

        return view('category.script', ['category' => $category,'blogs' => $blogs
        ]);
    }

    // public function show($name)
    // {
    //     // Convert URL name (kebab-case) ke format readable
    //     $formattedName = Str::of($name)->replace('-', ' ')->title();

    //     // Cari kategori berdasarkan name tanpa case sensitive
    //     $category = Category::whereRaw('LOWER(name) = ?', [strtolower($formattedName)])
    //         ->firstOrFail();

    //     $blogs = $category->blogs()
    //         ->with(['categories:id,name', 'user:id,name'])
    //         ->latest()
    //         ->paginate(12);

    //     return view('category.script', [
    //         'category' => $category,
    //         'blogs' => $blogs
    //     ]);
    // }

}
