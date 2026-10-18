<x-layout>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-16 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Post</h2>
            <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type blog title" required="">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Images (Max 3)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (MAX. 3 images)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="images[]" multiple accept="image/*" class="hidden" />
                            </label>
                        </div>

                        <!-- Hidden inputs for image files will be added here by JavaScript -->
                        <div id="hidden-inputs-container"></div>

                        <!-- Image Previews -->
                        <div id="image-previews" class="grid grid-cols-3 gap-4 mt-4 hidden">
                            <!-- Preview containers will be added here by JavaScript -->
                        </div>
                    </div>

                    <!-- Font Upload -->
                    <div class="sm:col-span-2">

                        <label for="font_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Font (ZIP)</label>
                        <input type="file" id="font_file" name="font_file"
                            class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            accept=".zip,.ZIP">

                        <!-- Font Preview -->
                        <div id="font-preview" class="mt-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg hidden">
                            <p class="text-sm text-gray-700 dark:text-gray-300">Font preview will appear here</p>
                            <p id="font-sample" class="text-lg mt-2" style="font-family: 'Sample Font', sans-serif;"></p>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div>
                        <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
                        <select id="categories" name="categories[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                        <select id="tags" name="tags[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>



                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Create Post
                </button>
            </form>
        </div>
    </section>

    {{-- <div class="max-w-2xl mx-auto p-4 pt-28">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Create Blog</h2>
        <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter blog title">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description" rows="6" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your blog content here"></textarea>
            </div>

            <!-- Image Upload with Drag & Drop -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Images (Max 3)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (MAX. 3 images)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="images[]" multiple accept="image/*" class="hidden" />
                    </label>
                </div>

                <!-- Hidden inputs for image files will be added here by JavaScript -->
                <div id="hidden-inputs-container"></div>

                <!-- Image Previews -->
                <div id="image-previews" class="grid grid-cols-3 gap-4 mt-4 hidden">
                    <!-- Preview containers will be added here by JavaScript -->
                </div>
            </div>

            <!-- Font Upload -->
            <div>
                <label for="font_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Font (ZIP)</label>
                <input type="file" id="font_file" name="font_file"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    accept=".zip,.ZIP">

                <!-- Font Preview -->
                <div id="font-preview" class="mt-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg hidden">
                    <p class="text-sm text-gray-700 dark:text-gray-300">Font preview will appear here</p>
                    <p id="font-sample" class="text-lg mt-2" style="font-family: 'Sample Font', sans-serif;"></p>
                </div>
            </div>

            <!-- Categories -->
            <div>
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
                <select id="categories" name="categories[]" multiple
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tags -->
            <div>
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
                <select id="tags" name="tags[]" multiple
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Create Blog
            </button>
        </form>
    </div> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload handling
            const dropzone = document.getElementById('dropzone-file');
            const previewContainer = document.getElementById('image-previews');
            const hiddenInputsContainer = document.getElementById('hidden-inputs-container');

            // Store files for later submission
            let uploadedFiles = [];

            dropzone.addEventListener('change', function(e) {
                // Combine existing files with new files (up to 3 total)
                const newFiles = Array.from(e.target.files);
                const remainingSlots = 3 - uploadedFiles.length;

                if (remainingSlots > 0) {
                    const filesToAdd = newFiles.slice(0, remainingSlots);
                    uploadedFiles = [...uploadedFiles, ...filesToAdd];
                    handleFiles(uploadedFiles);
                }

                // Reset the input value to allow selecting the same file again
                e.target.value = '';
            });

            function handleFiles(files) {
                // Clear previous previews and inputs
                previewContainer.innerHTML = '';
                hiddenInputsContainer.innerHTML = '';

                if (files.length > 0) {
                    previewContainer.classList.remove('hidden');

                    files.forEach((file, index) => {
                        if (file.type.match('image.*')) {
                            // Create preview
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = document.createElement('div');
                                preview.className = 'relative';
                                preview.innerHTML = `
                                    <img src="${e.target.result}" class="h-32 w-full object-cover rounded-lg" alt="Preview">
                                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center" data-index="${index}">
                                        ×
                                    </button>
                                    <span class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">image_${index + 1}</span>
                                `;
                                previewContainer.appendChild(preview);

                                // Add remove button functionality
                                preview.querySelector('button').addEventListener('click', function() {
                                    const index = parseInt(this.getAttribute('data-index'));
                                    removeFile(index);
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    // Create hidden inputs for form submission
                    createHiddenInputs();
                } else {
                    previewContainer.classList.add('hidden');
                }
            }

            function createHiddenInputs() {
                hiddenInputsContainer.innerHTML = '';
                uploadedFiles.forEach((file, index) => {
                    // Create a new File object with the same properties
                    const newFile = new File([file], file.name, {
                        type: file.type,
                        lastModified: file.lastModified
                    });

                    // Create a DataTransfer object to store the file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(newFile);

                    // Create a file input for this specific file
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.name = `image_${index + 1}`;
                    fileInput.files = dataTransfer.files;
                    fileInput.style.display = 'none';

                    hiddenInputsContainer.appendChild(fileInput);
                });
            }

            // Drag and drop functionality
            const dropArea = dropzone.parentElement;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-gray-600');
            }

            function unhighlight() {
                dropArea.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-gray-600');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const newFiles = Array.from(dt.files);
                const remainingSlots = 3 - uploadedFiles.length;

                if (remainingSlots > 0) {
                    const filesToAdd = newFiles.slice(0, remainingSlots);
                    uploadedFiles = [...uploadedFiles, ...filesToAdd];
                    handleFiles(uploadedFiles);
                }
            }

            function removeFile(index) {
                uploadedFiles.splice(index, 1);
                handleFiles(uploadedFiles);
            }

            // Font preview handling
            const fontInput = document.getElementById('font_file');
            const fontPreview = document.getElementById('font-preview');
            const fontSample = document.getElementById('font-sample');

            fontInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    fontPreview.classList.remove('hidden');
                    fontSample.textContent = 'Sample text with the uploaded font will appear here after processing.';
                } else {
                    fontPreview.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- JavaScript for Drag & Drop and Previews -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload handling
            const dropzone = document.getElementById('dropzone-file');
            const previewContainer = document.getElementById('image-previews');
            const hiddenInputsContainer = document.getElementById('hidden-inputs-container');

            // Store files for later submission
            let uploadedFiles = [];

            dropzone.addEventListener('change', function(e) {
                handleFiles(e.target.files);
            });

            function handleFiles(files) {
                // Clear previous previews and inputs
                previewContainer.innerHTML = '';
                hiddenInputsContainer.innerHTML = '';
                uploadedFiles = [];

                const maxFiles = Math.min(files.length, 3); // Limit to 3 files

                if (maxFiles > 0) {
                    previewContainer.classList.remove('hidden');

                    for (let i = 0; i < maxFiles; i++) {
                        const file = files[i];
                        if (file.type.match('image.*')) {
                            uploadedFiles.push(file);

                            // Create preview
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = document.createElement('div');
                                preview.className = 'relative';
                                preview.innerHTML = `
                                    <img src="${e.target.result}" class="h-32 w-full object-cover rounded-lg" alt="Preview">
                                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center" data-index="${i}">
                                        ×
                                    </button>
                                `;
                                previewContainer.appendChild(preview);

                                // Add remove button functionality
                                preview.querySelector('button').addEventListener('click', function() {
                                    const index = parseInt(this.getAttribute('data-index'));
                                    removeFile(index);
                                    preview.remove();
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    }

                    // Create hidden inputs for form submission
                    createHiddenInputs();
                } else {
                    previewContainer.classList.add('hidden');
                }
            }

            function createHiddenInputs() {
                hiddenInputsContainer.innerHTML = '';
                uploadedFiles.forEach((file, index) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `image_${index + 1}`;

                    // Create a new File object with the same properties
                    const newFile = new File([file], file.name, {
                        type: file.type,
                        lastModified: file.lastModified
                    });

                    // Create a DataTransfer object to store the file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(newFile);

                    // Create a file input for this specific file
                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.name = `image_${index + 1}`;
                    fileInput.files = dataTransfer.files;
                    fileInput.style.display = 'none';

                    hiddenInputsContainer.appendChild(fileInput);
                });
            }

            // Drag and drop functionality
            const dropArea = dropzone.parentElement;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-gray-600');
            }

            function unhighlight() {
                dropArea.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-gray-600');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            function removeFile(index) {
                uploadedFiles.splice(index, 1);

                if (uploadedFiles.length > 0) {
                    // Re-render previews and inputs
                    previewContainer.innerHTML = '';
                    handleFiles(uploadedFiles);
                } else {
                    previewContainer.classList.add('hidden');
                    hiddenInputsContainer.innerHTML = '';
                }
            }

            // Font preview handling
            const fontInput = document.getElementById('font_file');
            const fontPreview = document.getElementById('font-preview');
            const fontSample = document.getElementById('font-sample');

            fontInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    fontPreview.classList.remove('hidden');
                    fontSample.textContent = 'Sample text with the uploaded font will appear here after processing.';
                    // In a real app, you would extract and load the font here
                } else {
                    fontPreview.classList.add('hidden');
                }
            });

            // Form submission handler to ensure files are properly included
            document.querySelector('form').addEventListener('submit', function(e) {
                // The hidden inputs already contain the files with correct names
                // No additional processing needed here
            });
        });
    </script> --}}

</x-layout>
