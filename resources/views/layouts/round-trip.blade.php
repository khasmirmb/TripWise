                <!-- Date Picking Return -->
@if (is_null($return_date))

@else
<div class="flex mb-2 mt-6 gap-1 sm:gap-4">  
    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$destination}}</h3>
    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-11 sm:h-11 w-8 h-8">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
    </h3>
    <h3 class="text-lg sm:text-3xl font-bold text-gray-600 dark:text-white">{{$origin}}</h3>
</div>
<div class="dates_slick flex border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    @for ($y = 0; $y < 17; $y++)
    <div>
        @php

            $validated_return = \Carbon\Carbon::createFromFormat('d/m/Y', $return_date);

            $valid_return_date = $validated_return->addDays($y);

            $maxium_date_return = $valid_return_date->format('Y-m-d');

        @endphp

        <input @if ($y == 0)
        checked
        @endif  type="radio" id="schedule_return{{$y}}" name="schedule_return" value="ret-{{ $maxium_date_return }}" class="hidden peer">
        <label for="schedule_return{{$y}}" class="inline-flex items-center justify-between p-3 w-autotext-gray-500 bg-white border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-teal-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-teal-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
        <div class="block text-center">
            <div class="w-full text-lg font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $maxium_date_return)->format('d') }}</div>
            <div class="w-full text-md">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $maxium_date_return)->format('D') }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $maxium_date_return)->format('M') }}</div>
        </div>
        </label>
    </div>
    @endfor
</div>
@php
                    
    $validated_date = \Carbon\Carbon::createFromFormat('d/m/Y', $return_date)->format('Y-m-d');

    $return_data = DB::table('schedules')
    ->join('ferries', 'schedules.ferry_id', '=', 'ferries.id')
    ->where('departure_port', '=', $origin)
    ->where('arrival_port', '=', $destination)
    ->where('departure_date', '>=', $validated_date)
    ->select('schedules.id', 'ferry_id', 'departure_port', 'arrival_port', 'departure_date', 'arrival_date', 'departure_time', 'arrival_time', 'name', 'capacity' , 'description', 'route', 'image')
    ->orderBy('departure_date', 'asc')
    ->get();

@endphp

<!-- Time Available for the Return Date -->
 @foreach ($return_data as $return)

@php

    $arrival = \Carbon\Carbon::createFromFormat('H:i:s' , $return->arrival_time);

    $departure = \Carbon\Carbon::createFromFormat('H:i:s' , $return->departure_time);


    $totalDuration = $arrival->diffInHours($departure);

    $fares = DB::table('fares')
    ->where('ferry_id', '=', $return->ferry_id)
    ->get();
                    
@endphp

<div class="ret-{{$return->departure_date}} return_box w-full bg-white border-2 border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 my-5" @if ($loop->first) style="display: block" @endif style="display: none">
    <div class="flex justify-between space-x-2 p-6 bg-white border-b-2 border-gray-200 dark:bg-gray-800 dark:border-gray-700 mb-6">
        <h5 class="text-2xl sm:text-5xl font-medium tracking-tight text-gray-700 dark:text-white mt-2 sm:mt-0">{{\Carbon\Carbon::createFromFormat('H:i:s',$return->departure_time)->format('h:i A')}}</h5>
        <div class="block">
            <span class="bg-sky-100 text-sky-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-sky-200 dark:text-sky-800">Capacity: {{$return->capacity}}</span>
        </div>
    </div>
    <div class="px-5 pb-5">
        <div class="flex items-center justify-between">
            <h5 class="text-xl sm:text-3xl font-semibold tracking-tight text-gray-800 dark:text-white">{{$return->name}}</h5>
            <span class="bg-teal-100 text-teal-800 text-xs sm:text-base font-semibold px-2.5 py-0.5 rounded dark:bg-teal-200 dark:text-teal-800">Duration: {{$totalDuration}} Hour/s</span>
        </div>
        <div class="flex items-center mt-2.5 mb-2.5">
            <span class="bg-blue-100 text-blue-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Vessel</span>
        </div>
        <div class="flex items-center space-x-2 my-2 text-center">
            @foreach ($fares as $fare)
                <span class="bg-lime-100 text-lime-800 text-xs sm:text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-lime-200 dark:text-lime-800"><span class="dark:text-sky-800 text-sky-800 font-bold">{{$fare->type}}:</span> ₱{{$fare->price}}</span>
            @endforeach
        </div>
        <div class="block">
            <form class="flex items-center justify-between mt-3">
                <select class="fareSelect2" data-schedule-id="{{$return->id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm md:text-base rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                    @foreach ($fares as $fare)
                        <option value="{{$fare->id}}">{{$fare->type}}</option>
                    @endforeach
                </select>
                <button type="button" class="selectButton2 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover-bg-green-700 dark:focus:ring-green-800">
                    Select
                </button>
            </form>
        </div>
    </div>
</div>

@endforeach

@endif

<script type="module">
    // Schedule Show the Date Time for Return
    $(document).ready(function(){
        $('input[name="schedule_return"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".return_box").not(targetBox).hide();
            $(targetBox).show();
        });

        $(".selectButton2").click(function () {
            var scheduleId = $(this).siblings('.fareSelect2').data('schedule-id');
            var fareId = $(this).siblings('.fareSelect2').val();
            $("#return_summary").show();
            $("#no-return").hide();

            // Send an Ajax request to get schedule information
            $.ajax({
                type: "GET",
                url: "/get-schedule",
                data: { scheduleId: scheduleId, fareId: fareId },
                success: function (scheduleResponse) {
                    // Handle the response from the server for schedule information
                    // Now, send another Ajax request to get ferry information based on the schedule
                    $.ajax({
                        type: "GET",
                        url: "/get-ferry-info",
                        data: { scheduleId: scheduleId },
                        success: function (ferryResponse) {
                            // Handle the response from the server for ferry information
                            $('#return_dep_port').html(scheduleResponse.departure_port);

                            $('#return_ariv_port').html(scheduleResponse.arrival_port);

                            $('#return_dep_date').html(scheduleResponse.departure_date);

                            $('#return_dep_time').html(scheduleResponse.departure_time);

                            $('#return_ferry_name').html(ferryResponse.ferry_name);

                            $('#return_fare_type').html(scheduleResponse.type);

                            $('#return_fare_price').html(scheduleResponse.price);

                            $('input[name="ret_sched_id"]').val(scheduleId);

                            $('input[name="ret_sched_type"]').val(scheduleResponse.type);

                            $('input[name="ret_sched_price"]').val(scheduleResponse.price);

                            $("input[name='return_depart_valid']").val(scheduleResponse.departure_date);

                        },
                        error: function (xhr, status, error) {
                            console.error("Error: " + error);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
    });
</script>