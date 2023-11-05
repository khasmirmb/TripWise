@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

    @include('admin.components.success-message')

      <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
        <div class="rounded-lg mb-4">
          <div class="relative bg-white dark:bg-gray-800 rounded-t-lg">
            <div class="flex items-start justify-start p-4">
              <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                  <li class="inline-flex items-center">
                    <a href="{{route('admin.home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-teal-600 dark:text-gray-400 dark:hover:text-white">
                      <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                      </svg>
                      Home
                    </a>
                  </li>
                  <li>
                    <div class="flex items-center">
                      <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Users</span>
                    </div>
                  </li>
                  <li aria-current="page">
                    <div class="flex items-center">
                      <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Clients</span>
                    </div>
                  </li>
                </ol>
              </nav>
            </div>
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
              <div class="w-full md:w-1/2">
                <form action="{{route('admin.client.search')}}" method="GET" class="flex items-center">
                  <label for="simple-search" class="sr-only">Search</label>
                  <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                      </svg>
                    </div>
                    <input type="text" name="query" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Search for a client">
                  </div>
                </form>
              </div>
              <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                <a href="{{route('admin.user.add')}}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 focus:outline-none dark:focus:ring-teal-800">
                  <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                  </svg>
                  Add User
                </a>
              </div>
            </div>
          </div>
          <div class="block overflow-x-auto shadow-md bg-white dark:bg-gray-800">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
                      <tr>
                          <th scope="col" class="p-4">
                            #
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Name
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Phone
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Address
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Verified
                          </th>
                          <th scope="col" class="px-6 py-3 text-center">
                            Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($clients as $client)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td class="w-4 p-4">
                              <div class="flex items-center">
                                <div class="text-base font-semibold">{{ $clients->firstItem() + $loop->index }}</div>
                              </div>
                          </td>
                          <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                              @if ($client->image)
                                <img class="w-10 h-10 rounded-full" src="{{asset('profile/' . $client->image)}}" alt="Client Image">
                              @else
                                <img class="w-10 h-10 rounded-full" src="{{asset('profile/default.png')}}" alt="Client Image">
                              @endif
                              <div class="pl-3">
                                <div class="text-base font-semibold">{{ ucfirst($client->firstname) . " " . ucfirst($client->lastname) }}</div>
                                <div class="font-normal text-gray-500">{{ $client->email }}</div>
                              </div>  
                          </th>
                          <td class="px-6 py-4">
                            @if ($client->phone_number)
                              {{ $client->phone_number }}
                            @else
                              Null
                            @endif
                          </td>
                          <td class="px-6 py-4">
                            @if ($client->address)
                            {{ $client->address }}
                            @else
                              Null
                            @endif
                          </td>
                          <td class="px-6 py-4">
                            @if ($client->email_verified_at)
                              <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2">
                                </div>
                                Verified
                              </div>
                            @else
                              <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2">
                                </div>
                                Not
                              </div>
                            @endif
                          </td>
                          <td class="px-6 py-4">
                              <div class="flex items-center space-x-4 justify-center">
                                <a href="{{route('admin.user.edit', ['user' => $client->id])}}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                    Edit
                                </a>
                                <button type="button" data-modal-target="client-preview{{$client->id}}" data-modal-toggle="client-preview{{$client->id}}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                    </svg>
                                    Preview
                                </button>
                                <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                              </div>
                          </td>
                      </tr>

                      @include('admin.users.includes.client-includes')

                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="relative overflow-hidden bg-white rounded-b-lg shadow-md dark:bg-gray-800">
              <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                  <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                      Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $clients->firstItem() }}-{{ $clients->lastItem() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $clients->total() }}</span>
                  </span>
                  <ul class="inline-flex items-stretch -space-x-px">

                      @php
                          // Define how many pages to show on each side of the current page
                          $pagesToShow = 2;
                          $currentPage = $clients->currentPage();
                          $lastPage = $clients->lastPage();
                          $startPage = max($currentPage - $pagesToShow, 1);
                          $endPage = min($currentPage + $pagesToShow, $lastPage);
                      @endphp

                      @if ($clients->onFirstPage())
                          <li>
                              <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed">
                                  <span class="sr-only">Previous</span>
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                              </a>
                          </li>
                      @else
                          <li>
                              <a href="{{ $clients->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                  <span class="sr-only">Previous</span>
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                              </a>
                          </li>
                      @endif

                      @foreach (range($startPage, $endPage) as $page)
                          <li>
                              <a href="{{ $clients->url($page) }}"
                                @if ($page == $currentPage) aria-current="page"
                                class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight border text-teal-600 bg-teal-50 border-teal-300 hover:bg-teal-100 hover:text-teal-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                @else
                                class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                @endif >{{ $page }}</a>
                          </li>
                      @endforeach

                      @if ($clients->hasMorePages())
                          <li>
                              <a href="{{ $clients->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                  <span class="sr-only">Next</span>
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"></path>
                                  </svg>
                              </a>
                          </li>
                      @else
                          <li>
                              <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 cursor-not-allowed">
                                  <span class="sr-only">Next</span>
                                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                      xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                  </svg>
                              </a>
                          </li>
                      @endif

                  </ul>
              </nav>
          </div>
        </div>
      </main>

@include('admin.partials.footer')