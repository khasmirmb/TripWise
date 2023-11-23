@include('partials.header')

    @include('components.navigation')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl dark:text-white">Rebooking Payment</h2>
                    <p class="mx-auto mb-2 max-w-2xl font-light text-gray-500 md:mb-4 sm:text-xl dark:text-gray-400">Please review the details of your booking below. If everything is correct, proceed to payment using your preferred method.
                    </p>
                </div>
                <div class="grid w-full lg:px-8 lg:grid-cols-2 lg:py-8 px-4 py-4">
                    <div class="px-4 pt-8">
                        <p class="ml-2 text-xl font-medium text-gray-700 dark:text-white">Trip Summary</p>
                        <p class="ml-2 text-gray-400">Please review your booking details below to ensure accuracy before finalizing.</p>
                        <div class="mt-8 space-y-1 rounded-lg bg-slate-100 dark:bg-gray-700">
                            <div class="bg-teal-600 rounded-t-lg p-3">
                                <p class="text-xl font-medium text-white text-center">Trip Summary</p>
                            </div>
                            <div class="departure-summary px-3 sm:px-6 pb-3">
                                <div class="flex flex-col sm:flex-row">
                                    @if ($schedule->ferries->image)
                                    <img class="m-2 h-32 w-46 rounded-md mx-auto object-cover object-center" src="{{asset('ferries/' . $schedule->ferries->image)}}" alt="Ferry Image" />
                                    @else
                                    <img class="m-2 h-32 w-46 rounded-md mx-auto object-cover object-center" src="{{asset('ferries/default.png')}}" alt="Ferry Image" />
                                    @endif
                                <div class="flex w-full flex-col px-4 sm:py-9 pb-2 text-center">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Vessel</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$schedule->ferries->name}}</span>
                                </div>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Origin:</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$schedule->departure_port}}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Destination:</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$schedule->arrival_port}}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Date:</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($schedule->departure_date))}}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Arrival Date:</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($schedule->arrival_date))}}</span>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Time:</span>
                                    <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("g:i a", strtotime($schedule->departure_time))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pt-8">
                        <form method="POST" action="{{ route('booking.rebook.payment-process', ['booking' => $booking->id, 'schedule' => $schedule->id]) }}">
                            @csrf
                            <p class="ml-2 text-xl font-medium text-gray-700 dark:text-white">Payment Summary</p>
                            <p class="ml-2 text-gray-400">Your payment summary is displayed here.</p>
                            <div class="flex items-center p-4 my-4 text-base text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="text-justify">
                                    Service charge will vary depending on payment option selected.
                                </div>
                            </div>
                            <div class="mt-4 mb-1 border bg-white border-gray-300 dark:bg-gray-700 dark:border-0 rounded-xl p-5">
                                <div class="mt-4 mb-3">
                                    <p class="text-xl font-semibold mb-2 text-gray-700 dark:text-white">Payment Methods:</p>
                                    <div class="flex">
                                        <ul class="grid w-full gap-2 md:grid-cols-3">
                                            <li>
                                                <input checked type="radio" id="gcash" name="payment_method" value="gcash" class="hidden peer">
                                                <label for="gcash" class="inline-flex items-center justify-between w-full p-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">                           
                                                    <div class="block">
                                                        <div class="w-full text-lg font-semibold">GCash</div>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="radio" id="paymaya" name="payment_method" value="paymaya" class="hidden peer">
                                                <label for="paymaya" class="inline-flex items-center justify-between w-full p-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">                           
                                                    <div class="block">
                                                        <div class="w-full text-lg font-semibold">PayMaya</div>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="radio" id="card" name="payment_method" value="card" class="hidden peer">
                                                <label for="card" class="inline-flex items-center justify-between w-full p-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">                           
                                                    <div class="block">
                                                        <div class="w-full text-lg font-semibold">Card</div>
                                                    </div>
                                                </label>
                                            </li>
                                            <li>
                                                <input type="radio" id="grab_pay" name="payment_method" value="grab_pay" class="hidden peer">
                                                <label for="grab_pay" class="inline-flex items-center justify-between w-full p-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">                           
                                                    <div class="block">
                                                        <div class="w-full text-lg font-semibold">Grab Pay</div>
                                                    </div>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Total -->
                                <div class="mt-6 border-t border-b py-2">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Passenger:</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{count($booking->passengers) . 'x '}}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Rebook Fee:</p>
                                        <p id="rebook_fee" class="font-semibold text-gray-900 dark:text-white">{{"₱ " . number_format($final_amount, 2)}}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Service Charge:</p>
                                        <p id="service_charge" class="font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
                                <div class="mt-6 flex items-center justify-between border-b py-2 mb-5">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Total</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        <span id="total_amount">0.00</span>
                                    </p>
                                </div>
                                <div class="block">
                                    <div class="w-full">
                                        <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 rounded-lg text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Proceed to Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="module">
        $(document).ready(function () {
            // Handle radio button change event
            $('input[name="payment_method"]').change(function () {
                updateTotal();
            });
    
            // Initial update when the page loads
            updateTotal();
        });
    
        function updateTotal() {
            
            var rebookFee = parseFloat($('#rebook_fee').text().replace('₱ ', '').replace(',', '')) || 0;
    
            // Declare total variable
            var total;
    
            // Calculate the total
            total = rebookFee;
    
            // Get the selected payment method
            var paymentMethod = $('input[name="payment_method"]:checked').val();
    
            // Calculate the service charge based on the payment method
            var serviceCharge = 0;
    
            if (paymentMethod === 'gcash') {
                serviceCharge = total * 0.025;
            } else if (paymentMethod === 'paymaya') {
                serviceCharge = total * 0.02;
            } else if (paymentMethod === 'grab_pay') {
                serviceCharge = total * 0.022;
            } else if (paymentMethod === 'card') {
                serviceCharge = total * 0.035;
            }
    
            // Update the service charge and total in the HTML
            $('#service_charge').text('₱ ' + serviceCharge.toFixed(2));
            $('#total_amount').text('₱ ' + (total + serviceCharge).toFixed(2));
        }
    </script>
    
    
    
@include('partials.footer')