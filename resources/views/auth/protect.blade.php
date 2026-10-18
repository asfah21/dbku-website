<x-layout>
{{-- <form method="POST" action="{{ route('login.register.auth.submit') }}">
    @csrf
    <div>
        <label>Password Akses Login/Register</label>
        <input type="password" name="password" required class="border p-2">
    </div>
    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Masuk</button>

    @if(session('error'))
        <p class="text-red-500 mt-2">{{ session('error') }}</p>
    @endif
</form> --}}

<section class="min-h-screen bg-white dark:bg-gray-900 md:pt-0">
    {{-- <div class="md:!pt-28"> --}}
    <div class="flex flex-col items-center justify-center pt-28 px-6 py-2 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-bold text-gray-900 dark:text-white">

            <img class="w-8 h-8 mr-2" src="{{ asset('storage/images/home/formine-3.svg') }}" alt="logo">
            Authentification
        </a>
        <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
            <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-l dark:text-white text-center">
                Masukkan Password untuk mengakses halaman ini
            </h2>

            <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{ route('login.register.auth.submit') }}" method="POST">
                @csrf
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                </div>

                <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
            </form>
            @if (session('error'))
                <p style="color: red; text-align:center; padding-top: 13px;">{{ session('error') }}</p>
            @endif
        </div>
    </div>
  </section>

</x-layout>
