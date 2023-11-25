   <!-- Staff Preview Modal -->
   <div id="staff-preview{{$staff->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
       <!-- Modal content -->
       <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
          <!-- Modal header -->
          <div class="flex justify-end rounded-t mb-2 sm:mb-1">
                <div>
                   <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="staff-preview{{$staff->id}}">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                   </button>
                </div>
          </div>
          <div class="flex justify-center m-auto mb-2">
             @if ($staff->image)
                <img class="rounded-lg w-36 h-36" src="{{asset('profile/' . $staff->image)}}" alt="Staff Image">
             @else
                <img class="rounded-lg w-36 h-36" src="{{asset('profile/default.png')}}" alt="Staff Image">                
             @endif
          </div>
          <div class="grid sm:grid-cols-2 mb-5 gap-2">
             <div class="sm:col-span-2">
                <h5 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Details</h5>
             </div>

             <div class="text-base font-normal text-gray-500">Name:</div>
             <div class="text-base font-semibold text-gray-900 dark:text-white sm:text-end">{{ ucfirst($staff->firstname) . " ". ucfirst($staff->middlename[0]) . " " . ucfirst($staff->lastname) }}</div>

             <div class="text-base font-normal text-gray-500">Email:</div>
             <div class="text-base font-semibold text-gray-900 dark:text-white sm:text-end">{{$staff->email}}</div>

             <div class="text-base font-normal text-gray-500">Phone:</div>
             <div class="text-base font-semibold text-gray-900 dark:text-white sm:text-end">                  
                @if ($staff->phone_number)
                   {{$staff->phone_number}}
                @else
                   Null
                @endif 
             </div>

             <div class="text-base font-normal text-gray-500">Adress:</div>
             <div class="text-base font-semibold text-gray-900 dark:text-white sm:text-end">
                @if ($staff->address)
                   {{$staff->address}}
                @else
                   Null
                @endif 
             </div>

             <div class="text-base font-normal text-gray-500">Joined At:</div>
             <div class="text-base font-semibold text-gray-900 dark:text-white sm:text-end">
                {{date('M d, Y h:i A', strtotime($staff->created_at))}}
             </div>
          </div>
          <div class="flex justify-end items-end">
                <button data-modal-toggle="staff-preview{{$staff->id}}" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
          </div>
       </div>
    </div>
 </div>