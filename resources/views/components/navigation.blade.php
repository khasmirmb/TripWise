<nav class="bg-white border-gray-200 border-b dark:border-gray-600 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="/" class="flex items-center">
          <img src="{{ asset('logo/tripwise.png')}}" alt="Logo" class="h-12 mr-3"/>
      </a>
      <div class="flex items-center lg:order-2">
          <!-- Toggle Dark Mode -->
          <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 mx-3">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
          </button>
          <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
          </button>
      </div>
      <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-user">
          <ul class="flex flex-col font-medium p-4 lg:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 lg:flex-row lg:space-x-6 lg:mt-0 lg:border-0 lg:bg-white dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
              <li>
                  <a href="/" class="block py-2 pl-3 pr-4 mt-3 mb-1 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-teal-700 lg:p-0 dark:text-white lg:dark:hover:text-teal-500 dark:hover:bg-gray-700 dark:hover:text-teal-500 lg:dark:hover:bg-transparent dark:border-gray-700" >Home</a>
              </li>
              <li>
                  <a href="{{route('contact')}}" class="block py-2 pl-3 pr-4 mt-3 mb-1 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-teal-700 lg:p-0 dark:text-white lg:dark:hover:text-teal-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Contact Us</a>
              </li>
              <li class="mb-2">
                  <a href="{{route('accommodation')}}" class="block py-2 pl-3 pr-4 mt-3 mb-1 text-gray-900 rounded hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-teal-700 lg:p-0 dark:text-white lg:dark:hover:text-teal-500 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Accommodation</a>
              </li>
              <li>
                  <a href="{{route('booking.manage.show')}}" class="block text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Manage Booking</a>
              </li>
              <li>
                  <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Guideline <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg></button>
                  <!-- Dropdown menu -->
                  <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                        <li>
                            <a href="{{route('guide.booking')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Booking Guideline</a>
                        </li>
                        <li>
                            <a href="{{route('guide.rebooking')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rebooking Guideline</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Privacy Policy</a>
                        </li>
                      </ul>
                  </div>
              </li>
              <li>
                <a href="{{route('booking.search.show')}}" class="block text-gray-900 bg-white border border-teal-300 focus:outline-none hover:bg-teal-100 focus:ring-4 focus:ring-teal-200 font-medium rounded-full text-sm px-5 py-2.5 mb-2 dark:bg-teal-800 dark:text-white dark:border-teal-600 dark:hover:bg-teal-700 dark:hover:border-teal-600 dark:focus:ring-teal-700">Book Now!</a>
            </li>
          </ul>
      </div>
  </div>
</nav>

@include('components.message')

@include('components.error-message')

@include('components.success-message')