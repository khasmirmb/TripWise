@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

        <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
            <div class="rounded-lg mb-4 shadow-md">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg py-2">
                    <div class="flex items-start justify-start p-4">
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                              <li class="inline-flex items-center">
                                <a href="{{route('admin.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-teal-600 dark:text-gray-400 dark:hover:text-white">
                                  <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                  </svg>
                                  Home
                                </a>
                              </li>
                              <li>
                                <div class="flex items-center">
                                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                  </svg>
                                  <a href="{{route('admin.ferry')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-teal-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Ferries</a>
                                </div>
                              </li>
                              <li aria-current="page">
                                <div class="flex items-center">
                                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                  </svg>
                                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Add</span>
                                </div>
                              </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Fields with red asterisks (<span class="text-red-600">*</span>) are required.
                        </div>
                    </div>
                    <div class="px-4 py-2 mx-auto">
                        <form action="{{route('admin.ferry.add-process')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span class="text-red-600">*</span></label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="MV Anata" required="" value="{{old('name')}}" style="text-transform: capitalize;">
                                    @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Image</label>
                                    <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image_help" id="image" type="file" accept="image/*" onchange="loadFile(event)">
                                    @error('image')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full sm:col-span-2">
                                    <div class="w-full">
                                        <button type="button" id="add-fare" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Add Fare<span class="text-red-600">*</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 mb-3" id="fare-container">
                                <!-- Dynamic Fare Input -->
                                @foreach(old('type', []) as $index => $value)
                                    <div class="w-full">
                                        <label for="type[]" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Type<span class="text-red-600">*</span></label>
                                        <select id="type[]" name="type[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                            <option value="" disabled selected>Choose a type</option>
                                            <option value="Economy" {{ old('type.' . $index) == 'Economy' ? 'selected' : '' }}>Economy</option>
                                            <option value="Aircon" {{ old('type.' . $index) == 'Aircon' ? 'selected' : '' }}>Aircon</option>
                                            <option value="Tourist" {{ old('type.' . $index) == 'Tourist' ? 'selected' : '' }}>Tourist</option>
                                            <option value="Business" {{ old('type.' . $index) == 'Business' ? 'selected' : '' }}>Business</option>
                                            <option value="Cabin" {{ old('type.' . $index) == 'Cabin' ? 'selected' : '' }}>Cabin</option>
                                            <option value="Suite" {{ old('type.' . $index) == 'Suite' ? 'selected' : '' }}>Suite</option>
                                        </select>
                                        @error('type.' . $index)
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                        @enderror

                                        <label for="price[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price<span class="text-red-600">*</span></label>
                                        <input type="number" name="price[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="500" required value="{{ old('price.' . $index) }}">

                                        <label for="seats[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats<span class="text-red-600">*</span></label>
                                        <input type="number" name="seats[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="30" required value="{{ old('seats.' . $index) }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Ferry Description">{{old('description')}}</textarea>
                                    @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full text-center sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ferry Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="preview-image" class="rounded-lg w-60 h-52 border-2 object-cover">
                                    </div>
                                </div>
                                <div class="w-full sm:col-span-2">
                                    <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="upper">Upper Deck Image</label>
                                    <input name="upper" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="upper_help" id="upper" type="file" accept="image/*" onchange="previewUpperImage(this)">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="upper_help">PNG or JPG</p>
                                    @error('upper')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="w-full text-center sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upper Deck Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="upper-preview-image" class="rounded-lg w-full sm:h-96 h-40 object-fit" style="display: none;">
                                    </div>
                                </div>
                                <div class="w-full sm:col-span-2">
                                    <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="middle">Middle Deck Image</label>
                                    <input name="middle" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="middle_help" id="middle" type="file" accept="image/*" onchange="previewMiddleImage(this)">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="middle_help">PNG or JPG</p>
                                    @error('middle')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="w-full text-center sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Deck Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="middle-preview-image" class="rounded-lg w-full sm:h-96 h-40 object-fit" style="display: none;">
                                    </div>
                                </div>
                                <div class="w-full sm:col-span-2">
                                    <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="lower">Lower Deck Image</label>
                                    <input name="lower" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="lower_help" id="lower" type="file" accept="image/*" onchange="previewLowerImage(this)">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="lower_help">PNG or JPG</p>
                                    @error('lower')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="w-full text-center sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lower Deck Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="lower-preview-image" class="rounded-lg w-full sm:h-96 h-40 object-fit" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Add Ferry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script>
            var loadFile = function(event) {
              var output = document.getElementById('preview-image');
              output.src = URL.createObjectURL(event.target.files[0]);
              output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
              }
            };

            function previewUpperImage(input) {
                var preview = document.getElementById('upper-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                }
            }

            function previewMiddleImage(input) {
                var preview = document.getElementById('middle-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                }
            }

            function previewLowerImage(input) {
                var preview = document.getElementById('lower-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                }
            }
        </script>

        <script type="module">
            $(document).ready(function() {
                const fareContainer = $('#fare-container');
                const addFareButton = $('#add-fare');

                // Counter to track fare input fields
                let fareCounter = 0;

                // Function to add a new fare input field
                function addFareInput() {
                    fareCounter++;
                    const newFareInput = `
                        <div class="w-full">
                            <label for="type[]" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Type<span class="text-red-600">*</span></label>
                            <select id="type[]" name="type[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                <option selected>Choose a type</option>
                                <option value="Economy">Economy</option>
                                <option value="Aircon">Aircon</option>
                                <option value="Tourist">Tourist</option>
                                <option value="Business">Business</option>
                                <option value="Cabin">Cabin</option>
                                <option value="Suite">Suite</option>
                            </select>
                            
                            <label for="price[]" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Price<span class="text-red-600">*</span></label>
                            <input type="number" name="price[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="500" required>

                            <label for="seats[]" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Seats<span class="text-red-600">*</span></label>
                            <input type="number" name="seats[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="30" required>
                            
                            <button type="button" class="remove-fare-button text-red-700 hover:text-red-800 focus:ring-4 focus:ring-red-300 font-medium text-sm mt-2">Remove</button>
                        </div>
                    `;

                    fareContainer.append(newFareInput);

                    // Add an event listener to the "Remove" button
                    const $newFareInput = fareContainer.children().last();
                    $newFareInput.find('.remove-fare-button').click(function() {
                        $newFareInput.remove();
                    });
                }

                // Add event listener to the "Add Fare" button
                addFareButton.click(addFareInput);
            });
        </script>
        
          

@include('admin.partials.footer')