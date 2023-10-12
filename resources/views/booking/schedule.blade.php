@include('partials.header')

    @include('components.navigation')

    @include('layouts.itinerary')

    @include('layouts.progress-schedule')

    <section class="bg-slate-50 dark:bg-gray-900">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-5 bg-white dark:bg-gray-800 p-3">
            <!-- First column -->
            <div class="col-span-2">
                <div class="flex my-2 gap-1 sm:gap-4">  
                    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$origin}}</h3>
                    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-11 sm:h-11 w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                    </h3>
                    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$destination}}</h3>
                </div>
                <div class="dates_slick flex">
                    @foreach ($schedules as $schedule)
                    <div>
                        <input {{$loop->first ? 'checked' : ''}} type="radio" id="schedule{{$schedule->id}}" name="schedule" value="{{$schedule->id}}" class="hidden peer" required="">
                        <label for="schedule{{$schedule->id}}" class="inline-flex items-center justify-between p-3 w-autotext-gray-500 bg-white border-2 border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-teal-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                        <div class="block text-center">
                            <div class="w-full text-lg font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('d') }}</div>
                            <div class="w-full text-md">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('D') }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->departure_date)->format('M') }}</div>
                        </div>
                        </label>
                    </div>
                    @endforeach
                </div>
    
                <div class="w-full bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 my-4">
                    <div class="flex space-x-4 p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 mb-6">
                        <h5 class="text-xl sm:text-5xl font-bold tracking-tight text-gray-900 dark:text-white mr-3">6:00 AM</h5>
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="US">Economy</option>
                            <option value="CA">Aircon</option>
                        </select>
                    </div>
                    <div class="px-5 pb-5">
                        <div class="flex items-center">
                            <h5 class="text-2xl sm:text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">The Winchester</h5>
                        </div>
                        <div class="flex items-center mt-2.5 mb-5">
                            <span class="bg-blue-100 text-blue-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Vessel</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-3xl font-medium text-gray-900 dark:text-white">₱399</span>
                            <a href="#" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Select</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- First column -->
    
            <!-- Second column -->
            <div class="col-span-1">
                <div class="flex my-2 gap-1 sm:gap-4 mb-4">  
                    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">Summary</h3>
                </div>
                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1">
                      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                        <span class="flex items-center">Departure</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                      </button>
                    </h2>
                    <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                      <div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <ol class="relative border-l border-gray-400 dark:border-white">                  
                            <li class="mb-10 ml-6">            
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-md font-semibold text-gray-900 dark:text-white">{{$origin}}</h3>
                            </li>
                            <li class="mb-10 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                    <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                    </svg>
                                </span>
                                <h3 class="mb-1 text-md font-semibold text-gray-900 dark:text-white">{{$destination}}</h3>
                            </li>
                        </ol>
                      </div>
                    </div>
                </div>
                                    
            </div>
            <!-- Second column -->
        </div>
        <!-- Grid -->
    </section>
    
@include('partials.footer')