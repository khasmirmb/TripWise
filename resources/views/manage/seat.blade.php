@include('partials.header')

@include('components.navigation')

<section class="bg-white dark:bg-gray-800">
    <div class="py-8 px-4 mx-auto max-w-7xl lg:py-10">
        @php
        $passenger_seat = true;
        foreach ($passengers as $passenger) {
            if ($passenger->seat_id === null) {
                $passenger_seat = false;
                break;
            }
        }
        @endphp

        @if ($passenger_seat)
            <div class="my-5">
                <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Thank you for Booking</span></h1>
                <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">You can download your e-ticket below.</p>
            </div>
            @if ($booking)
            <div class="flex w-full justify-start my-5">
                <a href="{{ route('generate.pdf', ['payment' => $payment->id, 'contact' => $contact->id, 'booking' => $booking->id]) }}" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" id="download-ticket">Download E-Ticket</a>
            </div>
            @endif
        @else
            <div class="my-2 ml-2">
                <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-300">Seat Selection</h3>
            </div>
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-justify">
                    <span class="font-medium text-red-600">Important!</span> 
                    Once you have selected a seat, it cannot be changed. Please choose your seat carefully.
                </div>
            </div>
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-justify">
                    <span class="font-medium text-red-600">Important!</span> 
                    Please be aware that seats highlighted in <span class="text-red-600 font-bold">RED</span> are currently reserved.
                </div>
            </div>

            @if ($passengers)
                @if (!$passenger_seat)
                    @if ($ferry)
                        <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                <!-- Item 1 -->
                                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                    @if ($ferry->upper)
                                    <img src="{{asset('ferries/' . $ferry->upper)}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @endif
                                </div>
                                <!-- Item 2 -->
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    @if ($ferry->middle)
                                    <img src="{{asset('ferries/' . $ferry->middle)}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @endif
                                </div>
                                <!-- Item 3 -->
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    @if ($ferry->lower)
                                    <img src="{{asset('ferries/' . $ferry->lower)}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover" alt="...">
                                    @endif
                                </div>
                            </div>
                            <!-- Slider indicators -->
                            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                            </div>
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>
                    @endif
                    @foreach ($passengers as $passenger)
                        @if ($passenger->seat_id === null)
                        <div class="depart-passenger block">
                            <div class="block pl-2 pb-3">
                                <div class="flex items-center space-x-4 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-800 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div class="font-medium text-gray-800 dark:text-white">
                                        <div>{{ $passenger->first_name . " " . $passenger->middle_name[0] . " " . $passenger->last_name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $passenger->accommodation }}</div>
                                        <h6 class="text-base font-semi text-gray-800 dark:text-gray-300">Departure</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="border-2 rounded-xl p-5 dark:border-gray-500 border-gray-300">
                                <ul class="grid w-full gap-2 lg:grid-cols-12 md:grid-cols-8 grid-cols-4">
                                    @foreach ($seats as $seat)
                                        <li>
                                            @if ($seat->seat_status == 'booked')
                                            <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="seat_{{ $passenger->id }}" value="{{ $seat->id }}" class="hidden peer" data-seat-id="{{ $seat->id }}" disabled>
                                            <label for="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" class="inline-flex items-center justify-center w-12 p-2 text-red-500 bg-red-100 border border-red-200 rounded-lg cursor-pointer dark:hover:text-red-300 dark:border-red-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-red-600 hover:bg-red-100 dark:text-red-400 dark:bg-red-800 dark:hover:bg-red-700">                           
                                                <div class="block">
                                                    <div class="w-full text-base font-bold">{{ $seat->seat_number }}</div>
                                                </div>
                                            </label>
                                            @else
                                            <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="seat_{{ $passenger->id }}" value="{{ $seat->id }}"  class="hidden peer" data-seat-id="{{ $seat->id }}">
                                            <label for="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" class="inline-flex items-center justify-center w-12 p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                                <div class="block">
                                                    <div class="w-full text-base font-bold">{{ $seat->seat_number }}</div>
                                                </div>
                                            </label>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="flex justify-end w-full py-2">
                                <button data-modal-target="depart_modal{{$passenger->id}}" data-modal-toggle="depart_modal{{$passenger->id}}" class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800" type="button">
                                    Select
                                </button>

                                <div id="depart_modal{{$passenger->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="depart_modal{{$passenger->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to update the seat for this passenger?</h3>
                                                <button type="button" data-modal-hide="depart_modal{{$passenger->id}}" class="seat-button text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" data-passenger-id="{{ $passenger->id }}">Yes, Update Seat</button>
                                                <button data-modal-hide="depart_modal{{$passenger->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            @endif

        @endif
    </div>
</section>

<div id="toast-success" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">Seat updated successfully!</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<div id="toast-warning" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
        </svg>
        <span class="sr-only">Warning icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">Please select a seat.</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<div id="toast-error" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">There was something wrong please try again.</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-error" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

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
    $(document).ready(function () {
        $('#download-ticket').click(function() {
            // Show the loading message
            $('#toast-downloading').show();
            setTimeout(function() {
                // Hide the loading message based on timer
                $('#toast-downloading').hide();
            }, 8000); // 8 seconds before hiding
        });
        // Handle the click event of the "Select" button
        $('.seat-button').click(function () {
            var passengerId = $(this).data('passenger-id');
            var selectedSeat = $('input[name="seat_' + passengerId + '"]:checked').val();
            if (!selectedSeat) {
                // Show the warning toast
                $("#toast-warning").fadeIn();
                $("#toast-warning button").on("click", function() {
                    $("#toast-warning").fadeOut();
                });
                // Hide the toast after a certain time (e.g., 10 seconds)
                setTimeout(function () {
                    $("#toast-warning").fadeOut();
                }, 10000); // 10000 milliseconds (10 seconds)
            }
    
            // Send an AJAX request to update the passenger's seat_number
            $.ajax({
                type: 'GET',
                url: '/update-seat', // Update the URL to your route
                data: {
                    passengerId: passengerId,
                    selectedSeat: selectedSeat,
                },
                success: function (response) {
                    // Handle the response from the server, e.g., show a success message
                    console.log(response);
                    $("#toast-success").fadeIn();
                    // Hide the toast after a certain time (e.g., 10 seconds)
                    setTimeout(function () {
                        $("#toast-success").fadeOut();
                    }, 10000); // 10000 milliseconds (10 seconds)
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., show an error message
                    console.error(xhr.responseText);
                    if (xhr.status === 404) {
                        // Seat not found, show an error toast
                        $("#toast-error").fadeIn();
                        // Hide the error toast after a certain time (e.g., 10 seconds)
                        setTimeout(function () {
                            $("#toast-error").fadeOut();
                        }, 10000); // 10000 milliseconds (10 seconds)
                    }
                }
            });
        });
    });
</script>

@include('partials.footer')