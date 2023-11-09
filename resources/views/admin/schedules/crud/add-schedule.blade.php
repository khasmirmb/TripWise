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
                                  <a href="{{route('admin.schedule')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-teal-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Schedules</a>
                                </div>
                              </li>
                              <li aria-current="page">
                                <div class="flex items-center">
                                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                  </svg>
                                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Add Schedule</span>
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
                        <form action="#" method="POST">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="origin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origin</label>
                                    <select id="origin" name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('origin') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination</label>
                                    <select id="destination" name="destination" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('destination') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Ferry Description">{{old('description')}}</textarea>
                                    @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Add Schedule
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script type="module">
        // JQuery
        // Remove Selected Value from Destination based on Origin
        var $dropdown1 = $("select[name='origin']");
        var $dropdown2 = $("select[name='destination']");

        $dropdown1.change(function() {
            $dropdown2.empty().append($dropdown1.find('option').clone());
            var selectedItem = $(this).val();
            if (selectedItem) {
                $dropdown2.find('option[value="' + selectedItem + '"]').remove();
            }
        });
        </script>
               
@include('admin.partials.footer')