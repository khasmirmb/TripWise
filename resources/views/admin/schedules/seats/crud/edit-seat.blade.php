<!-- Edit Seat Modal -->
<div id="edit-seat{{$seat->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Seat
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-seat{{$seat->id}}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('admin.schedule.seats.edit', ['seat' => $seat->id])}}" method="GET">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="seat_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seat Number</label>
                        <input type="text" name="seat_number" id="seat_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{$seat->seat_number}}" required>
                    </div>
                    <div>
                        <label for="class" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class</label>
                        <select id="class" name="class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                            @foreach ($fares as $fare)
                                <option value="{{ $fare->type }}" {{ $seat->class == $fare->type ? 'selected' : '' }}>
                                    {{ $fare->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="seat_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="seat_status" name="seat_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
                            <option value="available" {{ $seat->seat_status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $seat->seat_status == 'booked' ? 'selected' : '' }}>Booked</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                        Update Seat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>