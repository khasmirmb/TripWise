@include('partials.header')

    @include('components.navigation')

    @include('layouts.itinerary')

    @include('layouts.progress-schedule')

    <section class="bg-slate-50 dark:bg-gray-800">
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
                <div class="dates_slick flex border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    @for ($i = 0; $i < 17; $i++)
                    <div>
                        @php

                            $validated_date = \Carbon\Carbon::createFromFormat('d/m/Y', $depart_date);

                            $valid_date = $validated_date->addDays($i);

                            $maximum_date = $valid_date->format('Y-m-d');

                        @endphp

                        <input @if ($i == 0)
                        checked
                        @endif  data='{{$i}}' type="radio" id="schedule{{$i}}" name="schedule" value="{{ $maximum_date }}" class="hidden peer">
                        <label for="schedule{{$i}}" class="inline-flex items-center justify-between p-3 w-autotext-gray-500 bg-white border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-teal-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                        <div class="block text-center">
                            <div class="w-full text-lg font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $maximum_date)->format('d') }}</div>
                            <div class="w-full text-md">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $maximum_date)->format('D') }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $maximum_date)->format('M') }}</div>
                        </div>
                        </label>
                    </div>
                    @endfor
                </div>

                @foreach ($schedules as $schedule)

                @php

                    $arrival = \Carbon\Carbon::createFromFormat('H:i:s' , $schedule->arrival_time);

                    $departure = \Carbon\Carbon::createFromFormat('H:i:s' , $schedule->departure_time);

                    
                    $totalDuration = $arrival->diffInHours($departure);

                    $fares = DB::table('fares')
                    ->where('ferry_id', '=', $schedule->ferry_id)
                    ->get();
                    
                @endphp

                <div class="{{$schedule->departure_date}} box w-full bg-white border-2 border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 my-4"     @if ($loop->first) style="display: block"    @endif style="display: none">
                    <div class="flex justify-between space-x-2 p-6 bg-white border-b-2 border-gray-200 dark:bg-gray-800 dark:border-gray-700 mb-6">
                        <h5 class="text-2xl sm:text-5xl font-medium tracking-tight text-gray-700 dark:text-white mt-2 sm:mt-0">{{\Carbon\Carbon::createFromFormat('H:i:s',$schedule->departure_time)->format('h:i A')}}</h5>
                        <div class="block">
                            <span class="bg-sky-100 text-sky-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-sky-200 dark:text-sky-800">Capacity: {{$schedule->capacity}}</span>
                        </div>
                    </div>
                    <div class="px-5 pb-5">
                        <div class="flex items-center justify-between">
                            <h5 class="text-xl sm:text-3xl font-semibold tracking-tight text-gray-800 dark:text-white">{{$schedule->name}}</h5>
                            <span class="bg-teal-100 text-teal-800 text-xs sm:text-base font-semibold px-2.5 py-0.5 rounded dark:bg-teal-200 dark:text-teal-800">Duration: {{$totalDuration}} Hour/s</span>
                        </div>
                        <div class="flex items-center mt-2.5 mb-2.5">
                            <span class="bg-blue-100 text-blue-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Vessel</span>
                        </div>
                        <div class="flex items-center space-x-2 my-2 text-center">
                            @foreach ($fares as $fare)
                                <span class="bg-lime-100 text-lime-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-lime-200 dark:text-lime-800"><span class="dark:text-sky-800 text-sky-800 font-bold">{{$fare->type}}:</span> {{$fare->price}}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between">
                            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                @foreach ($fares as $fare)
                                    <option value="{{$fare->price}}">{{$fare->type}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Select</button>
                        </div>
                    </div>
                </div>
                @endforeach
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
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                    <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 14H2a2 2 0 0 1-2-2V9.5a1 1 0 0 1 1-1 1.5 1.5 0 0 0 0-3 1 1 0 0 1-1-1V2a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2.5a1 1 0 0 1-1 1 1.5 1.5 0 0 0 0 3 1 1 0 0 1 1 1V12a2 2 0 0 1-2 2Z"/>
                                    </svg>
                                </span>
                                <h3 class="flex items-center mb-1 text-md font-semibold text-gray-900 dark:text-white">{{$origin}}</h3>
                            </li>
                            <li class="mb-10 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 bg-teal-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-teal-900">
                                    <svg class="w-2.5 h-2.5 text-teal-800 dark:text-teal-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
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

    <script type="module">
        $(document).ready(function(){
            $('input[type="radio"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
    
@include('partials.footer')