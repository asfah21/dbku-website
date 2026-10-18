<x-layout>

    <section class="pb-8 bg-white dark:bg-gray-900">
        <div class="py-10 px-4 mx-auto mx-full max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="max-w-screen-xl items-center justify-between mx-auto p-4">
                <h2 class="pt-2 font-bold text-2xl mb-12 text-gray-900 dark:text-white">My Posts</h2>
                <a href="{{ route('blog.create') }}" class="text-white font-semibold hover:bg-blue-700 bg-blue-900 px-2.5 py-1.5 rounded-lg ">Create New Post</a>

                <div class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-6">
                    @foreach ($blogs as $blog)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                            <div class="flex flex-col md:flex-row gap-4 items-start">
                                @if ($blog->image_1)
                                    <div class="md:w-1/3 w-full">
                                        <a href="{{ route('blog.show', $blog) }}">
                                            <img src="{{ asset('storage/' . $blog->image_1) }}" alt="Blog Image"
                                                class="w-full aspect-[3/2] object-cover rounded-lg">
                                        </a>
                                    </div>
                                @endif

                                <div class="md:w-2/3 w-full">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $blog->title }}</h3>
                                    <p class="pt-2 text-xs text-gray-500 dark:text-gray-300">
                                        <span
                                            class="bg-green-600 text-xs text-white px-2 italic rounded">{{ ucfirst($blog->status) }}</span>
                                        &nbsp;- Created at {{ $blog->created_at->format('M. d, Y') }}
                                    </p>
                                    <p class="text-gray-900 dark:text-gray-300 mt-2 text-xs">{{ Str::limit($blog->description, 132, '...') }}</p>

                                    <div class="flex gap-2 mt-2">
                                        <form action="{{ route('blog.destroy', $blog) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-500 text-sm font-semibold text-white px-3 py-0 rounded">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

</x-layout>
