@include('admin.partials.header')

    @include('admin.components.navigation')

    @include('admin.components.sidebar')

      <main class="p-4 md:ml-64 pt-20 border-gray-300 dark:border-gray-600">
        <div class="rounded-lg mb-4 shadow-md">
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
                  <li aria-current="page">
                    <div class="flex items-center">
                      <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Message</span>
                    </div>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="block overflow-x-auto bg-white dark:bg-gray-800">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded-lg">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 w-full">
                      <tr>
                          <th scope="col" class="p-4">
                            #
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Email
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Subject
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Message
                          </th>
                          <th scope="col" class="px-6 py-3">
                            Status
                          </th>
                          <th scope="col" class="px-6 py-3 text-center">
                            Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($messages as $message)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td class="w-4 p-4">
                              <div class="flex items-center">
                                <div class="text-base font-semibold">{{ $messages->firstItem() + $loop->index }}</div>
                              </div>
                          </td>
                          <th scope="row" class="px-6 py-4 text-gray-900 dark:text-white">
                            {{$message->email}} 
                          </th>
                          <td class="px-6 py-4">
                            {{$message->subject}}
                          </td>
                          <td class="px-6 py-4">
                            {{ \Illuminate\Support\Str::limit($message->message, $limit = 20, $end = '...') }}
                          </td>
                          <td class="px-6 py-4">
                            @if ($message->read == false)
                              <span class="text-red-600 dark:text-red-400">Not Read</span>
                            @else
                              <span class="text-green-600 dark:text-green-400">Read</span>
                            @endif
                          </td>
                          <td class="px-6 py-4">
                              <div class="flex items-center space-x-4 justify-center">
                                <button type="button" data-modal-target="read-message{{$message->id}}" data-modal-toggle="read-message{{$message->id}}" class="read-message py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" data-message-id="{{ $message->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                    </svg>
                                    Read
                                </button>
                                <button type="button" data-modal-target="delete-modal{{$message->id}}" data-modal-toggle="delete-modal{{$message->id}}" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                              </div>
                          </td>
                      </tr>

                      @include('admin.messages.read')

                      @include('admin.messages.delete')

                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="relative overflow-hidden bg-white rounded-b-lg dark:bg-gray-800">
            <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $messages->firstItem() }}-{{ $messages->lastItem() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $messages->total() }}</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    @php
                        // Define how many pages to show on each side of the current page
                        $pagesToShow = 2;
                        $currentPage = $messages->currentPage();
                        $lastPage = $messages->lastPage();
                        $startPage = max($currentPage - $pagesToShow, 1);
                        $endPage = min($currentPage + $pagesToShow, $lastPage);
                    @endphp
                    @if ($messages->onFirstPage())
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
                            <a href="{{ $messages->previousPageUrl() . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    @endif
                    @foreach (range($startPage, $endPage) as $page)
                        <li>
                            <a href="{{ $messages->url($page) . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}"
                              @if ($page == $currentPage) aria-current="page"
                              class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight border text-teal-600 bg-teal-50 border-teal-300 hover:bg-teal-100 hover:text-teal-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                              @else
                              class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                              @endif >{{ $page }}</a>
                        </li>
                    @endforeach
                    @if ($messages->hasMorePages())
                        <li>
                            <a href="{{ $messages->nextPageUrl() . (empty(request()->input('query')) ? '' : '&query=' . request()->input('query')) }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

      <script type="module">
        $(document).ready(function() {
            $('.read-message').on('click', function() {
                var messageId = $(this).data('message-id');
    
                $.ajax({
                    type: 'POST',
                    url: '/admin/messages/' + messageId + '/read',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle success, e.g., update UI, show a message
                        console.log('Message marked as read:', response);
                    },
                    error: function(error) {
                        // Handle error, e.g., show an error message
                        console.error('Error marking message as read:', error);
                    }
                });
            });
        });
      </script>

@include('admin.partials.footer')