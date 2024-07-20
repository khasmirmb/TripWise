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
                    @if ($trip_type == "Round Trip")
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                    @elseif ($trip_type == "One Way")
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>                
                    @endif
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
                    <h3 class="text-md font-semibold text-gray-900 dark:text-white"><span id="iti_dep_date">{{$depart_date}}</span><span id="new_dep_date"></span></h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Departure</p>
                </div>
            </li>
            @if(!is_null($return_date))
            <li class="relative mb-6 sm:mb-0 text-center border-b-2 sm:border-b-0">
                <div class="mt-2 sm:pr-4">
                    <h3 class="text-md font-semibold text-gray-900 dark:text-white"><span id="iti_ret_date">{{$return_date}}</span><span id="new_ret_date"></span></h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Return</p>
                </div>
            </li>
            @endif
        </ol>         
    </div> 
</section>