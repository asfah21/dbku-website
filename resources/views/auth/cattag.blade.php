<x-layout>

    <section class="pb-8 pt-20 md:pt-10 md:pb-4 bg-white dark:bg-gray-900">
        <div class="py-0 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Create Category</h1>

                <!-- Create Category Form -->
                <form method="POST" action="{{ route('auth.cattag') }}" class="space-y-6">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="e.g., Technology"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            Create Category
                        </button>
                    </div>
                </form>
                <hr class="mt-6 mb-1">
                <hr class="mb-4">

                <!-- Existing Categories Section -->
                <div class="mb-8">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Existing Categories</h2>

                    @if($categories->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">No categories yet.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($categories as $category)
                                <div class="flex items-center justify-between px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                    <span class="text-sm text-gray-800 dark:text-gray-200">{{ $category->name }}</span>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 dark:hover:text-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            <script>
                // Update color hex value display
                document.getElementById('color').addEventListener('input', function(e) {
                    document.getElementById('colorValue').textContent = e.target.value;
                });
            </script>

        </div>
    </section>
</x-layout>
