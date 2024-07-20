    @include('partials.header')
    
        @include('components.navigation')

        <section class="bg-slate-50 dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto md:gap-8 xl:gap-0 md:py-16 md:grid-cols-12">
                <div class="mr-auto place-self-center md:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Travel with Ease</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 md:mb-8 md:text-md md:text-xl dark:text-gray-400">Ferry bookings now made easier with TripWise. Check ferry schedules and rates today.</p>
                    <a href="{{route('booking.search.show')}}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-900">
                        Book Now
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
                <div class="hidden md:mt-0 md:col-span-5 md:flex">
                    <img src="{{ asset('images/background-img.png')}}" alt="Image">
                </div>                
            </div>
        </section>

        <section class="bg-white dark:bg-gray-900 border-y-2">
            <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <img class="w-full rounded-lg" src="{{asset('images/place1.jpg')}}" alt="Place 1">
                    <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{asset('images/place2.jpg')}}" alt="Place 2">
                </div>
                <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Discovering New Places</h2>
                    <p class="mb-4">We are navigators, tour guides, and explorers. Innovators and problem solvers. Small enough to offer convenience and speed, yet large enough to fulfill your travel desires at your preferred pace. Small enough to offer convenience and speed, yet large enough to fulfill your travel desires at your preferred pace.</p>
                    <p>We are navigators, tour guides, and explorers. Innovators and problem solvers. Small enough to offer convenience and speed.</p>
                </div>
            </div>
        </section>
        
    @include('partials.footer')