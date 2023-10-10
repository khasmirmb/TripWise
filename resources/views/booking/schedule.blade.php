@include('partials.header')

    @include('components.navigation')

    <section class="bg-slate-50 dark:bg-gray-900">
        <div class="bg-white dark:bg-gray-800 border-y-2 border-gray-200 shadow p-4 mx-auto">
            <ol class="items-center sm:flex justify-center">
                <li class="relative mb-6 sm:mb-0 text-center">
                    <div class="mt-2 sm:pr-5">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">{{$origin}}</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Origin</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center hidden sm:block">
                    <div class="mt-1 sm:pr-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center border-b-2 sm:border-b-0">
                    <div class="mt-2 sm:pr-5">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">{{$destination}}</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Destination</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center border-b-2 sm:border-b-0">
                    <div class="mt-2 sm:pr-4">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">{{$passenger}}</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Passenger</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center">
                    <div class="mt-2 sm:pr-4">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">{{$depart_date}}</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Departure</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center border-b-2 sm:border-b-0">
                    <div class="mt-2 sm:pr-4">
                        <h3 class="text-md font-semibold text-gray-900 dark:text-white">{{$return_date}}</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Return</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 text-center">
                    <div class="sm:pr-0"> 
                        <a href="#" class="inline-flex items-center justify-center p-5 text-base font-medium text-teal-600 dark:text-teal-300 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>                                              
                            <span class="w-full">Modify Itinerary</span>
                        </a>
                    </div>
                </li>
            </ol>         
        </div> 
    </section>

    <section class="bg-slate-50 dark:bg-gray-900">
        <div class="p-5">
            <div class="md:mx-10 p-4 mb-4">
                <div class="flex items-center">
                    <div class="flex items-center text-white dark:text-white relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 bg-teal-600 border-teal-600 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark ">
                                <path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-teal-600 dark:text-white hidden sm:block">Schedule</div>
                    </div>           
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out text-gray-500 dark:text-white"></div>
                    <div class="flex items-center text-gray-500 dark:text-white relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus ">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500 dark:text-white hidden sm:block">Passenger Info</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    <div class="flex items-center text-gray-500 dark:text-white relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail ">
                                <path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500 dark:text-white hidden sm:block">Payment</div>
                    </div>
                    <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    <div class="flex items-center text-gray-500 dark:text-white relative">
                        <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database ">
                                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500 dark:text-white hidden sm:block">Complete</div>
                    </div>
                </div>
            </div>
        </div> 
    </section>

    <section class="bg-slate-50 dark:bg-gray-900">
        <div class="bg-white dark:bg-gray-800 border-y-2 border-gray-200 shadow p-4 mx-auto">
            <div class="flex sm:p-1 my-2 p-0 gap-1 sm:gap-6">  
                <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$origin}}</h3>
                <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-11 sm:h-11 w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                </h3>
                <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$destination}}</h3>
            </div>
            <ul class="grid w-full gap-1 md:grid-cols-12">
                @foreach ($schedules as $schedule)
                <li>
                    <input type="radio" id="schedule{{$schedule->id}}" name="schedule" value="{{$schedule->id}}" class="hidden peer" required="">
                    <label for="schedule{{$schedule->id}}" class="inline-flex items-center justify-between p-3 w-autotext-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-teal-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                        <div class="block text-center">
                            <div class="w-full text-lg font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('d') }}</div>
                            <div class="w-full text-md">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('D') }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('M') }}</div>
                        </div>
                    </label>
                </li>
                @endforeach
            </ul>
        </div> 
    </section>
    
@include('partials.footer')