<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function results(Request $request)
    {
        $query = $request->input('q');

        if(empty($query)) {
            return redirect()->back()->with('error', 'Please enter search term');
        }

        $results = Blog::query()
            ->with(['categories:id,name'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(10)
            ->appends(['q' => $query]);

        return view('search_result', [
            'results' => $results,
            'searchQuery' => $query
        ]);
    }

}
