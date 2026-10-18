<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'My Blog') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <link rel="icon" href="{{ asset('storage/images/home/formine-3.svg') }}"> {{-- favicon --}}

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    <x-navbar />

    <main class="flex-grow w-full mx-auto mt-6">
        {{-- @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif --}}

        @if (session('success'))
            {{-- Trigger Modal Otomatis --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = new Modal(document.getElementById('success-modal'));
                    modal.show();
                });
            </script>

            {{-- Modal Success --}}
            <div id="success-modal" tabindex="-1"
                class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full inset-0 h-modal sm:h-full">
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="success-modal">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-green-500 w-12 h-12" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-700 dark:text-gray-200">
                                {{ session('success') }}
                            </h3>
                            <button data-modal-hide="success-modal" type="button"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            {{-- Auto Trigger Modal --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const modal = new Modal(document.getElementById('error-modal'));
                    modal.show();
                });
            </script>

            {{-- Error Modal --}}
            <div id="error-modal" tabindex="-1"
                class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full inset-0 h-modal sm:h-full">
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="error-modal">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-red-500 w-12 h-12" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01M12 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7z" />
                            </svg>
                            <h3 class="mb-3 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                Ada beberapa kesalahan:
                            </h3>
                            <ul class="text-sm text-left text-red-600 dark:text-red-300 list-disc list-inside mb-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button data-modal-hide="error-modal" type="button"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                OK, Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }} {{-- Isi konten dari component parent-child. --}}

    </main>

    <x-footer />
</body>
</html>
