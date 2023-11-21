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
                                <a href="{{route('admin.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Users</span>
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
                        <form action="{{route('admin.user.add-process')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="w-full">
                                    <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname<span class="text-red-600">*</span></label>
                                    <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Firstname" required="" value="{{old('firstname')}}" style="text-transform: capitalize;">
                                    @error('firstname')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname<span class="text-red-600">*</span></label>
                                    <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Lastname" required="" value="{{old('lastname')}}" style="text-transform: capitalize;">
                                    @error('lastname')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email<span class="text-red-600">*</span></label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="name@gmail.com" required="" value="{{old('email')}}">
                                    @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="09123456789" value="{{old('phone')}}">
                                    @error('phone')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span class="text-red-600">*</span></label>
                                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="••••••••" required="">
                                    @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password<span class="text-red-600">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="••••••••" required="">
                                    @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type<span class="text-red-600">*</span></label>
                                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="">Select Type</option>
                                        <option value="0" @if(old('type') == '0') selected @endif>Staff</option>
                                        <option value="1" @if(old('type') == '1') selected @endif>Admin</option>
                                    </select>
                                    @error('type')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                    <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Zamboanga City" value="{{old('address')}}">
                                    @error('address')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload Image</label>
                                    <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image_help" id="image" type="file" accept="image/*" onchange="loadFile(event)">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">PNG or JPG</p>
                                    @error('image')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full text-center">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Preview</label>
                                    <div class="flex justify-center">
                                        <img id="preview-image" class="rounded-full w-36 h-36 border-2">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Add User
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
        </script>
          

@include('admin.partials.footer')