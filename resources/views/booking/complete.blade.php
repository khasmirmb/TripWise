@include('partials.header')

    @include('components.navigation')

    @include('layouts.progress-complete')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-7xl lg:py-10">
            <div class="my-2">
                <h1 class="mb-3 text-3xl sm:text-5xl font-extrabold text-gray-900 dark:text-white"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Thank you for Booking!</span></h1>
                <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Please download your e-ticket below and present it at our office to complete the booking process after payment.</p>
            </div>
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
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$departFerry->name}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Reference Number</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$departBooking->reference_number}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Full Name</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ ucfirst($passenger->first_name) . " " . ucfirst(substr($passenger->middle_name, 0, 1)) . " " . ucfirst($passenger->last_name) }}</h5>
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
                <a href="{{ route('generate.pdf', ['payment' => $paymentId, 'contact' => $contactPersonId, 'booking' => $departBookId]) }}" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" id="departure-download">Download</a>
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
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$returnFerry->name}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Reference Number</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{$returnBooking->reference_number}}</h5>
                </div>
                <div class="block">
                    <label for="first_name" class="block mb-1 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-400">Full Name</label>
                    <h5 class="mb-1 text-base sm:text-lg font-medium text-gray-700 dark:text-white">{{ ucfirst($passenger->first_name) . " " . ucfirst(substr($passenger->middle_name, 0, 1)) . " " . ucfirst($passenger->last_name) }}</h5>
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
                <a href="{{ route('generate.pdf', ['payment' => $paymentId, 'contact' => $contactPersonId, 'booking' => $returnBookId]) }}" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" id="return-download">Download</a>
            </div>
            @endif
        </div>
    </section>

    <div id="toast-downloading" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-teal-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Spinner</span>
        </div>
        <div class="flex ml-3 text-sm font-normal items-center">Your download is being process please wait.</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-downloading" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    
    <script type="module">
        $(document).ready(function() {
            $('#departure-download, #return-download').click(function() {
                // Show the loading message
                $('#toast-downloading').show();
    
                setTimeout(function() {
                    // Hide the loading message based on timer
                    $('#toast-downloading').hide();
                }, 8000); // 8 seconds before hiding
            });
        });
    </script>

@include('partials.footer')