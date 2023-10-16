@include('partials.header')

    @include('components.navigation')

    @include('layouts.itinerary')

    @include('layouts.progress-schedule')

    <section class="bg-slate-50 dark:bg-gray-800">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-5 bg-white dark:bg-gray-800 p-3">
            <!-- First column -->
            <div class="col-span-3">
                @include('layouts.one-way')

                @include('layouts.round-trip')
            </div>
            <!-- First column -->
    
            <!-- Second column -->
            <div class="col-span-1">
                <div class="flex my-2 gap-1 sm:gap-4 mb-4">  
                    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">Summary</h3>
                </div>
                <!-- Departure Summary -->
                <div id="accordion-depart" data-accordion="depart" class="mb-3 shadow">
                    <h2 id="accordion-depart-heading-1">
                      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-depart-body-1" aria-expanded="true" aria-controls="accordion-depart-body-1">
                        <span class="flex items-center">Departure</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                      </button>
                    </h2>
                    <div id="accordion-depart-body-1" class="hidden" aria-labelledby="accordion-depart-heading-1">
                        <div id="depart_summary" class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900" style="display:none">
                            <div class="block">
                                <div class="block mb-5">
                                    <h3 class="mb-1 text-xl font-semibold text-gray-700 dark:text-white"><span id="depart_ferry_name"></span></h3>
                                </div>
                                <ol class="relative border-l border-gray-400 dark:border-white">                  
                                    <li class="mb-10 ml-6">            
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="depart_dep_port"></span></h3>
                                    </li>
                                    <li class="mb-5 ml-6">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="depart_ariv_port"></span></h3>
                                    </li>
                                </ol>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Departure Date:</h3>
                                    <div class="flex items-center justify-between">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="depart_dep_date"></span></h3>
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="depart_dep_time"></span></h3>
                                    </div>
                                </div>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Accommodation:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="depart_fare_type"></span></h3>
                                    </div>
                                </div>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Price:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white">₱<span id="depart_fare_price"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="no-departure" class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <div class="block">
                                <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white">Please Select a Departure</h3>
                            </div>
                        </div>
                    </div>
                </div>

                @if (is_null($return_date))

                @else
                <!-- Return Summary -->
                <div id="accordion-return" data-accordion="return" class="my-3 shadow">
                    <h2 id="accordion-return-heading-1">
                      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-return-body-1" aria-expanded="true" aria-controls="accordion-return-body-1">
                        <span class="flex items-center">Return</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                      </button>
                    </h2>
                    <div id="accordion-return-body-1" class="hidden" aria-labelledby="accordion-return-heading-1">
                        <div id="return_summary" class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900" style="display:none">
                            <div class="block">
                                <div class="block mb-5">
                                    <h3 class="mb-1 text-xl font-semibold text-gray-700 dark:text-white"><span id="return_ferry_name"></span></h3>
                                </div>
                                <ol class="relative border-l border-gray-400 dark:border-white">                  
                                    <li class="mb-10 ml-6">            
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_ariv_port"></span></h3>
                                    </li>
                                    <li class="mb-5 ml-6">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_dep_port"></span></h3>
                                    </li>
                                </ol>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Return Date:</h3>
                                    <div class="flex items-center justify-between">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_dep_date"></span></h3>
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_dep_time"></span></h3>
                                    </div>
                                </div>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Accommodation:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_fare_type"></span></h3>
                                    </div>
                                </div>
                                <div class="block items-center justify-start mt-3">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Price:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white">₱<span id="return_fare_price"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="no-return" class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <div class="block">
                                <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white">Please Select a Return</h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="block w-full mt-4">
                    <form method="POST" action="{{route('booking.passenger.show')}}">
                        @csrf
                        <input type="hidden" name="passenger" value="{{$passenger}}" required>
                        <input type="hidden" name="origin" value="{{$origin}}" required>
                        <input type="hidden" name="trip_type" value="{{$trip_type}}" required>
                        <input type="hidden" name="destination" value="{{$destination}}" required>
                        <input type="hidden" name="depart_date" value="{{$depart_date}}" required>
                        <input type="hidden" name="return_date" value="{{$return_date}}">

                        <input type="hidden" name="dep_sched_id" required>
                        <input type="hidden" name="dep_sched_type" required>
                        <input type="hidden" name="dep_sched_price" required>
                        <input type="hidden" name="depart_depart_valid" required>

                        @if (is_null($return_date))

                        @else
                        <input type="hidden" name="ret_sched_id" required>
                        <input type="hidden" name="ret_sched_type" required>
                        <input type="hidden" name="ret_sched_price" required>
                        <input type="hidden" name="return_depart_valid" required>
                        @endif
                        <button id="continueButton" type="button" class="w-full px-5 py-3 text-lg font-medium text-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Continue</button>
                    </form>
                    <div id="error-container" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800 mt-4" role="alert" style="display: none">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <span class="font-medium">Error!</span><span id="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second column -->
        </div>
        <!-- Grid -->
    </section>

    <script type="module">
        $(document).ready(function () {
            $("#continueButton").click(function () {
                var departureDate = $("input[name='depart_depart_valid']").val();
                var returnDate = $("input[name='return_depart_valid']").val();

                if (returnDate !== '' && new Date(departureDate) >= new Date(returnDate)) {
                    $('#error-container').show()
                    $('#error-message').html(" The return date should be after the departure date.");
                } else if (departureDate === '') {
                    $('#error-container').show()
                    $('#error-message').html(" Please departure date.");
                } else if (departureDate === '' || returnDate === '') {
                    $('#error-container').show()
                    $('#error-message').html(" Please select both departure and return dates.");
                }else {
                    $("form").submit(); // Submit the form if the validation passes
                }
            });
        });
    </script>

    
@include('partials.footer')