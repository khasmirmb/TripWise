@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

    <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
        <div class="rounded-lg mb-4 shadow-md">
            <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Bookings</span>
                            </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <form action="{{route('admin.booking.search')}}" method="GET" class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        </div>
                        <input type="text" name="query" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Search for for booking" value="{{ old('query', request('query')) }}">
                    </div>
                    </form>
                </div>
                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <a href="{{route('admin.booking.add')}}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
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
                                <button id="booking-action{{$booking->id}}-button" data-dropdown-toggle="booking-action{{$booking->id}}" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                </div>
                                <div id="booking-action{{$booking->id}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm" aria-labelledby="booking-action{{$booking->id}}-button">
                                        <li>
                                            <a href="{{route('admin.booking.edit' , ['booking' => $booking->id])}}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                </svg>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button data-modal-target="booking-read{{$booking->id}}" data-modal-toggle="booking-read{{$booking->id}}" type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                Preview
                                            </button>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.generate.pdf', ['payment' => $booking->payment->id, 'contact' => $booking->contactPerson->id, 'booking' => $booking->id]) }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-teal-500 dark:hover:text-teal-400">
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
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        @include('admin.bookings.crud.read-booking')

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

@include('admin.partials.footer')