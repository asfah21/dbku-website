<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request) {
        $sort = $request->get('sort', 'latest');

        $query = Blog::with('likes')->where('status', 'published');

        if ($sort === 'most-liked') {
            $query->withCount('likes')->orderByDesc('likes_count');
        } else {
            $query->latest();
        }

        $blogs = $query->paginate(36)->withQueryString(); // <- 6 blog per halaman

        return view('blog.index', compact('blogs', 'sort'));
    }


    public function showx(Blog $blog) {
        $blog->load('comments.user', 'tags', 'categories');
        return view('blog.show', compact('blog'));
    }

    public function show(Blog $blog)
    {
        $blog->load('comments.user', 'tags', 'categories');

        // $category = $blog->categories->first();

        $relatedBlogs = Blog::whereHas('categories', function($query) use ($blog) {
                $query->whereIn('categories.id', $blog->categories->pluck('id')); // Specify table
            })
            ->where('blogs.id', '!=', $blog->id) // Specify table
            ->with(['categories' => function($query) {
                $query->select('categories.id', 'categories.name'); // Specify table
            }])
            ->select('blogs.id', 'blogs.slug' ,'blogs.title', 'blogs.image_1', 'blogs.description', 'blogs.created_at')
            ->latest('blogs.created_at')
            ->limit(4)
            ->get();

        // return view('blog.show', compact('blog', 'relatedBlogs', 'category'));

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }

    public function create() {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request) {
        $request->validate([
            // 'title' => 'required|string|max:255',
            'title' => 'required|unique:blogs',
            'description' => 'required',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
            'font_file' => 'nullable|file|mimes:zip',
            'status' => 'nullable|in:draft,published',
        ]);

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->description = $request->description;

        // Upload images
        foreach (['image_1', 'image_2', 'image_3'] as $field) {
            if ($request->hasFile($field)) {
                $blog->$field = $request->file($field)->store('images', 'public');
            }
        }

        // Upload font zip
        if ($request->hasFile('font_file')) {
            $blog->font_file = $request->file('font_file')->store('font', 'public');
        }

        $blog->status = $request->status ?? 'draft';

        $blog->save();

        $blog->categories()->attach($request->categories);
        $blog->tags()->attach($request->tags);

        // return redirect()->route('home')->with('success', 'Blog created!');
        return redirect()->route('auth.posts')->with('success', 'Blog created!');
    }

    public function like(Blog $blog)
    {
        if (!auth()->check()) return redirect()->route('login');

        $user = auth()->user();

        if (!$blog->likedBy($user)) {
            $blog->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function myPosts()
    {
        // $blogs = auth()->user()->blogs()->latest()->get();
        $blogs = User::findOrFail(auth()->id())->blogs()->latest()->get();

        return view('auth.post', compact('blogs'));
    }

    public function destroy($id)
    {
        // Temukan blog berdasarkan ID
        $blog = Blog::findOrFail($id);

        // Hapus blog
        $blog->delete();

        // Redirect atau kembalikan respons
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
    }

    // public function myCattag()
    // {
    //     return view('auth.cattag');
    // }

    public function myCattag()
    {
        $categories = Category::latest()->get();
        return view('auth.cattag', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        // Create the category with name only
        Category::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('auth.cattag')
            ->with('success', 'Category created successfully!');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }




}

