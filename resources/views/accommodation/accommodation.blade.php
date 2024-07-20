@include('partials.header')
    
@include('components.navigation')

<section class="bg-white dark:bg-gray-900 pb-5">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Accommodation</h2>
            <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Check out the various types of ferries along with their accommodation options.</p>
        </div> 
        <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
            @foreach ($ferries as $ferry)
            <div class="items-center bg-white rounded-lg shadow-md sm:flex dark:bg-gray-800 dark:border-gray-700">
                <a href="#" data-modal-toggle="check-accommodation{{$ferry->id}}">
                    @if ($ferry->image)
                    <img class="rounded-lg sm:rounded-none sm:rounded-l-lg w-full h-40 object-cover" src="{{asset('ferries/' . $ferry->image)}}" alt="Ferry Image">
                    @else
                    <img class="rounded-lg sm:rounded-none sm:rounded-l-lg w-full h-40 object-cover" src="{{asset('ferries/default.png')}}" alt="Ferry Image">
                    @endif
                </a>
                <div class="p-5">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{$ferry->name}}
                    </h3>
                    <span class="text-gray-500 dark:text-gray-400">Capacity: {{$ferry->capacity}}</span>
                    <div class="mt-2">
                        <button id="readProductButton" data-modal-target="check-accommodation{{$ferry->id}}" data-modal-toggle="check-accommodation{{$ferry->id}}" class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800" type="button">
                            Accommodation
                        </button>
                    </div>
                </div>
            </div>

            <!-- Accommodation Read Modal -->
            <div id="check-accommodation{{$ferry->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-4xl max-h-full">
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                            <div class="text-base sm:text-lg text-gray-900 md:text-xl dark:text-white">
                                <h3 class="font-semibold ">
                                    {{$ferry->name}}
                                </h3>
                            </div>
                            <div>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="check-accommodation{{$ferry->id}}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-1 w-full sm:gap-6 gap-2 mb-2 sm:mb-4">
                            @foreach ($ferry->fares as $fare)
                            <div class="block sm:flex sm:justify-between w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                                <div class="sm:block flex sm:space-x-0 space-x-3 justify-center">
                                    <h5 class="mb-1 sm:text-2xl text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{$fare->type}}
                                    </h5>
                                    <p class="font-normal sm:text-2xl text-base text-gray-700 dark:text-gray-400">
                                        {{"₱" .$fare->price}}
                                    </p>
                                    <h5 class="mb-1 sm:text-2xl text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                        Seats: <span class="font-normal text-gray-700 dark:text-gray-400">{{$fare->seats}}</span>
                                    </h5>
                                </div>
                                <div class="grid sm:grid-cols-3 gap-4">
                                    <div class="w-full">
                                        @if ($fare->fare_image1)
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('ferries/' . $fare->fare_image1)}}" alt="Fare Image1">
                                        @else
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('images/no_image.png')}}" alt="Fare Image1">
                                        @endif
                                    </div>
                                    <div class="w-full">
                                        @if ($fare->fare_image2)
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('ferries/' . $fare->fare_image2)}}" alt="Fare Image2">
                                        @else
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('images/no_image.png')}}" alt="Fare Image2">
                                        @endif
                                    </div>
                                    <div class="w-full">
                                        @if ($fare->fare_image3)
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('ferries/' . $fare->fare_image3)}}" alt="Fare Image3">
                                        @else
                                            <img class="h-52 w-52 mx-auto rounded-lg object-cover" src="{{asset('images/no_image.png')}}" alt="Fare Image3">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-5">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-toggle="check-accommodation{{$ferry->id}}">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>  
    </div>
</section>

@include('partials.footer')