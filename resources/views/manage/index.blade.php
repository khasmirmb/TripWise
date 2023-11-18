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
                        <a href="#" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
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
                                    Schedule Number
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
                                <td class="px-6 py-3 text-center">
                                    TEST
                                </td>
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

@include('partials.footer')