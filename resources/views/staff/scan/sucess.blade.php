@include('staff.partials.header')

    @include('staff.components.navigation')

    @include('staff.components.sidebar')

    <main class="p-4 md:ml-64 pt-20">
        <div class="rounded-lg mb-4 shadow-md">
            <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
                <div class="block overflow-x-auto bg-white dark:bg-gray-800">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
                            <tr>
                                <th scope="col" class="p-4">
                                    #
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Schedule
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Birthday
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Gender
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Seat
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($passengers as $passenger)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            <div class="text-base font-semibold">
                                                {{ $loop->index }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$schedule->schedule_number}}
                                </td>
                                <td class="text-center px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $passenger->first_name . " " . $passenger->middle_name . " " . $passenger->last_name }}
                                </td>
                                <td class="text-center px-6 py-3">
                                    {{ \Carbon\Carbon::parse($passenger->birthdate)->format('M d, Y') }}
                                </td>
                                <td class="text-center px-6 py-4">
                                    {{$passenger->gender}}
                                </td>
                                <td class="text-center px-6 py-4">
                                    {{$passenger->seat->seat_number}}
                                </td>
                            </tr>
    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 flex sm:mt-7 flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <a href="{{route('staff.scan.qr')}}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                        Scan Next
                    </a>
                </div>
            </div>
        </div>
    </main>

@include('staff.partials.footer')