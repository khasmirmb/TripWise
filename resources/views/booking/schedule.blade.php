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
                                <div class="block items-center justify-start mb-5">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Vessel:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-xl font-semibold text-gray-700 dark:text-white"><span id="depart_ferry_name"></span></h3>
                                    </div>
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

                @if (!is_null($return_date))
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
                                <div class="block items-center justify-start mb-5">
                                    <h3 class="mb-1 text-md font-medium text-gray-500 dark:text-gray-400">Vessel:</h3>
                                    <div class="block items-center justify-start">
                                        <h3 class="mb-1 text-xl font-semibold text-gray-700 dark:text-white"><span id="return_ferry_name"></span></h3>
                                    </div>
                                </div>
                                <ol class="relative border-l border-gray-400 dark:border-white">                  
                                    <li class="mb-10 ml-6">            
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="flex items-center mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_dep_port"></span></h3>
                                    </li>
                                    <li class="mb-5 ml-6">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                            <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                            </svg>
                                        </span>
                                        <h3 class="mb-1 text-md font-semibold text-gray-700 dark:text-white"><span id="return_ariv_port"></span></h3>
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

                        @php
                            session([
                                'passenger' => $passenger,
                                'origin' => $origin,
                                'trip_type' => $trip_type,
                                'destination' => $destination,
                            ]);
                        @endphp

                        <input type="hidden" name="depart_depart_valid" required>

                        <input type="hidden" name="return_depart_valid">

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

    <!-- Error Handling -->
    <div id="toast-error" style="display: none;" class="fixed bottom-5 items-center mx-auto inset-x-0 z-50 flex justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div id="error-message" class="ml-3 text-sm font-normal"></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-error" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>

    <input type="hidden" name="depart_schedule_id">

    <input type="hidden" name="depart_fare_type">

    <input type="hidden" name="return_schedule_id">

    <input type="hidden" name="return_fare_type">

    <script type="module">
        $(document).ready(function () {
            $("#continueButton").click(function () {
                var departureDate = $("input[name='depart_depart_valid']").val();
                var returnDate = $("input[name='return_depart_valid']").val();
                var departScheduleId = $("input[name='depart_schedule_id']").val();
                var departFareType = $("input[name='depart_fare_type']").val();
                var returnScheduleId = $("input[name='return_schedule_id']").val();
                var returnFareType = $("input[name='return_fare_type']").val();
                var passengerCount = {{$passenger}};

                if (returnDate !== '' && new Date(departureDate) >= new Date(returnDate)) {
                    $('#error-container').show()
                    $('#error-message').html(" The return date should be after the departure date.");
                    
                } else if (departureDate === '') {
                    $('#error-container').show()
                    $('#error-message').html(" Please departure date.");
                } 
                @if (!is_null($return_date))
                else if (departureDate === '' || returnDate === '') {
                    $('#error-container').show()
                    $('#error-message').html(" Please select both departure and return dates.");
                }
                @endif
                 else {
                    
                    $.ajax({
                        type: 'GET',
                        url: '/depart-check-seat-availability', // Replace with the appropriate route
                        data: {
                            scheduleId: departScheduleId,
                            fareType: departFareType,
                            passengerCount: passengerCount, // Pass the passenger count
                        },
                        success: function (response) {
                            // If the response indicates availability, submit the form
                            if (response.available) {
  
                                @if (!is_null($return_date))
                                $.ajax({
                                    type: 'GET',
                                    url: '/return-check-seat-availability', // Replace with the appropriate route
                                    data: {
                                        scheduleId: returnScheduleId,
                                        fareType: returnFareType,
                                        passengerCount: passengerCount, // Pass the passenger count
                                    },
                                    success: function (response) {
                                        // If the response indicates availability, submit the form
                                        if (response.available) {
            
                                            $("form").submit(); // Submit the form if the

                                        } else {
                                            // Show an error if the return date or accommodation is fully booked
                                            $('#error-container').show()
                                            $('#error-message').html(" The accommodation is fully booked. Please choose a different accommodation or return date.");
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        // Handle errors if necessary
                                        console.error(xhr, status, error);
                                    }
                                });
                                @else

                                $("form").submit(); // Submit the form if the
                                
                                @endif
                                

                            } else {
                                // Show an error if the depart date or accommodation is fully booked
                                $('#error-container').show()
                                $('#error-message').html(" The selected accommodation is fully booked. Please choose a different accommodation or depart date.");
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle errors if necessary
                            console.error(xhr, status, error);
                        }
                    });


                }
            });
        });
    </script>

    
@include('partials.footer')