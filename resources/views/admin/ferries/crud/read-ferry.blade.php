<!-- Read modal -->
<div id="read-ferry{{$ferry->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                    <h3 class="font-semibold ">{{$ferry->name}}</h3>
                </div>
                <div>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="read-ferry{{$ferry->id}}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 w-full sm:gap-6 gap-2 mb-2 sm:mb-4">
                <div class="flex justify-center sm:col-span-2">
                    @if ($ferry->image)
                    <img src="{{asset('ferries/' . $ferry->image)}}" class="rounded-lg w-60 h-52">
                    @else
                    <img src="{{asset('ferries/default.png')}}" class="rounded-lg w-60 h-52">
                    @endif
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Description
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$ferry->description}}
                    </p>
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Capacity
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$ferry->capacity}}
                    </p>
                </div>
            </div>

            <div class="grid sm:grid-cols-{{count($ferry->fares)}} w-full sm:gap-6 gap-2 mb-2 sm:mb-4">
                @foreach ($ferry->fares as $fare)
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        {{$fare->type}}
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{"₱" .$fare->price}}
                    </p>
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Seats: <span class="font-normal text-gray-700 dark:text-gray-400">{{$fare->seats}}</span>
                    </h5>
                </div>
                @endforeach
            </div>

            <div class="grid sm:grid-cols-2 w-full sm:gap-6 gap-2">
                <div class="w-full flex justify-center items-center text-center sm:col-span-2">
                    <div id="custom-controls-gallery" class="relative w-full" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="relative w-full h-56 overflow-hidden rounded-lg md:h-96">
                             <!-- Item 1 -->
                            <div class="hidden duration-200 ease-in-out" data-carousel-item>
                                @if ($ferry->upper)
                                    <img src="{{asset('ferries/' . $ferry->upper)}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @endif
                                <span class="absolute top-1/2 left-1/2 text-xl font-bold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl rounded-lg bg-gray-800/30 p-2">Upper Deck</span>
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-200 ease-in-out" data-carousel-item>
                                @if ($ferry->middle)
                                    <img src="{{asset('ferries/' . $ferry->middle)}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @endif
                                <span class="absolute top-1/2 left-1/2 text-xl font-bold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl rounded-lg bg-gray-800/30 p-2">Middle Deck</span>
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-200 ease-in-out" data-carousel-item>
                                @if ($ferry->lower)
                                    <img src="{{asset('ferries/' . $ferry->lower)}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @else
                                    <img src="{{asset('images/no_image.png')}}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-fit" alt="">
                                @endif
                                <span class="absolute top-1/2 left-1/2 text-xl font-bold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl rounded-lg bg-gray-800/30 p-2">Lower Deck</span>
                            </div>
                        </div>
                        <div class="flex justify-center items-center pt-4">
                            <button type="button" class="flex justify-center items-center mr-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="flex justify-center items-center h-full cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-5">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-toggle="read-ferry{{$ferry->id}}">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>