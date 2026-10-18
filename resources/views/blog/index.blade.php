<x-layout>
    <x-hero.beta />

    <section class="pb-14 pt-5 bg-white dark:bg-gray-900 ">
        <div class="mx-auto max-w-screen-sm text-center">
            <p class="font-bold text-gray-500 sm:text-xl dark:text-gray-400">Download our top 15 free font picks of the month</p>
        </div>
    </section>

    <section class="pb-8 pt-8 bg-gray-100 dark:bg-gray-800">
        <div class="py-0 px-4 mx-auto max-w-screen-xl lg:py-2 lg:px-6 ">


            <div class="flex justify-between items-center mb-6">
                <h1 class="text-gray-600 dark:text-gray-300 text-xl font-bold">Published Articles</h1>
                <form method="GET" class="flex items-center gap-2">
                    <select name="sort" id="sort" onchange="this.form.submit()" class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="most-liked" {{ request('sort') == 'most-liked' ? 'selected' : '' }}>Most Liked
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-6">
                @foreach ($blogs as $blog)
                    <article
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-transform hover:scale-105">
                        @if ($blog->image_1)
                            <a href="{{ route('blog.show', $blog) }}">
                                <img src="{{ asset('storage/' . $blog->image_1) }}" alt="Blog Image"
                                    class="w-full aspect-[3/2] object-cover rounded-t-lg">
                            </a>
                        @endif
                        <div class="px-5 py-2 bg-gray-300 dark:bg-gray-900">
                            <h2 class="text-base text-center font-semibold tracking-tight text-gray-900 dark:text-white">
                                <a href="{{ route('blog.show', $blog) }}">
                                {{ Str::limit($blog->title, 25, '...') }} </a></h2>
                        </div>
                    </article>
                @endforeach
            </div>

            <div>
                <!-- Flowbite-style pagination -->
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </section>
    <x-text_info/>
</x-layout>
