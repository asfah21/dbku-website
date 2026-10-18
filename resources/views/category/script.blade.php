@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-2">
            Category : <span class="text-blue-600">
                {{-- {{ $category->name }} --}}
                {{ Str::of($category->name)->replace('-', ' ')->replace('&', ' & ')->title() }}
            </span>
        </h1>
        <div class="mb-8 sm:text-xs text-gray-600 dark:text-gray-400">
            {{ $blogs->total() }} articles found
        </div>

        @if($blogs->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-6">
            {{-- <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3"> --}}
                @foreach($blogs as $blog)
                    <article class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
                        <a href="{{ route('blog.show', $blog) }}">
                            <img src="{{ $blog->image_1 ? asset('storage/'.$blog->image_1) : asset('images/default-blog.jpg') }}"
                                 class="w-full h-48 object-cover" alt="{{ $blog->title }}">
                        </a>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($blog->categories as $cat)
                                    <a
                                       class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 hover:bg-blue-200 dark:hover:bg-blue-800">
                                        {{ Str::of($cat->name)->replace('-', ' ')->replace('&', ' & ')->title() }}
                                    </a>
                                @endforeach
                            </div>
                            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-2">
                                <a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a>
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ Str::limit(strip_tags($blog->description), 70) }}
                            </p>
                            {{-- <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('blog.show', $blog->id) }}"
                                   class="text-base text-blue-600 dark:text-blue-400 hover:underline">
                                    Read more →
                                </a>
                                <span class="text-sm text-gray-500">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </span>
                            </div> --}}
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No articles in this category</h3>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Check back later or browse other categories</p>
            </div>
        @endif
    </div>
</div>
@endsection
