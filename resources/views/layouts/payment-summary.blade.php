<div class="px-4 pt-8">
    <p class="ml-2 text-xl font-medium text-gray-700 dark:text-white">Trip Summary</p>
    <p class="ml-2 text-gray-400">Please review your booking details below to ensure accuracy before finalizing.</p>
      <div class="mt-8 space-y-1 rounded-lg bg-slate-100 dark:bg-gray-700">
          <div class="bg-teal-600 rounded-t-lg p-3">
              <p class="text-xl font-medium text-white text-center">Departure Summary</p>
          </div>
          <div class="departure-summary px-3 sm:px-6 pb-3">
              <div class="flex flex-col sm:flex-row">
              <img class="m-2 h-32 w-46 rounded-md border mx-auto object-cover object-center" src="https://psssonline.files.wordpress.com/2016/10/20102229429_674fe07fcf_z.jpg?w=640" alt="" />
              <div class="flex w-full flex-col px-4 sm:py-9 pb-2 text-center">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Vessel</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$depart_ferry->name}}</span>
              </div>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Origin:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$depart_sched->departure_port}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Destination:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$depart_sched->arrival_port}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Date:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($depart_sched->departure_date))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Arrival Date:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($depart_sched->arrival_date))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Time:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("g:i a", strtotime($depart_sched->departure_time))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Accommodation:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$dep_sched_type}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Price:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">₱{{$dep_sched_price}}</span>
              </div>
          </div>
      </div>
      @if(!is_null($return_date))
      <div class="mt-4 space-y-1 rounded-lg bg-slate-100 dark:bg-gray-700">
          <div class="bg-teal-600 rounded-t-lg p-3">
              <p class="text-xl font-medium text-white text-center">Return Summary</p>
          </div>
          <div class="return-summary px-3 sm:px-6 pb-3">
              <div class="flex flex-col sm:flex-row">
              <img class="m-2 h-32 w-46 rounded-md border mx-auto object-cover object-center" src="https://psssonline.files.wordpress.com/2016/10/20102229429_674fe07fcf_z.jpg?w=640" alt="" />
              <div class="flex w-full flex-col px-4 sm:py-9 pb-2 text-center">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Vessel</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$return_ferry->name}}</span>
              </div>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Origin:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$return_sched->departure_port}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Destination:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$return_sched->arrival_port}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Date:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($return_sched->departure_date))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Arrival Date:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($return_sched->arrival_date))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Departure Time:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("g:i a", strtotime($return_sched->departure_time))}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Accommodation:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$ret_sched_type}}</span>
              </div>
              <div class="flex items-center justify-between py-2">
                  <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Price:</span>
                  <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">₱{{$ret_sched_price}}</span>
              </div>
          </div>
      </div>       
      @endif
      <div class="mt-4 space-y-1 rounded-lg bg-slate-100 dark:bg-gray-700">
          <div class="bg-teal-600 rounded-t-lg p-3">
              <p class="text-xl font-medium text-white text-center">Passenger Summary</p>
          </div>
          <div class="passenger-summary px-3 sm:px-6 pb-3">
              <div class="contact-person border-b border-gray-300">
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Contact Person:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$contactPerson['name']}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Email:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$contactPerson['email']}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Contact Number:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$contactPerson['phone']}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Address:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$contactPerson['address']}}</span>
                  </div>
              </div>
              @foreach ($passengers as $passenger)
              <div class="contact-person @if ($loop->last) @else border-b border-gray-300 @endif">
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Passenger:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">#{{$loop->iteration}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Name:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$passenger['firstname']. " " . $passenger['middlename'][0] . " " . $passenger['lastname']}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Gender:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$passenger['gender']}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Birthday:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{date("j F Y", strtotime($passenger['birthday']))}}</span>
                  </div>
                  <div class="flex items-center justify-between py-2">
                      <span class="text-xs sm:text-base dark:text-gray-400 text-gray-500">Classification:</span>
                      <span class="text-xs sm:text-base font-semibold text-gray-700 dark:text-white">{{$passenger['classification']}}</span>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
</div>