@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')
    
        <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
            <div class="rounded-lg mb-4">
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
                                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit Ferry</span>
                                </div>
                              </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="flex items-center p-4 mb-2 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Fields with red asterisks (<span class="text-red-600">*</span>) are required.
                        </div>
                    </div>
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Currently Editing Ferry: <strong class="text-red-600">{{$ferry->name}}</strong>
                        </div>
                    </div>
                    <div class="px-4 py-2 mx-auto">
                        <div class="w-full mb-2">
                            <div class="relative overflow-hidden sm:rounded-lg">
                                <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                                  <div>
                                    <h5 class="mr-3 font-semibold dark:text-white">Ferry's Fare</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Manage all ferry's existing fare or add a new one</p>
                                  </div>
                                  <button type="button"
                                    data-modal-toggle="add-fare{{$ferry->id}}"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add New Fare
                                  </button>
                                </div>
                            </div>

                            @include('admin.ferries.fares.add-fare')

                            <div class="relative overflow-x-auto sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Type
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Price
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Seats
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ferry->fares as $fare)
                                        <tr class="bg-slate-100 dark:bg-gray-900 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$fare->type}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{"₱" .$fare->price}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$fare->seats}}
                                            </td>
                                            <td class="px-6 py-4 flex space-x-2">
                                                <button type="button" id="edit-fare{{$fare->id}}Button" data-modal-toggle="edit-fare{{$fare->id}}" class="font-medium text-teal-600 dark:text-teal-500 hover:underline">Edit</button>
                                                <button type="button" data-modal-target="delete-fare{{$fare->id}}" data-modal-toggle="delete-fare{{$fare->id}}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                            </td>
                                        </tr>

                                        @include('admin.ferries.fares.edit-fare')

                                        @include('admin.ferries.fares.delete-fare')

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form action="{{route('admin.ferry.edit-process' , ['ferry' => $ferry->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span class="text-red-600">*</span></label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="MV Anata" required="" value="{{old('name', $ferry->name)}}" style="text-transform: capitalize;">
                                    @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Image</label>
                                    <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image_help" id="image" type="file" accept="image/*" onchange="previewImage(this)">
                                    @error('image')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Ferry Description">{{old('description', $ferry->description)}}</textarea>
                                    @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full text-center sm:col-span-2">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ferry Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="preview-image" class="rounded-lg w-60 h-52 object-cover" style="display: none;">
                                        <img id="old-preview-image" class="rounded-lg w-60 h-52 object-cover" 
                                        @if ($ferry->image)
                                            src="{{asset('ferries/' . $ferry->image)}}"
                                        @else
                                            src="{{asset('ferries/default.png')}}"
                                        @endif >
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
                                        <img id="upper-preview-image" class="rounded-lg w-full sm:h-96 h-40" style="display: none;">
                                        <img id="old-upper-preview-image" class="rounded-lg w-full sm:h-96 h-40"
                                        @if ($ferry->upper)
                                            src="{{asset('ferries/' . $ferry->upper)}}"
                                        @else
                                            src="{{asset('images/no_image.png')}}"
                                        @endif>
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
                                        <img id="middle-preview-image" class="rounded-lg w-full sm:h-96 h-40" style="display: none;">
                                        <img id="old-middle-preview-image" class="rounded-lg w-full sm:h-96 h-40"
                                        @if ($ferry->middle)
                                            src="{{asset('ferries/' . $ferry->middle)}}"
                                        @else
                                            src="{{asset('images/no_image.png')}}"
                                        @endif>
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
                                        <img id="lower-preview-image" class="rounded-lg w-full sm:h-96 h-40" style="display: none;">
                                        <img id="old-lower-preview-image" class="rounded-lg w-full sm:h-96 h-40"
                                        @if ($ferry->lower)
                                            src="{{asset('ferries/' . $ferry->lower)}}"
                                        @else
                                            src="{{asset('images/no_image.png')}}"
                                        @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Update Ferry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script>
            function previewImage(input) {
                var preview = document.getElementById('preview-image');
                var old_preview = document.getElementById('old-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                        old_preview.style.display = 'none'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                    old_preview.style.display = 'block'; // Hide the preview
                }
            }

            function previewUpperImage(input) {
                var preview = document.getElementById('upper-preview-image');
                var old_preview = document.getElementById('old-upper-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                        old_preview.style.display = 'none'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                    old_preview.style.display = 'block'; // Hide the preview
                }
            }

            function previewMiddleImage(input) {
                var preview = document.getElementById('middle-preview-image');
                var old_preview = document.getElementById('old-middle-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                        old_preview.style.display = 'none'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                    old_preview.style.display = 'block'; // Hide the preview
                }
            }

            function previewLowerImage(input) {
                var preview = document.getElementById('lower-preview-image');
                var old_preview = document.getElementById('old-lower-preview-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image preview
                        old_preview.style.display = 'none'; // Show the image preview
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '';
                    preview.style.display = 'none'; // Hide the preview
                    old_preview.style.display = 'block'; // Hide the preview
                }
            }
        </script>

@include('admin.partials.footer')