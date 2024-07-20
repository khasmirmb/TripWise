<!-- Add Passenger Modal -->
<div id="change_seat-{{$passenger->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Change Seat
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="change_seat-{{$passenger->id}}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="my-1">
                @csrf
                <div class="w-full mt-2 mb-4">
                    <div class="border-2 rounded-xl p-5 dark:border-gray-500 border-gray-300">
                        <ul class="grid w-full gap-2 lg:grid-cols-12 md:grid-cols-8 grid-cols-4">
                            @foreach ($seats as $seat)
                            <li>
                                @if ($seat->seat_status == 'booked')
                                <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="seats{{ $passenger->id }}" value="{{ $seat->id }}" class="hidden peer" data-seat-id="{{ $seat->id }}" disabled>
                                <label for="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" class="inline-flex items-center justify-center w-12 p-2 text-red-500 bg-red-100 border border-red-200 rounded-lg cursor-pointer dark:hover:text-red-300 dark:border-red-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-red-600 hover:bg-red-100 dark:text-red-400 dark:bg-red-800 dark:hover:bg-red-700">                           
                                    <div class="block">
                                        <div class="w-full text-base font-bold">{{ $seat->seat_number }}</div>
                                    </div>
                                </label>
                                @else
                                <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="seats{{ $passenger->id }}" value="{{ $seat->id }}"  class="hidden peer" data-seat-id="{{ $seat->id }}">
                                <label for="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" class="inline-flex items-center justify-center w-12 p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                    <div class="block">
                                        <div class="w-full text-base font-bold">{{ $seat->seat_number }}</div>
                                    </div>
                                </label>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" data-passenger-id="{{ $passenger->id }}" class="seat-button text-white inline-flex items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                    Change
                </button>
            </div>
        </div>
    </div>
</div>

<div id="toast-success" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">Seat updated successfully!</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<div id="toast-warning" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
        </svg>
        <span class="sr-only">Warning icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">Please select a seat.</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<div id="toast-error" style="display: none;" class="fixed top-2 mx-auto inset-x-0 z-50 justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 flex" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="flex ml-3 text-sm font-normal items-center">There was something wrong please try again.</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-error" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

<script type="module">
    $(document).ready(function () {

        // Handle the click event of the "Select" button
        $('.seat-button').click(function () {
            var passengerId = $(this).data('passenger-id');
            var selectedSeat = $('input[name="seats' + passengerId + '"]:checked').val();

            if (!selectedSeat) {
                // Show the warning toast
                $("#toast-warning").fadeIn();

                $("#toast-warning button").on("click", function() {
                    $("#toast-warning").fadeOut();
                });

                // Hide the toast after a certain time (e.g., 3 seconds)
                setTimeout(function () {
                    $("#toast-warning").fadeOut();
                }, 3000); // 3000 milliseconds (3 seconds)
            }
    
            // Send an AJAX request to update the passenger's seat_number
            $.ajax({
                type: 'GET',
                url: '/admin/booking/passenger/seat/change', // Update the URL to your route
                data: {
                    passengerId: passengerId,
                    selectedSeat: selectedSeat,
                },
                success: function (response) {
                    // Handle the response from the server, e.g., show a success message
                    console.log(response);

                    $("#toast-success").fadeIn();

                    // Hide the toast after a certain time (e.g., 3 seconds)
                    setTimeout(function () {
                        $("#toast-success").fadeOut();
                    }, 3000); // 3000 milliseconds (3 seconds)

                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., show an error message
                    console.error(xhr.responseText);

                    if (xhr.status === 404) {
                        // Seat not found, show an error toast
                        $("#toast-error").fadeIn();

                        // Hide the error toast after a certain time (e.g., 3 seconds)
                        setTimeout(function () {
                            $("#toast-error").fadeOut();
                        }, 3000); // 3000 milliseconds (3 seconds)
                    }

                }
            });
        });
    });
</script>