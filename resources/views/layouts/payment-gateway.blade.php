<form method="post" action="{{route('booking.payment.process')}}">
    @csrf
    <div class="px-4 pt-8">
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
        <div class="flex items-center p-4 my-4 text-base text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="text-justify">
                Please note that our fare discounts are as follows:
                <span class="text-red-600">20% discount for PWD (Persons with Disabilities) and Senior Citizens.</span>
                <span class="text-red-600">10% discount for Students.</span>
            </div>
        </div>
        <div class="mt-4 mb-1 border bg-white border-gray-300 dark:bg-gray-700 dark:border-0 rounded-xl p-5">
            <div class="mt-4 mb-3">
                <p class="text-xl font-semibold mb-2 text-gray-700 dark:text-white">Payment Methods:</p>
                <div class="flex">
                    <ul class="grid w-full gap-2 md:grid-cols-3">
                        <li>
                            <input type="radio" id="counter" name="payment_method" value="counter" class="hidden peer" checked>
                            <label for="counter" class="inline-flex items-center justify-between w-full p-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-600">                           
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Over the Counter</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="gcash" name="payment_method" value="gcash" class="hidden peer">
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
            @php

            if (!is_null($return_date)){
                $count_passenger = count($passengers);
                $depart_total = $dep_sched_price * $count_passenger;

                $dep_total = $dep_sched_price * $count_passenger;
        
                // Calculate the return total based on passenger classification
                $return_total = $ret_sched_price * $count_passenger;

                $ret_total = $ret_sched_price * $count_passenger;
        
                $studentCount = 0;
                $pwdCount = 0;
                $seniorCount = 0;
                $totalDiscount = 0; // Initialize totalDiscount
        
                foreach ($passengers as $passengerData) {
                    $classification = $passengerData['classification'];
        
                    if ($classification === 'Student') {
                        $studentCount++;
                        // Apply a 10% discount for students on the return trip
                        $return_total -= ($ret_sched_price * 0.10);
                        $depart_total -= ($dep_sched_price * 0.10);
                    } elseif ($classification === 'PWD') {
                        $pwdCount++;
                        // Apply a 20% discount for PWD on the return trip
                        $return_total -= ($ret_sched_price * 0.20);
                        $depart_total -= ($dep_sched_price * 0.20);
                    } elseif ($classification === 'Senior') {
                        $seniorCount++;
                        // Apply a 20% discount for seniors on the return trip
                        $return_total -= ($ret_sched_price * 0.20);
                        $depart_total -= ($dep_sched_price * 0.20);
                    }
                }

                $totalDiscount += ($studentCount * ($ret_sched_price * 0.10)) + 
                        ($pwdCount * ($ret_sched_price * 0.20)) + 
                        ($seniorCount * ($ret_sched_price * 0.20)) +
                        ($studentCount * ($dep_sched_price * 0.10)) + 
                        ($pwdCount * ($dep_sched_price * 0.20)) + 
                        ($seniorCount * ($dep_sched_price * 0.20));
        
                $total = $depart_total + $return_total;

            } else {
                $count_passenger = count($passengers);
                $depart_total = $dep_sched_price * $count_passenger;

                $dep_total = $dep_sched_price * $count_passenger;
        
                $studentCount = 0;
                $pwdCount = 0;
                $seniorCount = 0;
                $totalDiscount = 0; // Initialize totalDiscount
        
                foreach ($passengers as $passengerData) {
                    $classification = $passengerData['classification'];
        
                    if ($classification === 'Student') {
                        $studentCount++;
                        // Apply a 10% discount for students on the departure trip
                        $depart_total -= ($dep_sched_price * 0.10);
                    } elseif ($classification === 'PWD') {
                        $pwdCount++;
                        // Apply a 20% discount for PWD on the departure trip
                        $depart_total -= ($dep_sched_price * 0.20);
                    } elseif ($classification === 'Senior') {
                        $seniorCount++;
                        // Apply a 20% discount for seniors on the departure trip
                        $depart_total -= ($dep_sched_price * 0.20);
                    }
                }

                $totalDiscount = ($studentCount * ($dep_sched_price * 0.10)) +
                    ($pwdCount * ($dep_sched_price * 0.20)) +
                    ($seniorCount * ($dep_sched_price * 0.20));
        
                $total = $depart_total;
            }
        @endphp
            <!-- Total -->
            <div class="mt-6 border-t border-b py-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Passenger:</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{$count_passenger . 'x '}}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Depart Total:</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{'₱ ' . number_format($dep_total, 2)}}</p>
                    <p hidden id="depart_total">{{$depart_total}}</p>
                </div>
                @if (!is_null($return_date))
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Return Total:</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{'₱ ' . number_format($ret_total, 2)}}</p>
                    <p hidden id="return_total">{{$return_total}}</p>
                </div>
                @endif
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Discount:</p>
                    <p id="discount" class="font-semibold text-gray-900 dark:text-white">
                    @if ($totalDiscount > 0)
                        {{'- '. '₱ ' . number_format($totalDiscount, 2) }}
                    @else
                        {{'₱ ' . number_format($totalDiscount, 2) }}
                    @endif
                    </p>
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

                <div hidden>
                <input type="hidden" name="dep_sched_id" value="{{$dep_sched_id}}">

                <input type="hidden" name="dep_sched_type" value="{{$dep_sched_type}}">

                <input type="hidden" name="dep_total" value="{{ $dep_total }}">

                <input type="hidden" name="totalDiscount" value="{{ $totalDiscount }}">

                @if(!is_null($return_date))
                <input type="hidden" name="ret_sched_id" value="{{$ret_sched_id}}">

                <input type="hidden" name="ret_total" value="{{ $ret_total }}">
            
                <input type="hidden" name="ret_sched_type" value="{{$ret_sched_type}}">
                @endif
                </div>

                <div class="w-full">
                    <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 rounded-lg text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="module">
$(document).ready(function() {
    const totalAmountElement = $("#total_amount");
    const serviceChargeElement = $("#service_charge");
    const departTotalElement = $("#depart_total");
    const returnTotalElement = $("#return_total");
    const totalInput = $("#total_input"); // Add total input field
    
    // Retrieve the initial values for depart and return totals
    const departTotal = parseFloat(departTotalElement.text());
    const returnTotal = parseFloat(returnTotalElement.text());
    
    // Initialize the total amount and service charge based on the default selection
    const defaultTotal = calculateTotal('counter', departTotal, returnTotal);
    
    totalAmountElement.text('₱ ' + defaultTotal.total);
    serviceChargeElement.text('₱ ' + defaultTotal.serviceCharge);
    
    // Function to calculate total and service charge
    function calculateTotal(paymentMethod, departTotal, returnTotal) {
        let total = departTotal + (returnTotal || 0);
        let serviceCharge = 0;
        
        if (paymentMethod === 'gcash') {
            serviceCharge = total * 0.025;
        } else if (paymentMethod === 'paymaya') {
            serviceCharge = total * 0.02;
        } else if (paymentMethod === 'grab_pay') {
            serviceCharge = total * 0.022;
        } else if (paymentMethod === 'card') {
            serviceCharge = total * 0.035;
        }
        
        total += serviceCharge;
        
        return {
            total: total.toFixed(2),
            serviceCharge: serviceCharge.toFixed(2),
        };
    }
    
    // Handle payment method change
    $("input[name='payment_method']").change(function() {
        const paymentMethod = $(this).val();
        const result = calculateTotal(paymentMethod, departTotal, returnTotal);
        
        totalAmountElement.text('₱ ' + result.total);
        serviceChargeElement.text('₱ ' + result.serviceCharge);
    });
});
</script>