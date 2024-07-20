@include('partials.header')

    @include('components.navigation')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl dark:text-white">Change Your Schedule</h2>
                    <p class="mx-auto mb-4 max-w-2xl font-light text-gray-500 md:mb-8 sm:text-xl dark:text-gray-400">You can make changes to your trip schedule here. Please note that you can only change your schedule, and your accommodation remains the same as the previous booking. Keep in mind that a fee may apply for rescheduling.</p>
                    <div class="w-full flex justify-center sm:col-span-2 sm:text-center mb-4">                  
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl  dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <div class="flex mb-2 space-x-2">
                                    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white flex sm:mx-auto">
                                        {{$schedule->departure_port}}
                                    </h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-gray-900 dark:text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white flex sm:mx-auto">
                                        {{$schedule->arrival_port}}
                                    </h5>
                                </div>
                                <p class="mb-3 text-base font-semibold text-gray-700 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($schedule->departure_date . ' ' . $schedule->departure_time)->format('F d, Y g:i a') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mx-auto">
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Fields with red asterisks (<span class="text-red-600">*</span>) are required.
                        </div>
                    </div>
                    <form method="GET" action="{{route('booking.rebook.payment', ['booking' => $booking->id, 'reference' => $booking->reference_number, 'schedule' => $booking->schedule->schedule_number])}}">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="w-full sm:col-span-2">
                                <label for="schedule" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available Trip<span class="text-red-600">*</span></label>
                                <select id="schedule" name="schedule" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                                    <option selected>Select Schedule</option>
                                    @foreach ($sched_list as $sched)
                                        <option value="{{ $sched->id }}">
                                            {{ \Carbon\Carbon::parse($sched->departure_date . ' ' . $sched->departure_time)->format('M d, Y g:i a') . " - " . $sched->ferries->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <button button="submit" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                                Proceed to Summary
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="error-rebook" class="fixed top-2 mx-auto inset-x-0 z-50 flex justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert" style="display: none">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="flex ml-3 text-sm font-normal items-center">Please choose a date</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#error-rebook" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>

@include('partials.footer')