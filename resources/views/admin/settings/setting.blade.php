@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

    <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
        <div class="rounded-lg mb-4 shadow-md">
            <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Settings</span>
                            </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-800 bg-white">
                <!-- Right Content -->
                <div class="col-span-full xl:col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                            <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" src="{{asset('logo/tripwise.png')}}" alt="Logo" id="logo-preview">
                            <div>
                                <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Website Logo</h3>
                                <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                    PNG. Max size of 800K
                                </div>
                                @error('picture-upload')
                                    <p class="my-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                @enderror
                                <form action="{{ route('admin.update.logo') }}" method="POST" enctype="multipart/form-data" id="logoForm">
                                    @csrf
                                    <div class="flex items-center space-x-4">
                                        <label for="picture-upload" class="cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                                <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                                            </svg>
                                            Upload picture
                                        </label>
                                        <input type="file" id="picture-upload" class="hidden" name="picture-upload" accept=".png" onchange="previewImage(this)"/>
                                    </div>
                                    <div class="my-2">
                                        <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Save</button>
                                    </div>
                                </form>
                                <script>
                                    function previewImage(input) {
                                        var file = input.files[0];
                                        if (file) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                document.getElementById('logo-preview').src = e.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Rebooking Fee</h3>
                        <form action="{{route('admin.update.fee')}}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rebooking_fee" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Rebook Fee</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                                    </svg>
                                    </div>
                                    <input type="number" id="rebooking_fee" name="rebooking_fee" class="block p-2.5 w-full z-20 ps-10 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-e-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-teal-500" placeholder="Enter amount" required value="{{ $fee->rebooking_fee }}">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Left Content -->
                <div class="col-span-2">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Social information</h3>
                        <form action="{{ route('admin.socials.update') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                @foreach($socials as $name => $url)
                                <div class="sm:col-span-6">
                                    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($name) }}</label>
                                    <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ $url }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="{{ ucfirst($name) }} URL" required>
                                </div>
                                @endforeach
                                <div class="col-span-6 sm:col-full">
                                    <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                              <div>
                                <h5 class="mr-3 font-semibold dark:text-white">Accommodation List</h5>
                                <p class="text-gray-500 dark:text-gray-400">Manage Accommodation</p>
                              </div>
                              <button type="button"        data-modal-toggle="add-accommodation" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add New
                              </button>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $accommodations->sortBy('acc_type') as $accommodation)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$accommodation->acc_type}}
                                            </th>
                                            <td class="space-x-2">
                                                <button type="button" 
                                                data-modal-target="edit-accommodation{{$accommodation->id}}" data-modal-toggle="edit-accommodation{{$accommodation->id}}"
                                                class="font-medium text-teal-600 dark:text-teal-500 hover:underline">Edit</button>
                                                <button type="button" data-modal-target="delete-accommodation{{$accommodation->id}}" data-modal-toggle="delete-accommodation{{$accommodation->id}}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                            </td>
                                        </tr>

                                        @include('admin.settings.crud.delete-accommo')

                                        @include('admin.settings.crud.edit-accommo')

                                    @endforeach
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('admin.settings.crud.add-accommo')

@include('admin.partials.footer')