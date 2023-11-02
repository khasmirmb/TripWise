    @include('partials.header')
    
        @include('components.navigation')

        <section class="bg-slate-50 dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto md:gap-8 xl:gap-0 md:py-16 md:grid-cols-12">
                <div class="mr-auto place-self-center md:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Travel with Ease</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 md:mb-8 md:text-md md:text-xl dark:text-gray-400">Ferry bookings now made easier with TripWise. Check ferry schedules and rates today.</p>
                    @if (Auth::check())
                    <a href="{{route('booking.search.show')}}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-900">
                        Book Now
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    @else
                    <button type="button" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-900" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal">
                        Book Now
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    @endif
                </div>
                <div class="hidden md:mt-0 md:col-span-5 md:flex">
                    <img src="{{ asset('images/background-img.png')}}" alt="Image">
                </div>                
            </div>
        </section>
        
    @include('partials.footer')