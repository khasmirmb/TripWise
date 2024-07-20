<!-- Schedule Read Modal -->
<div id="schedule-read{{$schedule->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        @php
            use App\Models\Seat;

            $fares = $schedule->ferries->fares;
            $seatCount = Seat::where('schedule_id', $schedule->id)->count();
            $seatBooked = Seat::where('schedule_id', $schedule->id)
            ->where('seat_status', 'booked')
            ->count();
            $seatAvailable = Seat::where('schedule_id', $schedule->id)
            ->where('seat_status', 'available')
            ->count();
        @endphp
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                <div class="text-base sm:text-lg text-gray-900 md:text-xl dark:text-white">
                    <h3 class="font-semibold ">{{$schedule->schedule_number}}</h3>
                    <p class="text-sm font-bold">
                        @if ($schedule->schedule_status == 'In Progress')
                        <span class="text-yellow-700 dark:text-yellow-300">
                            {{ $schedule->schedule_status }}
                        </span>
                        @elseif ($schedule->schedule_status == 'Canceled')
                        <span class="text-red-700 dark:text-red-400">
                            {{ $schedule->schedule_status }}
                        </span>
                        @else
                        <span class="text-green-700 dark:text-green-400">
                            {{ $schedule->schedule_status }}
                        </span>
                        @endif
                    </p>
                </div>
                <div>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="schedule-read{{$schedule->id}}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-center mx-auto my-2">
                @if ($schedule->ferries->image)
                    <img class="rounded sm:w-56 sm:h-46 w-36 h-26" src="{{asset('ferries/' . $schedule->ferries->image)}}" alt="{{$schedule->ferries->name}}">
                @else
                    <img class="rounded sm:w-56 sm:h-46 w-36 h-26" src="{{asset('ferries/default.png')}}" alt="{{$schedule->ferries->name}}">
                @endif
            </div>
            <div class="flex justify-center mx-auto my-2">
                <h6 class="text-sm sm:text-base font-semibold text-gray-900 md:text-xl dark:text-white">{{$schedule->ferries->name}}</h6>
            </div>
            <div class="mb-2 font-semibold leading-none text-gray-900 dark:text-white space-x-0 sm:space-x-2">
                Details
            </div>
            <div class="w-full grid sm:grid-cols-4 gap-4 mb-4">
                <div class="w-full sm:col-span-2 p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Origin
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$schedule->departure_port}}
                    </p>
                </div>
                <div class="w-full sm:col-span-2 p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Destionation
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$schedule->arrival_port}}
                    </p>
                </div>
                <div class="w-full sm:col-span-2 p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Departure Information
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($schedule->departure_date . ' ' . $schedule->departure_time)->format('D, M d, Y g:i a') }}
                    </p>
                </div>
                <div class="w-full sm:col-span-2 p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Arrival Information
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($schedule->arrival_date . ' ' . $schedule->arrival_time)->format('D, M d, Y g:i a') }}
                    </p>
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Capacity
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$schedule->ferries->capacity}}
                    </p>
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Total Seat
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$seatCount}}
                    </p>
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Booked Seat
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$seatBooked}}
                    </p>
                </div>
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        Available Seat
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{$seatAvailable}}
                    </p>
                </div>
            </div>
            <div class="mb-2 font-semibold leading-none text-gray-900 dark:text-white space-x-0 sm:space-x-2">
                Fares
            </div>
            <div class="w-full grid sm:grid-cols-{{count($fares)}} gap-4 mb-4">
                @foreach ($fares as $fare)
                <div class="w-full p-3 rounded-lg bg-slate-200 dark:bg-gray-700">
                    <h5 class="mb-1 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                        {{$fare->type}}
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{"₱" .$fare->price}}
                    </p>
                </div>
                @endforeach
            </div>
            <div class="flex justify-between items-center mt-5">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-modal-toggle="schedule-read{{$schedule->id}}">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>