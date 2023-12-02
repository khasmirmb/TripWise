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
                                  <a href="{{route('admin.booking')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-teal-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Bookings</a>
                                </div>
                              </li>
                              <li aria-current="page">
                                <div class="flex items-center">
                                  <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                  </svg>
                                  <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit</span>
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
                    <div class="px-4 py-2 mx-auto">
                        <form action="{{route('admin.booking.add-process')}}" method="POST">
                            @csrf
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Schedule Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="origin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origin<span class="text-red-600">*</span></label>
                                    <select id="origin" name="origin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports->sortBy('location') as $port)
                                            <option value="{{ $port->name }}">{{ $port->location }}</option>
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
                                        @foreach($ports->sortBy('location') as $port)
                                            <option value="{{ $port->name }}">{{ $port->location }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror 
                                </div>
                                <div class="w-full">
                                    <label for="schedule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule<span class="text-red-600">*</span></label>
                                    <select id="schedule" name="schedule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <!-- Options will be dynamically populated based on the selected origin and destination -->
                                    </select>
                                    @error('schedule')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="fare" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fare Type<span class="text-red-600">*</span></label>
                                    <select id="fare" name="fare" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <!-- Options will be dynamically populated based on the selected schedule -->
                                    </select>
                                    @error('fare')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Contact Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="contact-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Name<span class="text-red-600">*</span></label>
                                    <input type="text" name="contact-name" id="contact-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Full Name" required value="{{old('contact-name')}}" style="text-transform: capitalize;">
                                    @error('contact-name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Email<span class="text-red-600">*</span></label>
                                    <input type="email" name="contact-email" id="contact-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="name@email.com" required value="{{old('contact-email')}}">
                                    @error('contact-email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Phone<span class="text-red-600">*</span></label>
                                    <input type="number" name="contact-phone" id="contact-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="09123456789" required value="{{old('contact-phone')}}">
                                    @error('contact-phone')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Address<span class="text-red-600">*</span></label>
                                    <input type="text" name="contact-address" id="contact-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Zamboanga City" required value="{{old('contact-address')}}" style="text-transform: capitalize;">
                                    @error('contact-address')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Passengers</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 my-3">
                                <div class="w-full">
                                    <label for="firstname[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname<span class="text-red-600">*</span></label>
                                    <input type="text" name="firstname[]" id="firstname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Firstname" required style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="middlename[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middlename</label>
                                    <input type="text" name="middlename[]" id="middlename[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Middlename" style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="lastname[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname<span class="text-red-600">*</span></label>
                                    <input type="text" name="lastname[]" id="lastname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Lastname" required style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="birthday[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday<span class="text-red-600">*</span></label>
                                    <input type="date" name="birthday[]" id="birthday[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required>
                                </div>
                                <div class="w-full">
                                    <label for="gender[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender<span class="text-red-600">*</span></label>
                                    <select id="gender[]" name="gender[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled selected>Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="relative z-0 w-full text-left">
                                    <button type="button" id="addPassengerBtn" class="mt-2 sm:mt-7 text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-md lg:px-5 px-2 py-2.5 text-center inline-flex items-center mr-2 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 md:text-sm">
                                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                        </svg>
                                        Add Passenger
                                    </button>
                                </div>
                            </div>
                            <div id="passengerContainer">
                                <!-- Container to hold dynamically added passengers -->
                            </div>
                            
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Payment Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="payment-amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Amount<span class="text-red-600">*</span></label>
                                    <input type="number" name="payment-amount" id="payment-amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required readonly>
                                    @error('payment-amount')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="payment-method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method<span class="text-red-600">*</span></label>
                                    <select id="payment-method" name="payment-method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled>Choose a Type</option>
                                        <option value="otc" {{ old('payment-method') == 'OTC' ? 'selected' : '' }}>OTC</option>
                                        <option value="gcash" {{ old('payment-method') == 'Gcash' ? 'selected' : '' }}>Gcash</option>
                                        <option value="paymaya" {{ old('payment-method') == 'Paymaya' ? 'selected' : '' }}>Paymaya</option>
                                        <option value="card" {{ old('payment-method') == 'Card' ? 'selected' : '' }}>Card</option>
                                        <option value="grab_pay" {{ old('payment-method') == 'Grab_pay' ? 'selected' : '' }}>Grab Pay</option>
                                    </select>
                                    @error('payment-method')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="payment-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Date<span class="text-red-600">*</span></label>
                                    <input type="date" name="payment-date" id="payment-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required value="{{old('payment-date')}}">
                                    @error('payment-date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Add Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

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

                // Counter for dynamically added passengers
                var passengerCounter = 1;

                // Update payment amount when fare type is selected
                $('#fare').on('change', function () {
                    updatePaymentAmount();
                });

                // Event listener for the "Add Passenger" button
                $('#addPassengerBtn').on('click', function () {
                    addPassenger();
                    updatePaymentAmount();
                });

                // Event listener for removing passengers using event delegation
                $('#passengerContainer').on('click', '.remove-passenger-button', function () {
                    var passengerId = $(this).data('passenger-id');
                    removePassenger(passengerId);
                    updatePaymentAmount();
                });

                // Function to update the payment amount based on selected fare and number of passengers
                function updatePaymentAmount() {
                    var farePrice = parseFloat($('#fare option:selected').data('price')) || 0;
                    var numPassengers = $('.remove-passenger-button').length + 1; // +1 to include the main passenger
                    var totalAmount = farePrice * numPassengers;

                    $('#payment-amount').val(totalAmount.toFixed(2)); // Set the payment amount with 2 decimal places
                }

                // Function to add passenger input fields
                function addPassenger() {
                    passengerCounter++;

                    var newPassenger = `
                        <div class="w-full my-1 sm:my-3" id="heading_pas_${passengerCounter}">
                            <h5 class="mr-3 font-semibold dark:text-white">Additional Passenger</h5>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 my-3" id="passenger_${passengerCounter}">
                                <div class="w-full">
                                    <label for="firstname[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname<span class="text-red-600">*</span></label>
                                    <input type="text" name="firstname[]" id="firstname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Firstname" required value="{{old('firstname[]')}}" style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="middlename[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middlename</label>
                                    <input type="text" name="middlename[]" id="middlename[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Middlename" value="{{old('middlename[]')}}" style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="lastname[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname<span class="text-red-600">*</span></label>
                                    <input type="text" name="lastname[]" id="lastname[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Lastname" required value="{{old('lastname[]')}}" style="text-transform: capitalize;">
                                </div>
                                <div class="w-full">
                                    <label for="birthday[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday<span class="text-red-600">*</span></label>
                                    <input type="date" name="birthday[]" id="birthday[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required value="{{old('birthday[]')}}">
                                </div>
                                <div class="w-full">
                                    <label for="gender[]" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender<span class="text-red-600">*</span></label>
                                    <select id="gender[]" name="gender[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled selected>Choose Gender</option>
                                        <option value="Male" {{ old('type') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('type') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            <div class="relative z-0 w-full text-left">
                                <button type="button" class="mt-2 sm:mt-7 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-md lg:px-5 px-2 py-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 md:text-sm remove-passenger-button" data-passenger-id="${passengerCounter}">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Remove Passenger
                                </button>
                            </div>
                        </div>
                    `;

                    $('#passengerContainer').append(newPassenger);
                }

                // Function to remove passenger input fields
                function removePassenger(passengerId) {
                    $(`#passenger_${passengerId}`).remove();
                    $(`#heading_pas_${passengerId}`).remove();
                }

                // Schedule Finder
                $('#origin, #destination').on('change', function () {
                    var origin = $('#origin').val();
                    var destination = $('#destination').val();

                    // Make an AJAX request to get schedules based on origin and destination
                    $.ajax({
                        url: '/admin/booking/get-schedules', // Replace with your backend route to fetch schedules
                        method: 'GET',
                        data: {
                            origin: origin,
                            destination: destination
                        },
                        success: function (response) {
                            // Update the schedule select options based on the response
                            var scheduleSelect = $('#schedule');
                            scheduleSelect.empty();
                            scheduleSelect.append('<option value="">Select Schedule</option>');

                            if (response.schedules.length > 0) {
                                // Sort schedules by departure_date
                                response.schedules.sort(function(a, b) {
                                    return new Date(a.departure_date + ' ' + a.departure_time) - new Date(b.departure_date + ' ' + b.departure_time);
                                });

                                // Append options to the select element
                                $.each(response.schedules, function (index, schedule) {
                                    var formattedDate = new Date(schedule.departure_date + ' ' + schedule.departure_time);
                                    var formattedDateString = formattedDate.toLocaleString('en-US', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        hour12: true
                                    });

                                    scheduleSelect.append('<option value="' + schedule.id + '">' + formattedDateString  +  ' - ' + schedule.ferry_name +'</option>');
                                });

                            } else {
                                scheduleSelect.append('<option value="">No schedules available</option>');
                            }

                            // Fare Finder
                            $('#schedule').on('change', function () {
                                var scheduleId = $(this).val();

                                // Make an AJAX request to get fare types based on the selected schedule
                                $.ajax({
                                    url: '/admin/booking/get-fares', // Replace with your backend route to fetch fare types
                                    method: 'GET',
                                    data: {
                                        schedule_id: scheduleId
                                    },
                                    success: function (response) {
                                        // Update the fare select options based on the response
                                        var fareSelect = $('#fare');
                                        fareSelect.empty();
                                        fareSelect.append('<option value="">Select Fare Type</option>');

                                        if (response.fares.length > 0) {
                                            $.each(response.fares, function (index, fare) {
                                                fareSelect.append('<option value="' + fare.id + '" data-price="' + fare.price + '">' + fare.type + ' - ₱' + fare.price + '</option>');
                                            });
                                        } else {
                                            fareSelect.append('<option value="">No fare types available</option>');
                                        }
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                });
                            });

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

            });
        </script>

@include('admin.partials.footer')   