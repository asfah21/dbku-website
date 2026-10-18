<x-layout>

    <section class="pb-8 pt-20 md:pt-10 md:pb-4 bg-white dark:bg-gray-900">
        <div class="py-0 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

            {{-- <div class="max-w-screen-xl items-center justify-between mx-auto p-4">
                <h1 class="pt-28 text-2xl font-bold mb-4">Edit Profile</h1>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="avatar" class="block font-semibold">Upload Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="border p-2 w-full">
                    </div>

                    <div>
                        <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover mt-2">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                </form>
            </div> --}}

            <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Edit Profile</h1>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Avatar Upload Section -->
                    <div class="space-y-4">
                        <div>
                            <label for="avatar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile
                                Picture</label>
                            <div class="flex items-center space-x-6">
                                <!-- Current Avatar -->
                                <div class="shrink-0">
                                    <img id="avatarPreview" class="w-20 h-20 rounded-full object-cover shadow-sm"
                                        src="{{ $user->avatar_url }}" alt="Current avatar">
                                </div>

                                <!-- Upload Button -->
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" name="avatar" id="avatar" accept="image/*"
                                        class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100
                                            dark:file:bg-gray-700 dark:file:text-gray-300
                                            dark:hover:file:bg-gray-600"
                                        onchange="document.getElementById('avatarPreview').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, GIF or PNG. Max 2MB.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</x-layout>
