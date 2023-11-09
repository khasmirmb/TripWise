@include('partials.header')

    @include('components.navigation')

    @include('layouts.itinerary')

    @include('layouts.progress-passenger')

    @include('components.error-message')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-5xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-700 dark:text-white"><svg class="flex-shrink-0 inline w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg> Contact Information</h2>
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-justify">
                    <span class="font-medium text-red-600">Important!</span> 
                    Please make sure that your contact information matches your billing details to ensure a smooth transaction.
                </div>
            </div> 
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="text-justify">
                  <span class="font-medium text-red-600">Important!</span> Your e-ticket will be sent to the email address you provide below. Any announcements or changes to your itinerary will also be sent to this email as well as to the <span class="text-red-600">*</span>mobile number you provide below.(<span class="text-red-600">*</span>Only Philippine mobile numbers are supported for now.)
                </div>
            </div>
            <form action="{{route('booking.payment.show')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center p-4 mb-4 text-base text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="text-justify">
                        Fields with red asterisks (<span class="text-red-600">*</span>) are required.
                    </div>
                </div>

                    @include('layouts.contact-info')

                    <h2 class="my-4 text-xl font-bold text-gray-700 dark:text-white"><svg class="flex-shrink-0 inline w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg> Passenger Details</h2>
                    <div class="flex items-center p-4 mb-4 text-base text-blue-800 rounded-lg bg-blue-50 dark:bg-blue-900 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="text-justify">
                            Fields with red asterisks (<span class="text-red-600">*</span>) are required.
                        </div>
                    </div>
                    
                    @include('layouts.passenger-info')

                    <input type="hidden" name="depart_depart_valid" value="{{$depart_date}}" required>
                    
                    <input type="hidden" name="return_depart_valid" value="{{$return_date}}">
                    
                    <div class="flex justify-between">
                        <button id="backButton" type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-gray-900 focus:outline-none bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Back
                        </button>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 dark:focus:ring-teal-900 hover:bg-teal-800">
                            Continue
                        </button>
                    </div>
            </form>
        </div>
    </section>

    <script type="module">
        $(document).ready(function() {

            // Add an event listener to the Back button
            $('#backButton').click(function() {
                window.history.back(); // Go back to the previous page in the browser's history
            });
        });
    </script>
    

@include('partials.footer')