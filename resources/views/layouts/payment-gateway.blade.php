<form method="post" action="">
    @csrf
    <div class="px-4 pt-8">
        <p class="ml-2 text-xl font-medium text-gray-700 dark:text-white">Payment Summary</p>
        <p class="ml-2 text-gray-400">Your payment summary is displayed here.</p>
        <div class="mt-8 mb-1 border bg-white border-gray-300 dark:bg-gray-700 dark:border-0 rounded-xl p-5">
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
                    </ul>
                </div>
            </div>

            @php

                if (!is_null($return_date)){

                    $count_passenger = count($passengers);

                    $depart_total = $dep_sched_price * $count_passenger;

                    $return_total = $ret_sched_price * $count_passenger;

                    $total = $depart_total + $return_total;

                }else {

                    $count_passenger = count($passengers);

                    $depart_total = $dep_sched_price * $count_passenger;
                    
                    $total = $depart_total;
                }

            @endphp
            <!-- Total -->
            <div class="mt-6 border-t border-b py-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{$count_passenger . 'x '}} Passenger</p>
                    <p class="font-semibold text-gray-900 dark:text-white">{{'₱' . $depart_total}}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Discount</p>
                    <p class="font-semibold text-gray-900 dark:text-white">₱0.00</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Service Charge</p>
                    <p class="font-semibold text-gray-900 dark:text-white">₱0.00</p>
                </div>
                <p class="text-xs text-gray-900 dark:text-white">Service charge will vary depending on payment option selected.</p>
            </div>
            <div class="mt-6 flex items-center justify-between border-b py-2 mb-5">
                <p class="text-sm font-medium text-gray-900 dark:text-white">Total</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ '₱' . $total}}</p>
            </div>
            <div class="block">
                <div class="w-full">
                    <button type="submit" class="w-full px-5 py-2.5 text-sm font-medium text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 rounded-lg text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>
</form>