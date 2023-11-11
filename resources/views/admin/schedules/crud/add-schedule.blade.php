@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

    @include('admin.components.error-message')

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
                            Fields with red asterisks (<span class="text-red-600">*</span>) are required. Ensure that the total number of seats entered for fares matches the vessel's overall capacity.
                        </div>
                    </div>
                    <div class="px-4 py-2 mx-auto">
                        <form action="{{route('admin.schedule.add-process')}}" method="POST">
                            @csrf
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="origin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origin<span class="text-red-600">*</span></label>
                                    <select id="origin" name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('origin') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                    </select>
                                    @error('origin')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror 
                                </div>
                                <div class="w-full">
                                    <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination<span class="text-red-600">*</span></label>
                                    <select id="destination" name="destination" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('destination') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror 
                                </div>
                                <div class="w-full">
                                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Starting Date<span class="text-red-600">*</span></label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="start_date" name="start_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Select starting date" required value="{{old('start_date')}}">
                                      </div>
                                      @error('start_date')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                      @enderror
                                </div>
                                <div class="w-full">
                                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ending Date<span class="text-red-600">*</span></label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                           <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input id="end_date" name="end_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Select ending date" required value="{{old('end_date')}}">
                                    </div>
                                    @error('end_date')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Day<span class="text-red-600">*</span></label>
                                    <select id="day" name="day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" {{ old('day') == '' ? 'selected' : '' }}>Select Day</option>
                                        <option value="mo" {{ old('day') == 'mo' ? 'selected' : '' }}>Monday</option>
                                        <option value="tu" {{ old('day') == 'tu' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="we" {{ old('day') == 'we' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="th" {{ old('day') == 'th' ? 'selected' : '' }}>Thursday</option>
                                        <option value="fr" {{ old('day') == 'fr' ? 'selected' : '' }}>Friday</option>
                                        <option value="sa" {{ old('day') == 'sa' ? 'selected' : '' }}>Saturday</option>
                                        <option value="su" {{ old('day') == 'su' ? 'selected' : '' }}>Sunday</option>
                                    </select>
                                    @error('day')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="vessel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vessel<span class="text-red-600">*</span></label>
                                    <select id="vessel" name="vessel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option selected value="">Select Vessel</option>
                                        @foreach($ferries as $ferries)
                                            <option value="{{ $ferries->id }}" {{ old('vessel') === $ferries->id ? 'selected' : '' }}>{{ $ferries->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vessel')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror 
                                </div>
                                <div class="w-full">
                                    <label for="departure_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departure Time<span class="text-red-600">*</span></label>
                                    <input type="time" id="departure_time" name="departure_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required value="{{ old('departure_time') }}">
                                    @error('departure_time')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="arrival_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Arrival Time<span class="text-red-600">*</span></label>
                                    <input type="time" id="arrival_time" name="arrival_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required value="{{old('arrival_time')}}">
                                    @error('arrival_time')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <div class="sm:mt-5" id="vessel-info">
                                        <!-- Ferry Infomation -->
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div id="seat_input" class="w-full">
    
                                    </div>
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

        <div id="error-schedule" class="fixed top-2 mx-auto inset-x-0 z-50 flex justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert" style="display: none">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="flex ml-3 text-sm font-normal items-center">Something went wrong. Please try again..</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#error-schedule" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <script type="module">
            $(document).ready(function() {
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
        
                $('#vessel').change(function() {
                    var ferry_id = $(this).val();
        
                    // Make Ajax call to Laravel controller
                    $.ajax({
                        url: '/admin/schedules/ferry-info', // Replace with your actual route
                        type: 'GET',
                        data: { ferry_id: ferry_id },
                        success: function(response) {
                            // Clear existing content before appending new information
                            $('#vessel-info').empty();

                            $('#seat_input').empty();
        
                            // Ferry Capacity
                            $('#vessel-info').append('<p class="block text-sm font-medium text-gray-900 dark:text-white">Capacity: <span class="mb-2 text-gray-500 dark:text-gray-400">' + response.ferry.capacity + '</span></p>');
        
                            // Ferry Fares
                            response.fares.forEach(function(fare) {
                                $('#vessel-info').append('<p class="block text-sm font-medium text-gray-900 dark:text-white">' + fare.type + ': <span class="mb-2 text-gray-500 dark:text-gray-400">₱' + fare.price + '</span></p>');

                                $('#seat_input').append(
                                    '<label for="' + fare.type + '" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">' + fare.type + ' Seats<span class="text-red-600">*</span></label>' +
                                    '<input type="number" id="' + fare.type + '" name="seats[' + fare.type + ']" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="50" required>'
                                );
                            });
                        },
                        error: function(error) {
                            console.log(error);
        
                            $('#error-schedule').show();
                        }
                    });
                });
            });
        </script>
               
@include('admin.partials.footer')