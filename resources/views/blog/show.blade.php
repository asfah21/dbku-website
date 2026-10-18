<x-layout>

    <style>
        /* Hide scrollbar but keep functionality */
        #blogCarousel {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #blogCarousel::-webkit-scrollbar {
            display: none;
        }

        /* Button visibility enhancement */
        .group:hover .absolute {
            opacity: 1;
        }
    </style>

    <section aria-labelledby="article-title" class="pt-8 pb-8 lg:pt-16 lg:pb-10 bg-white dark:bg-gray-900 antialiased">
        <x-tabs />
        <div class="flex justify-between gap-12 px-4 mx-auto max-w-screen-xl ">
            <article
                class="w-full mx-auto max-w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">

                <header class="mb-4 lg:mb-10 not-format">
                    <h1
                        class="mb-4 text-center text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $blog->title }}
                    </h1>
                </header>

                {{-- Iklan, widget, artikel terkait, dsb --}}

                <div class="w-full max-w-[728px] mx-auto sticky top-20 space-y-4 z-[10]">
                    <div class="bg-gray-100 dark:bg-gray-800 shadow h-[90px] flex items-center justify-center">
                        <a href="https://www.creativefabrica.com/freebies/free-fonts/ref/1596263/"
                            title="Font Banner - Free Fonts">
                            <img src="https://www.creativefabrica.com/wp-content/uploads/2018/01/freebie-banners4-neon-06.png"
                                alt="Font Banner - Free Fonts" />
                        </a>
                    </div>
                </div>

                <div class="mx-auto w-full max-w-[780px] relative group">
                    @if ($blog->image_1 || $blog->image_2 || $blog->image_3)
                        <div class="relative overflow-hidden rounded-lg">
                            <!-- Carousel Container -->
                            <div class="flex snap-x snap-mandatory scroll-smooth overflow-x-auto" id="blogCarousel">
                                @if ($blog->image_1)
                                    <figure class="min-w-full snap-start">
                                        <img src="{{ asset('storage/' . $blog->image_1) }}" alt="Blog Image 1"
                                            class="w-full aspect-[3/2] object-cover rounded-lg" loading="lazy">
                                    </figure>
                                @endif

                                @if ($blog->image_2)
                                    <figure class="min-w-full snap-start">
                                        <img src="{{ asset('storage/' . $blog->image_2) }}" alt="Blog Image 2"
                                            class="w-full aspect-[3/2] object-cover rounded-lg" loading="lazy">
                                    </figure>
                                @endif

                                @if ($blog->image_3)
                                    <figure class="min-w-full snap-start">
                                        <img src="{{ asset('storage/' . $blog->image_3) }}" alt="Blog Image 3"
                                            class="w-full aspect-[3/2] object-cover rounded-lg" loading="lazy">
                                    </figure>
                                @endif
                            </div>

                            <!-- Navigation Buttons - Always Visible -->
                            <button onclick="scrollCarousel(-1)"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 text-gray-800 rounded-full p-2 transition-all duration-300 shadow-lg hover:bg-white hover:scale-110 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button onclick="scrollCarousel(1)"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 text-gray-800 rounded-full p-2 transition-all duration-300 shadow-lg hover:bg-white hover:scale-110 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Indicators -->
                            <div class="flex justify-center gap-2 mb-2">
                                @foreach (['image_1', 'image_2', 'image_3'] as $index => $image)
                                    @if ($blog->$image)
                                        <button onclick="goToSlide({{ $index }})"
                                            class="w-4 h-2 rounded-full bg-gray-300 indicator-dot hover:bg-gray-400 transition-colors duration-200"></button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <section class="mx-auto w-full max-w-[1100px] p-4 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kolom kiri -->
                        <div class="bg-gray-100 dark:bg-gray-800 p-4 md:p-6 rounded-2xl">
                            <div class="mt-1 lg:mt-1 not-format">

                                <address
                                    class="pb-2 flex flex-col md:flex-row justify-center md:justify-between md:items-center gap-3 mb-2 not-italic text-center md:text-left">
                                    <!-- Teks Download -->
                                    <div
                                        class="inline-flex items-center font-black text-lg text-gray-900 dark:text-white justify-center md:justify-start w-full">
                                        <p>DOWNLOAD FOR FREE</p>
                                    </div>
                                    <!-- Tombol Download -->
                                    <a href="{{ $blog->font_file }}" target="_blank"
                                        class="whitespace-nowrap inline-flex justify-center items-center px-4 py-3 text-base font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-6 h-6 mr-2 -ml-1 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        DOWNLOAD FONT
                                    </a>
                                </address>


                                <div class="font-semibold text-justify">
                                    <p>
                                        Download {{ $blog->title }} for free - it includes a commercial license.
                                        You can use this font for personal and commercial projects without any time
                                        limit.
                                    </p>
                                    <p class="my-3 font-bold underline text-gray-900 dark:text-white"> GET THIS FONT FOR
                                        FREE </p>
                                    <p>
                                        Every download will come with a full business license.
                                        Take Advantage of Premium Support Get unlimited downloads and professional
                                        technical support.
                                    </p>
                                    {{-- <p class="text-sm text-gray-600">
                                        Category:
                                        @forelse($blog->categories as $category)
                                            <a href="/category/{{ $category->slug }}" class="hover:text-blue-500">
                                                {{ $category->name }}@if (!$loop->last), @endif
                                            </a>
                                        @empty
                                            <span>Uncategorized</span>
                                        @endforelse
                                    </p> --}}
                                    <div class="py-4 flex flex-wrap gap-2 mt-2">
                                        @foreach ($blog->categories as $category)
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="border border-gray-300 dark:border-gray-700 px-4 md:px-6 rounded-2xl">
                            <h5 class="pt-6 mt-2 font-black uppercase text-gray-900 dark:text-white">More About This
                                Post</h5>
                            <p class="text-lg text-justify font-semibold">
                                {!! nl2br(e($blog->description)) !!}<br><br>website: https://db-ku.com
                            </p>
                        </div>

                    </div>
                </section>

                <section class="mx-auto w-full max-w-[1100px] p-4 md:px-8 py-2">
                    <div class="bg-gray-100 dark:bg-gray-800 p-2 md:p-4 rounded-2xl mt-2">
                        <div class="mt-1 lg:mt-2 not-format">
                            <address class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center mb-2 not-italic">
                                <!-- Kolom kiri: info user -->
                                <div class="px-2 inline-flex items-center text-sm text-gray-900 dark:text-white">
                                    <img class="mr-4 w-12 h-12 rounded-full object-cover"
                                        src="{{ $blog->user->avatar_url }}" alt="{{ $blog->user->name }}">
                                    <div>
                                        <a href="#" rel="author"
                                            class="text-xl font-bold text-gray-900 dark:text-white">{{ $blog->user->name }}</a>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            <time pubdate datetime="{{ $blog->created_at->toDateString() }}"
                                                title="published date">
                                                Published on {{ $blog->created_at->format('M. d, Y') }}
                                            </time>
                                        </p>
                                    </div>
                                </div>

                                <!-- Kolom kanan: disclaimer -->
                                <p class="px-2 text-xs text-justify text-gray-700 dark:text-gray-400">
                                    This site includes affiliate links. Some content is provided by third-party sources.
                                    Using these links may modestly support our work at no additional cost to you.
                                </p>
                            </address>

                        </div>
                    </div>
                </section>

            </article>
        </div>
    </section>

    <aside aria-label="Related articles" class="py-8 lg:py-16 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            {{-- <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>

            @if ($relatedBlogs->isNotEmpty())
                <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($relatedBlogs as $related)
                        <article class="max-w-xs">
                            <a href="{{ route('blog.show', $related->id) }}">
                                <img src="{{ $related->image_1 ? asset('storage/'.$related->image_1) : asset('images/default-blog.jpg') }}"
                                    class="mb-5 rounded-lg h-48 w-full object-cover" alt="{{ $related->title }}">
                            </a>

                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($related->categories as $category)
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            <h3 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                <a href="{{ route('blog.show', $related->id) }}">{{ $related->title }}</a>
                            </h3>
                            <a href="{{ route('blog.show', $related->id) }}"
                                class="inline-flex items-center text-primary-600 hover:underline">
                                Read more
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No related articles found</p>
            @endif --}}
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>

            @if ($relatedBlogs->isNotEmpty())
                <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($relatedBlogs as $related)
                        <article class="max-w-xs">
                            <a href="{{ route('blog.show', $related->slug) }}">
                                <img src="{{ $related->image_1 ? asset('storage/' . $related->image_1) : asset('images/default-blog.jpg') }}"
                                    class="mb-5 rounded-lg h-48 w-full object-cover" alt="{{ $related->title }}">
                            </a>

                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($related->categories as $category)
                                    <a href="{{ route('category.show', $category->name) }}"
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                        {{-- {{ $category->name }} --}}
                                        {{ Str::of($category->name)->replace('-', ' ')->replace('&', ' & ')->title() }}
                                    </a>
                                @endforeach
                            </div>

                            <h3 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                            </h3>
                            {{-- <a href="{{ route('blog.show', $related->id) }}"
                                class="inline-flex items-center text-primary-600 hover:underline">
                                Read more
                            </a> --}}
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No related articles found</p>
            @endif
        </div>
    </aside>

    <x-subscribe />

    <script>
        // Enhanced carousel functionality
        const carousel = document.getElementById('blogCarousel');
        let currentIndex = 0;

        function scrollCarousel(direction) {
            currentIndex = Math.max(0, Math.min(currentIndex + direction, carousel.children.length - 1));
            goToSlide(currentIndex);
        }

        function goToSlide(index) {
            currentIndex = index;
            const slideWidth = carousel.clientWidth;
            carousel.scrollTo({
                left: slideWidth * index,
                behavior: 'smooth'
            });
            updateIndicators();
        }

        function updateIndicators() {
            const dots = document.querySelectorAll('.indicator-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-gray-600', index === currentIndex);
                dot.classList.toggle('bg-gray-300', index !== currentIndex);
            });
        }

        // Auto-update indicators on scroll
        carousel.addEventListener('scroll', function() {
            currentIndex = Math.round(carousel.scrollLeft / carousel.clientWidth);
            updateIndicators();
        });

        // Initialize
        updateIndicators();
    </script>

</x-layout>
