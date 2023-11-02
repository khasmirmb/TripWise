@if ($departPassengers)
@foreach ($departPassengers as $passenger)
@if ($passenger->seat_number === null)
<div class="depart-passenger block">
    <div class="block pl-2 pb-3">
        <div class="flex items-center space-x-4 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-800 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <div class="font-medium text-gray-800 dark:text-white">
                <div>{{ $passenger->first_name . " " . $passenger->middle_name[0] . " " . $passenger->last_name }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $passenger->accommodation }}</div>
                <h6 class="text-base font-semi text-gray-800 dark:text-gray-300">Departure</h6>
            </div>
        </div>
    </div>
    <div class="border-2 rounded-xl p-5 dark:border-gray-500 border-gray-300">
        <ul class="grid w-full gap-2 lg:grid-cols-12 md:grid-cols-8 grid-cols-4">
            @foreach ($departSeats as $seat)
                <li>
                    @if ($seat->seat_status == 'booked')
                    <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="depart_seat_{{ $passenger->id }}" value="{{ $seat->id }}" class="hidden peer" data-seat-id="{{ $seat->id }}" disabled>
                    <label for="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" class="inline-flex items-center justify-center w-12 p-2 text-red-500 bg-red-100 border border-red-200 rounded-lg cursor-pointer dark:hover:text-red-300 dark:border-red-700 dark:peer-checked:text-teal-500 peer-checked:border-teal-600 peer-checked:text-teal-600 hover:text-red-600 hover:bg-red-100 dark:text-red-400 dark:bg-red-800 dark:hover:bg-red-700">                           
                        <div class="block">
                            <div class="w-full text-base font-bold">{{ $seat->seat_number }}</div>
                        </div>
                    </label>
                    @else
                    <input type="radio" id="depart_{{ $passenger->id }}_{{ $seat->seat_number }}" name="depart_seat_{{ $passenger->id }}" value="{{ $seat->id }}"  class="hidden peer" data-seat-id="{{ $seat->id }}">
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
    
    <div class="flex justify-end w-full py-2">
        <button data-modal-target="depart_modal{{$passenger->id}}" data-modal-toggle="depart_modal{{$passenger->id}}" class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800" type="button">
            Select
        </button>

        <div id="depart_modal{{$passenger->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="depart_modal{{$passenger->id}}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to update the seat for this passenger?</h3>
                        <button type="button" data-modal-hide="depart_modal{{$passenger->id}}" class="depart-seat-button text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-teal-600 dark:hover-bg-teal-700 focus:outline-none dark:focus:ring-teal-800" data-passenger-id="{{ $passenger->id }}">Yes, Update Seat</button>
                        <button data-modal-hide="depart_modal{{$passenger->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endif


<script type="module">
    $(document).ready(function () {

        // Handle the click event of the "Select" button
        $('.depart-seat-button').click(function () {
            var passengerId = $(this).data('passenger-id');
            var selectedSeat = $('input[name="depart_seat_' + passengerId + '"]:checked').val();

            if (!selectedSeat) {
                // Show the warning toast
                $("#toast-warning").fadeIn();

                $("#toast-warning button").on("click", function() {
                    $("#toast-warning").fadeOut();
                });

                // Hide the toast after a certain time (e.g., 10 seconds)
                setTimeout(function () {
                    $("#toast-warning").fadeOut();
                }, 10000); // 10000 milliseconds (10 seconds)
            }
    
            // Send an AJAX request to update the passenger's seat_number
            $.ajax({
                type: 'GET',
                url: '/update-seat', // Update the URL to your route
                data: {
                    passengerId: passengerId,
                    selectedSeat: selectedSeat,
                },
                success: function (response) {
                    // Handle the response from the server, e.g., show a success message
                    console.log(response);

                    $("#toast-success").fadeIn();

                    // Hide the toast after a certain time (e.g., 10 seconds)
                    setTimeout(function () {
                        $("#toast-success").fadeOut();
                    }, 10000); // 10000 milliseconds (10 seconds)

                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., show an error message
                    console.error(xhr.responseText);

                    if (xhr.status === 404) {
                        // Seat not found, show an error toast
                        $("#toast-error").fadeIn();

                        // Hide the error toast after a certain time (e.g., 10 seconds)
                        setTimeout(function () {
                            $("#toast-error").fadeOut();
                        }, 10000); // 10000 milliseconds (10 seconds)
                    }

                }
            });
        });
    });
</script>