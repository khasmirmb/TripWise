@include('partials.header')

    @include('components.navigation')

    <section class="bg-slate-50 dark:bg-gray-900">
        <main class="p-4 border-gray-300 dark:border-gray-600">
            <div class="rounded-lg mb-4 shadow-md">
                <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
                    <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full md:w-1/2">
                        <form action="#" method="GET" class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            </div>
                            <input type="text" name="query" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Search for for booking">
                        </div>
                        </form>
                    </div>
                    <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        <a href="{{route('booking.search.show')}}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add Booking
                        </a>
                    </div>
                    </div>
                </div>
                <div class="block overflow-x-auto bg-white dark:bg-gray-800">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
                            <tr>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Reference Number
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Payment
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Schedule
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Contact
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Trip Type
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            <div class="text-base font-semibold">{{ $bookings->firstItem() + $loop->index }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$booking->reference_number}}
                                </td>
                                <td class="text-center px-6 py-3 space-y-1">
                                    <p class="font-bold">
                                        @if ($booking->payment->payment_status == 'Pending')
                                            <span class="dark:text-yellow-300 text-yellow-700">   
                                                {{$booking->payment->payment_status}}
                                            </span>
                                        @elseif ($booking->payment->payment_status == 'Paid')
                                            <span class="dark:text-green-400 text-green-700">   
                                                {{$booking->payment->payment_status}}
                                            </span>
                                        @else
                                            <span class="dark:text-red-400 text-red-700">   
                                                {{$booking->payment->payment_status}}
                                            </span>
                                        @endif
                                    </p>
                                    <p>{{"₱" . $booking->payment->payment_amount}}</p>
                                    <p>{{$booking->payment->payment_method}}</p>
                                </td>
                                <td class="text-center px-6 py-3">
                                    <p class="font-bold">
                                        @if ($booking->schedule->schedule_status == 'In Progress')
                                            <span class="dark:text-yellow-300 text-yellow-700">   
                                                {{$booking->schedule->schedule_status}}
                                            </span>
                                        @elseif ($booking->schedule->schedule_status == 'Completed')
                                            <span class="dark:text-green-400 text-green-700">   
                                                {{$booking->schedule->schedule_status}}
                                            </span>
                                        @else
                                            <span class="dark:text-red-400 text-red-700">   
                                                {{$booking->schedule->schedule_status}}
                                            </span>
                                        @endif
                                    </p>
                                    <p>
                                        {{$booking->schedule->schedule_number}}
                                    </p>
                                </td>
                                <td class="text-center px-6 py-3">
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        {{$booking->contactPerson->name}}
                                    </p>
                                    <p>
                                        {{$booking->contactPerson->email}}
                                    </p>
                                    <p>
                                        {{$booking->contactPerson->phone}}
                                    </p>
                                </td>
                                <td class="text-center px-6 py-3">
                                    {{$booking->trip_type}}
                                </td>
                                <td class="text-center px-6 py-4 font-bold">
                                    @if ($booking->status == 'Pending')
                                        <span class="dark:text-yellow-300 text-yellow-700">   
                                            {{$booking->status}}
                                        </span>
                                    @elseif ($booking->status == 'Paid')
                                        <span class="dark:text-green-400 text-green-700">   
                                            {{$booking->status}}
                                        </span>
                                    @else
                                        <span class="dark:text-red-400 text-red-700">   
                                            {{$booking->status}}
                                        </span>
                                    @endif
                                </td>
                                @if ($booking->status == 'Paid')
                                <td class="px-6 py-3 text-center">
                                    @php
                                        if ($booking->passengers) {
                                            $passengers = $booking->passengers;
                                            
                                            // Check if any passenger has a null seat_id
                                            $hasNullSeat = false;
                                            foreach ($passengers as $passenger) {
                                                if ($passenger->seat_id === null) {
                                                    $hasNullSeat = true;
                                                    break; // No need to check further if one passenger has a null seat_id
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="flex items-center space-x-4 justify-center">
                                        <a href="#" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" fill="currentColor" aria-hidden="true">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier"> 
                                                    <path d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                            Modify
                                        </a>
                                        @if (!$hasNullSeat)
                                            <a href="{{ route('generate.pdf', ['payment' => $booking->payment->id, 'contact' => $booking->contactPerson->id, 'booking' => $booking->id]) }}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" id="paid">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z"></path>
                                                        <path d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"></path>
                                                    </g>
                                                </svg>
                                                Download
                                            </a>
                                        @endif
                                        @if ($hasNullSeat)
                                            <a href="{{ route('booking.seats', ['user' => $booking->user_id, 'booking' => $booking->id]) }}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"fill="currentColor" aria-hidden="true" viewBox="0 0 50 50">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M5 10C3.347656 10 2 11.347656 2 13L2 26.8125C3.296875 25.6875 4.9375 24.777344 7 24.0625L7 20C7 17.339844 11.542969 17 15.5 17C19.457031 17 24 17.339844 24 20L24 22C24.335938 21.996094 24.65625 22 25 22C25.34375 22 25.664063 21.996094 26 22L26 20C26 17.339844 30.542969 17 34.5 17C38.457031 17 43 17.339844 43 20L43 24.03125C45.058594 24.742188 46.691406 25.671875 48 26.8125L48 13C48 11.347656 46.652344 10 45 10 Z M 25 24C5.90625 24 -0.015625 27.53125 0 37L50 37C50.015625 27.46875 44.09375 24 25 24 Z M 0 39L0 50L7 50L7 46C7 44.5625 7.5625 44 9 44L41 44C42.4375 44 43 44.5625 43 46L43 50L50 50L50 39Z"></path>
                                                    </g>
                                                </svg>
                                                Seats
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                @else
                                <td class="px-6 py-3 text-center">
                                    <div class="flex items-center space-x-4 justify-center">
                                        <a href="{{ route('generate.pdf', ['payment' => $booking->payment->id, 'contact' => $booking->contactPerson->id, 'booking' => $booking->id]) }}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" id="not-paid">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z"></path>
                                                    <path d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"></path>
                                                </g>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </td>
                                @endif
                            </tr>
    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="relative overflow-hidden bg-white rounded-b-lg dark:bg-gray-800">
                    <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $bookings->firstItem() }}-{{ $bookings->lastItem() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $bookings->total() }}</span>
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            @php
                                // Define how many pages to show on each side of the current page
                                $pagesToShow = 2;
                                $currentPage = $bookings->currentPage();
                                $lastPage = $bookings->lastPage();
                                $startPage = max($currentPage - $pagesToShow, 1);
                                $endPage = min($currentPage + $pagesToShow, $lastPage);
                            @endphp
                            @if ($bookings->onFirstPage())
                                <li>
                                    <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $bookings->previousPageUrl() . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                            @endif
                            @foreach (range($startPage, $endPage) as $page)
                                <li>
                                    <a href="{{ $bookings->url($page) . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}"
                                      @if ($page == $currentPage) aria-current="page"
                                      class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight border text-teal-600 bg-teal-50 border-teal-300 hover:bg-teal-100 hover:text-teal-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                      @else
                                      class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                      @endif >{{ $page }}</a>
                                </li>
                            @endforeach
                            @if ($bookings->hasMorePages())
                                <li>
                                    <a href="{{ $bookings->nextPageUrl() . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>            
            </div>
        </main>
    </section>

<div id="toast-downloading" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8">
        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-teal-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Spinner</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">Your download is being process please wait.</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-downloading" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script type="module">
    $(document).ready(function() {
        $('#paid, #not-paid').click(function() {
            // Show the loading message
            $('#toast-downloading').show();

            setTimeout(function() {
                // Hide the loading message based on timer
                $('#toast-downloading').hide();
            }, 8000); // 8 seconds before hiding
        });
    });
</script>

@include('partials.footer')