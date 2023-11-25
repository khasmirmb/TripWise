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
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Currently Editing Booking: <strong class="text-red-600">{{$booking->reference_number}}</strong>
                        </div>
                    </div>
                    @if ($booking->payment->payment_status = 'Paid')
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            PayMongo ID: <strong class="font-bold">{{$booking->payment->paymongo_id}}</strong>
                        </div>
                    </div>
                    @endif
                    <div class="px-4 py-2 mx-auto">
                        <div class="w-full mb-2">
                            <div class="relative overflow-hidden sm:rounded-lg">
                                <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                                  <div>
                                    <h5 class="mr-3 font-semibold dark:text-white">Booking's Passenger</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Manage booking's existing passenger or add a new one</p>
                                  </div>
                                  <button type="button"
                                    data-modal-toggle="#"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Passenger
                                  </button>
                                </div>
                            </div>
                            <div class="relative overflow-x-auto sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Birthday
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Gender
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Accommodation
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Seat
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking->passengers as $passenger)
                                        <tr class="bg-slate-100 dark:bg-gray-900 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$passenger->first_name . " " . $passenger->middle_name[0] . " " . $passenger->last_name}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($passenger->birthdate)->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$passenger->gender}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$passenger->accommodation}}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($passenger->seat_id)
                                                    {{$passenger->seat->seat_number}}
                                                @else
                                                    None
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 flex space-x-2">
                                                <button type="button" class="font-medium text-teal-600 dark:text-teal-500 hover:underline">Edit</button>
                                                <button type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form action="#" method="POST">
                            @csrf
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="booking-status" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Payment Status<span class="text-red-600">*</span></label>
                                    <select id="booking-status" name="booking-status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled>Choose a type</option>
                                        <option value="Pending" {{ old('booking-status', $booking->payment->payment_status) == 'Pending' ? 'selected' : '' }} class="text-yellow-600 dark:text-yellow-300">Pending</option>
                                        <option value="Canceled" {{ old('booking-status', $booking->payment->payment_status) == 'Canceled' ? 'selected' : '' }} class="text-red-600 dark:text-red-400">Canceled</option>
                                        <option value="Paid" {{ old('booking-status', $booking->payment->payment_status) == 'Paid' ? 'selected' : '' }} class="text-green-600 dark:text-green-400">Paid</option>
                                    </select>
                                </div>
                                <div class="w-full sm:pt-1.5">
                                    <label for="trip-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trip Type<span class="text-red-600">*</span></label>
                                    <input type="text" id="trip-type" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{old('trip-type', $booking->trip_type)}}" disabled>
                                    @error('trip-type')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Schedule Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="schedule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule <span class="text-red-600">*</span></label>
                                    <select id="schedule" name="schedule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled>Choose a Schedule</option>
                                        @foreach ($schedules->sortBy('departure_date') as $schedule)
                                            <option value="{{ $schedule->id }}" {{ old('schedule', $booking->schedule->id) == $schedule->id ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::parse($schedule->departure_date . ' ' . $schedule->departure_time)->format('M d, Y g:i a') . " - " . $schedule->ferries->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label for="trip" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trip Info</label>
                                    <input type="text" id="trip" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{$booking->schedule->departure_port . " To " . $booking->schedule->arrival_port}}" style="text-transform: capitalize;" readonly>
                                    @error('trip')
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
                                    <input type="text" name="contact-name" id="contact-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Will S Smith" required value="{{old('contact-name', $booking->contactPerson->name)}}" style="text-transform: capitalize;">
                                    @error('contact-name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Email<span class="text-red-600">*</span></label>
                                    <input type="email" name="contact-email" id="contact-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="name@email.com" required value="{{old('contact-email', $booking->contactPerson->email)}}">
                                    @error('contact-email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Phone<span class="text-red-600">*</span></label>
                                    <input type="number" name="contact-phone" id="contact-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="09123456789" required value="{{old('contact-phone', $booking->contactPerson->phone)}}">
                                    @error('contact-phone')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="contact-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Address<span class="text-red-600">*</span></label>
                                    <input type="text" name="contact-address" id="contact-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Will S Smith" required value="{{old('contact-address', $booking->contactPerson->address)}}" style="text-transform: capitalize;">
                                    @error('contact-address')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full my-1 sm:my-3">
                                <h5 class="mr-3 font-semibold dark:text-white">Booking's Payment Details</h5>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 mb-3">
                                <div class="w-full">
                                    <label for="payment-amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Amount<span class="text-red-600">*</span></label>
                                    <input type="number" name="payment-amount" id="payment-amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{old('payment-amount', $booking->payment->payment_amount)}}" required readonly>
                                    @error('payment-amount')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label for="payment-method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method<span class="text-red-600">*</span></label>
                                    <select id="payment-method" name="payment-method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                        <option value="" disabled>Choose a Type</option>
                                        <option value="Pending" {{ old('payment-method', $booking->payment->payment_method) == 'OTC' ? 'selected' : '' }}>OTC</option>
                                        <option value="Canceled" {{ old('payment-method', $booking->payment->payment_method) == 'Gcash' ? 'selected' : '' }}>Gcash</option>
                                        <option value="Paid" {{ old('payment-method', $booking->payment->payment_method) == 'Paymaya' ? 'selected' : '' }}>Paymaya</option>
                                        <option value="Paid" {{ old('payment-method', $booking->payment->payment_method) == 'Card' ? 'selected' : '' }}>Card</option>
                                        <option value="Paid" {{ old('payment-method', $booking->payment->payment_method) == 'Grab_pay' ? 'selected' : '' }}>Grab Pay</option>
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label for="payment-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Date<span class="text-red-600">*</span></label>
                                    <input type="date" name="payment-date" id="payment-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" required value="{{old('payment-date', $booking->payment->payment_date)}}">
                                    @error('payment-date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end items-end">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                                    Update Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script type="module">
            $(document).ready(function () {
                var originalScheduleId = $('#schedule').val(); // Assuming you have a hidden input with id 'schedule' to store the original schedule ID
                var adjustmentMade = false;
        
                // Event listener for schedule change
                $('#schedule').on('change', function () {
                    var selectedScheduleId = $(this).val();
                    var paymentAmountInput = $('#payment-amount');
                    var originalPaymentAmount = parseFloat(paymentAmountInput.val());
        
                    // Check if the schedule has changed
                    var isScheduleChanged = selectedScheduleId !== originalScheduleId;
        
                    // Update the payment amount based on the condition, but only once per change
                    if (isScheduleChanged && !adjustmentMade) {
                        originalPaymentAmount += 110;
                        adjustmentMade = true; // Mark that the adjustment has been made
                    } else if (!isScheduleChanged && adjustmentMade) {
                        originalPaymentAmount -= 110;
                        adjustmentMade = false; // Mark that the adjustment has been reverted
                    }
        
                    // Update the value in the payment amount input
                    paymentAmountInput.val(originalPaymentAmount.toFixed(2));
                });
            });
        </script>

@include('admin.partials.footer')