@include('partials.header')

    @include('components.navigation')

    @include('layouts.progress-complete')

    @include('components.error-message')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-7xl lg:py-10">
            @if ($departBooking)
            <h3 class="text-xl sm:text-2xl font-bold text-gray-600 dark:text-gray-50 mb-3">Departure Booking Details</h3>
            @foreach ($departPassengers as $passenger)
            <div class="grid gap-4 sm:grid-cols-4 p-5 border-2 rounded-lg my-5">
                <div class="block sm:col-span-4">
                    <span class="bg-blue-100 text-blue-800 text-base sm:text-lg font-medium mr-2 px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300">Passenger #{{ $loop->iteration }}</span>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $departBooking->status }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Booking Date</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $departBooking->created_at->format('M d, Y h:i A') }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Vessel</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$depSchedData->name}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Reference Number</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$departBooking->reference_number}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Full Name</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $passenger->first_name }} {{ substr($passenger->middle_name, 0, 1) }} {{ $passenger->last_name }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Gender</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->gender}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Birthdate</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{date('M d, Y', strtotime($passenger->birthdate))}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Fare Type</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->discount_type}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Accommodation</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->accommodation}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Date and Time</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{date('M d, Y', strtotime($depSchedData->departure_date)) . " " . date("g:i a", strtotime($depSchedData->departure_time))}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Origin</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$depSchedData->departure_port}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Destination</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$depSchedData->arrival_port}}</h5>
                </div>
            </div>
            @endforeach
            <div class="departure-pdf flex w-full justify-end">
                <a href="{{ route('depart.generate.pdf', ['paymentId' => $paymentId, 'contactPersonId' => $contactPersonId, 'departBookId' => $departBookId]) }}" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800">Download</a>
            </div>
            @endif

            @if ($returnBooking)
            <h3 class="text-xl sm:text-2xl font-bold text-gray-600 dark:text-gray-50 mb-3">Return Booking Details</h3>
            @foreach ($returnPassengers as $passenger)
            <div class="grid gap-4 sm:grid-cols-4 p-5 border-2 rounded-lg my-5">
                <div class="block sm:col-span-4">
                    <span class="bg-blue-100 text-blue-800 text-base sm:text-lg font-medium mr-2 px-2.5 py-1 rounded dark:bg-blue-900 dark:text-blue-300">Passenger #{{ $loop->iteration }}</span>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $returnBooking->status }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Booking Date</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $returnBooking->created_at->format('M d, Y H:i:s a') }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Vessel</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$retSchedData->name}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Reference Number</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$returnBooking->reference_number}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Full Name</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ $passenger->first_name }} {{ substr($passenger->middle_name, 0, 1) }} {{ $passenger->last_name }}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Gender</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->gender}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Birthdate</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{date('M d, Y', strtotime($passenger->birthdate))}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Fare Type</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->discount_type}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Accommodation</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$passenger->accommodation}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Date and Time</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{date('M d, Y', strtotime($retSchedData->departure_date)) . " " . date("g:i a", strtotime($retSchedData->departure_time))}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Origin</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$retSchedData->departure_port}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Destination</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$retSchedData->arrival_port}}</h5>
                </div>
            </div>
            @endforeach
            <div class="return-pdf flex w-full justify-end">
                <a href="{{ route('return.generate.pdf', ['paymentId' => $paymentId, 'contactPersonId' => $contactPersonId, 'returnBookId' => $returnBookId]) }}" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" target="_blank">Download</a>
            </div>
            @endif
        </div>
    </section>

@include('partials.footer')