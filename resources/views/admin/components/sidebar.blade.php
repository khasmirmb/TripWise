<aside
class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
aria-label="Sidenav"
id="drawer-navigation">
<div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
  <ul class="space-y-2">
    <li>
      <a
        href="{{route('admin.home')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.overview')

        <span class="ml-3">Overview</span>
      </a>
    </li>
    <li>
      <button
        type="button"
        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
        aria-controls="dropdown-users"
        data-collapse-toggle="dropdown-users"
      >
        @include('admin.icons.users')
        <span class="flex-1 ml-3 text-left whitespace-nowrap"
          >Users</span
        >
        <svg
          aria-hidden="true"
          class="w-6 h-6"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <ul id="dropdown-users" class="hidden py-2 space-y-2">
        <li>
          <a
            href="{{route('admin.staff')}}"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >Staffs</a
          >
        </li>
        <li>
          <a
            href="{{route('admin.admin')}}"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >Admins</a
          >
        </li>
      </ul>
    </li>
    <li>
      <a
        href="{{route('admin.ferry')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.ferries')
        <span class="ml-3">Ferries</span>
      </a>
    </li>
    <li>
      <a
        href="{{route('admin.port')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.ports')
        <span class="ml-3">Ports</span>
      </a>
    </li>
    <li>
      <a
        href="{{route('admin.schedule')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.schedules')
        <span class="ml-3">Schedules</span>
      </a>
    </li>
    <li>
      <a
        href="{{route('admin.booking')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.bookings')
        <span class="ml-3">Bookings</span>
      </a>
    </li>
    <li>
      <a
        href="#"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
      >
        @include('admin.icons.messages')
        <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
        <span
          class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800"
        >
          4
        </span>
      </a>
    </li>
    <li>
      <button
        type="button"
        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
        aria-controls="dropdown-records"
        data-collapse-toggle="dropdown-records"
      >
        @include('admin.icons.records')
        <span class="flex-1 ml-3 text-left whitespace-nowrap"
          >Records</span
        >
        <svg
          aria-hidden="true"
          class="w-6 h-6"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <ul id="dropdown-records" class="hidden py-2 space-y-2">
        <li>
          <a
            href="#"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >Payments</a
          >
        </li>
        <li>
          <a
            href="#"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >Passengers</a
          >
        </li>
        <li>
          <a
            href="#"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >Contact Info</a
          >
        </li>
      </ul>
    </li>
  </ul>
  <ul
    class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700"
  >
  <li>
    <a
      href="{{route('admin.scan.qr')}}"
      class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group"
    >
      @include('admin.icons.scan')
      <span class="ml-3">Scan QR</span>
    </a>
  </li>
    <li>
      <a
        href="#"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group"
      >
        @include('admin.icons.components')
        <span class="ml-3">Components</span>
      </a>
    </li>
    <li>
      <a
        href="{{route('admin.settings')}}"
        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group"
      >
        @include('admin.icons.settings')
        <span class="ml-3">Settings</span>
      </a>
    </li>
  </ul>
</div>
</aside>