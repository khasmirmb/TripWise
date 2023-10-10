
@include('partials.header')

    @include('components.navigation')

        <!-- Booking Search Section -->
        <section class="bg-center bg-slate-200 bg-no-repeat bg-blend-multiply dark:bg-gray-700" style="background-image: url('{{ asset('/images/bg-booking.jpg')}}'); background-size: cover;">
            <div class="px-4 mx-auto max-w-screen-xl text-center py-10 lg:py-40">
                <div class="relative h-64 lg:h-24">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-shadow">
                        <h1 class="text-5xl font-extrabold text-center mb-6 tracking-wide" style="font-family: 'Playfair Display', serif;">Discover Your Ferry Adventure</h1>
                        <p class="text-lg text-center leading-relaxed tracking-wide" style="font-family: 'Poppins', sans-serif;">
                            Embark on a journey like no other. Book your ferry experience today and explore the beauty of the open sea with ease.
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="bg-gray-50 dark:bg-gray-800" role="presentation">
                            <button class="inline-flex p-4 border-b-2 text-bold text-lg hover:text-teal-600 border-teal-600 text-teal-600 dark:text-teal-300 hover:border-teal-600 dark:hover:text-teal-300 dark:border-teal-300" id="passenger-tab" data-tabs-target="#passenger" type="button" role="tab" aria-controls="passenger" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>

                            <span class="mx-1 text-sm sm:text-base text-teal-600 dark:text-teal-300">
                                Passenger
                            </span></button>
                        </li>
                    </ul>
                </div>

                <div id="myTabContent">
                    <div class="hidden p-4 bg-gray-50 dark:bg-gray-800" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                        <div class="bg-max-w-screen-xl text-left py-2">
                            <form method="POST" action="{{route('booking.schedule.show')}}">
                                @csrf
                                <div class="flex my-5">
                                    <div class="flex items-center mr-4">
                                        <input checked id="one-way" name="type" type="radio" value="One Way" class="w-5 h-5 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="javascript:tripCheck();" {{ (old('type') == 'One Way') ? 'checked' : '' }}>
                                        <label for="one-way" class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">One Way</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="round-trip" name="type" type="radio" value="Round Trip" class="w-5 h-5 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" onclick="javascript:tripCheck();" {{ (old('type') == 'Round Trip') ? 'checked' : '' }}>
                                        <label for="round-trip" class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">Round Trip</label>
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <div class="flex">
                                      <span class="inline-flex items-center px-3 text-md text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"> Origin
                                      </span>
                                      <select id="origin" name="origin" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('origin') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    @error('origin')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror                                    
                                </div>

                                <div class="relative z-0 w-full mb-6 group">
                                    <div class="flex mb-3">
                                      <span class="inline-flex items-center px-3 text-md text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"> Destination
                                      </span>
                                      <select id="destination" name="destination"  class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Select Location</option>
                                        @foreach($ports as $port)
                                            <option value="{{ $port->name }}" {{ old('destination') === $port->name ? 'selected' : '' }}>{{ $port->location }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    @error('destination')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                    @enderror
                                </div>
                                </div>
                                <div class="grid md:grid-cols-4 md:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <div class="relative mb-3" id="datepicker-disable-past"
                                        data-te-input-wrapper-init>
                                            <input
                                            type="text" id="depart_date" name="depart_date"
                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-teal data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-teal [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" value="{{ old('depart_date') }}" data-te-datepicker-toggle-ref/>
                                            <label
                                            for="depart_date"
                                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-teal peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-teal"
                                            >Departure Date</label
                                            >
                                        </div>
                                        @error('depart_date')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="relative z-0 wfull- mb-6 group" id="round-div" style="visibility: hidden">
                                        <div class="relative mb-3" id="datepicker-disable-past2"
                                        data-te-input-wrapper-init>
                                            <input
                                            type="text" id="return_date" name="return_date"
                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-teal data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-teal [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" value="{{ old('return_date') }}" data-te-datepicker-toggle-ref/>
                                            <label
                                            for="return_date"
                                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-teal peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-teal"
                                            >Return Date</label
                                            >
                                        </div>
                                        @error('return_date')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <div class="flex">
                                            <span class="inline-flex items-center px-3 text-md text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"> Passenger
                                            </span>
                                            <input type="number" id="passenger" name="passenger" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('passenger') }}">
                                        </div>
                                        @error('passenger')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="relative z-0 w-full mb-6 text-right">
                                        <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-md lg:px-5 px-2 py-2.5 text-center inline-flex items-center mr-2 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 md:text-sm">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                            Search Voyage
                                        </button>
                                    </div>

                                </div>
                            </form>       
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <script>
        // Check if Round Trip or One way
        function tripCheck() {

            if (document.getElementById('round-trip').checked) {
                document.getElementById('round-div').style.visibility = 'visible';
            }
            else document.getElementById('round-div').style.visibility = 'hidden';

        }
        @if (count($errors) > 0)
            if (document.getElementById('round-trip').checked) {
                document.getElementById('round-div').style.visibility = 'visible';
            }
            else document.getElementById('round-div').style.visibility = 'hidden';
        @endif
        </script>
        
        <script type="module">
        // JQuery
        // Remove Selected Value from Destination based on Origin
        var $dropdown1 = $("select[name='origin']");
        var $dropdown2 = $("select[name='destination']");

        $dropdown1.change(function() {
            $dropdown2.empty().append($dropdown1.find('option').clone());
            var selectedItem = $(this).val();
            if (selectedItem) {
                $dropdown2.find('option[value="' + selectedItem + '"]').remove();
            }
        });
        </script>

@include('partials.footer')