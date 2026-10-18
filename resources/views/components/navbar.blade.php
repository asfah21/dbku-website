<style>
    @keyframes triple-glow {
        0% {
            border-image: linear-gradient(90deg, #d40000, #029b02, #01019c) 1;
        }
        25% {
            border-image: linear-gradient(90deg, #da6d00, #01019c, #d40000) 1;
        }
        50% {
            border-image: linear-gradient(90deg, #029b02, #d40000, #6700b1) 1;
        }
        75% {
            border-image: linear-gradient(90deg, #01019c, #6700b1, #029b02) 1;
        }
        100% {
            border-image: linear-gradient(90deg, #d40000, #029b02, #01019c) 1;
        }
    }

    .triple-glow-border {
        border-bottom: 4px solid;
        border-image-slice: 1;
        animation: triple-glow 12s ease infinite;
    }
</style>

<nav class="bg-gray-900 fixed w-full z-20 top-0 start-0 triple-glow-border">
{{-- <nav class="bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-600"> --}}
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/images/home/formine-3.svg') }}" class="pt-1 h-10" alt="db-ku.com free downnload font">
            <span class="self-center text-2xl font-bold whitespace-nowrap text-white">DB-KU</span>
        </a>

        <div class="flex md:order-2">
            <button id="theme-toggle"
                type="button"class="text-gray-400 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-700 rounded-lg text-sm p-1 mr-2">
                <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>

            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                aria-expanded="false"
                class="md:hidden text-gray-400 hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>

            {{-- <div class="relative hidden md:block">
                <form action="{{ route('search.results') }}" method="GET">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="q"
                        id="search-navbar"
                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search..."
                        required
                        x-on:keydown.enter="$event.target.form.submit()">
                </form>
            </div> --}}

            <div class="relative hidden md:block" x-data="{ searchQuery: '' }">
                <form action="{{ route('search.results') }}" method="GET" class="flex items-center">
                    <button type="submit"
                            class="absolute inset-y-0 start-0 flex items-center ps-3 cursor-pointer"
                            :disabled="!searchQuery.trim()">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>
                    <input
                        type="text"
                        name="q"
                        id="search-navbar"
                        x-model="searchQuery"
                        class="block w-full p-2 ps-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..."
                        required
                        x-on:keydown.enter="$event.target.form.submit()">
                </form>
            </div>

            <button data-collapse-toggle="navbar-search" type="button"
                class="inline-flex items-center mt-0.5 p-1 w-9 h-9 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-search" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <div class=" mt-[1px] ml-4 flex items-center space-x-4 relative hidden md:block">

                @auth
                    <div data-popover-target="popover-user-profile">
                        {{-- <a href="{{ route('profile') }}" class="text-blue-600 hover:underline"> --}}
                        <a href="#" class="text-blue-600 hover:underline">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover">
                        </a>
                    </div>

                    <div data-popover id="popover-user-profile" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                        <div class="p-3">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                    <span>{{ Auth::user()->name }}</span>
                                </p>
                                <div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        {{-- <button type="submit" class="text-red-600 hover:underline">Logout</button> --}}
                                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            Logout
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <p class="mt-3 text-sm font-bold leading-none">
                                <a href="{{ route('profile') }}" class="text-blue-400 hover:underline pl-2">Profile</a>
                            </p>
                            <p class="mt-2 text-sm font-bold leading-none">
                                <a href="{{ route('auth.posts') }}" class="text-blue-400 hover:underline pl-2">My Posts</a>
                            </p>
                            <p class="mb-4 mt-2 text-sm font-bold leading-none">
                                <a href="{{ route('auth.cattag') }}" class="text-blue-400 hover:underline pl-2">Categ-Tag</a>
                            </p>

                            <ul class="flex text-sm">
                                <li class="me-2">
                                    <a href="#" class="hover:underline">
                                        <span class="font-semibold text-gray-900 dark:text-white">799</span>
                                        <span>Articles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline">
                                        <span class="font-semibold text-gray-900 dark:text-white">3,758</span>
                                        <span>Likes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                @else
                    <button class="inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white text-white focus:ring-4 focus:outline-none focus:ring-cyan-800">
                        <span class="relative px-3 py-1.5 transition-all ease-in duration-75 bg-gray-900 rounded-md group-hover:bg-transparent">
                            <a href="{{ route('login') }}">Sign In</a>
                        </span>
                    </button>

                @endauth
            </div>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
            <!-- Untuk mobile version -->
            <div class="relative mt-3 md:hidden">
                <form action="{{ route('search.results') }}" method="GET" class="flex items-center">
                    <button type="submit"
                            class="absolute inset-y-0 start-0 flex items-center ps-3 cursor-pointer">
                        <svg class="w-4 h-4 text-gray-400 hover:text-gray-300"
                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>
                    <input
                        type="text"
                        name="q"
                        id="search-navbar-mobile"
                        class="block w-full p-2 ps-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search..."
                        required
                        x-on:keydown.enter="$event.target.form.submit()">
                </form>
            </div>

            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-gray-800 md:bg-gray-900 border-gray-700">
                <li>
                    {{-- <a href="{{route('home')}}"
                        class="block py-2 px-3 rounded-sm md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                        </svg>
                        Home
                    </a> --}}
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-1   whitespace-nowrap py-2 px-3 rounded-sm md:p-0 text-white hover:bg-gray-700 hover:text-blue-500 md:hover:bg-transparent border-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5 text-inherit" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                        </svg>
                        Home
                    </a>

                </li>
                {{-- <li>
                    <a href="#"
                        class="block py-2 px-3 rounded-sm md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">About</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 rounded-sm md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Services</a>
                </li> --}}

                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">

                <div class=" flex flex-wrap md:hidden block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                    @auth
                    <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                    <span class="ml-2 pt-1">{{ Auth::user()->name }}</span>
                    @else
                        <p class="text-gray-500">Join for free, or log in if you already have an account</p>
                    @endauth
                </div>

                <div class="flex flex-wrap md:hidden block py-3 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                    @auth
                    <a href="{{ route('profile') }}" class="text-xs py-1 border rounded-md border-gray-400 dark:border-gray-600 px-1 block text-blue-600 hover:underline">Profile</a>
                    <a href="{{ route('auth.posts') }}" class="text-xs py-1 ml-2 border rounded-md border-gray-400 dark:border-gray-600 px-1 block text-blue-600 hover:underline">My Post</a>
                    <a href="{{ route('auth.cattag') }}" class="text-xs py-1 ml-2 border rounded-md border-gray-400 dark:border-gray-600 px-1 block text-blue-600 hover:underline">Categ-Tag</a>

                    @else
                        <div hidden><a href="{{ route('login') }}" class="flex flex-col text-blue-600 hover:underline">Login</a></div>
                    @endauth
                </div>

                <div class="flex flex-wrap md:hidden block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                    @auth
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="border border-red-700 px-1 rounded-md bg-red-700 hover:underline">Logout</button>
                    </form>

                    @else
                        <a href="{{ route('login') }}" class="border border-green-700 py-1 px-2 rounded-md bg-green-700 hover:underline">Sign In</a>
                        <a href="{{ route('register') }}" class="ml-3 border border-blue-700 py-1 px-2 rounded-md bg-blue-700 hover:underline">Sign Up</a>
                    @endauth
                </div>
            </ul>

        </div>

    </div>

</nav>

<script src="//unpkg.com/alpinejs" defer></script>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');

    // Initialize theme based on localStorage or system preference
    const rootElement = document.documentElement;
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        rootElement.classList.add('dark');
        darkIcon.style.display = 'block';
        lightIcon.style.display = 'none';
    } else {
        rootElement.classList.remove('dark');
        darkIcon.style.display = 'none';
        lightIcon.style.display = 'block';
    }

    // Toggle tema dan icon
    themeToggleBtn.addEventListener('click', () => {
        if (rootElement.classList.contains('dark')) {
            rootElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
            darkIcon.style.display = 'none';
            lightIcon.style.display = 'block';
        } else {
            rootElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
            darkIcon.style.display = 'block';
            lightIcon.style.display = 'none';
        }
    });
</script>
