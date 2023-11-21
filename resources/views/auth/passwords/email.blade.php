@php /* 
@include('partials.header')


    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-12 h-12 mr-2" src="{{ asset('logo/tripwise.png')}}" alt="Logo">
                {{ config('app.name', 'Laravel') }}  
            </a>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Find your account
                </h2>
                <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please enter your email to search for your account.</label>
                        <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send Password Reset Link</button>
                </form>
            </div>
        </div>
      </section>

@include('partials.footer')
*/ @endphp

@include('partials.header')

<section class="bg-white dark:bg-gray-900 h-screen">
    <div class="flex items-center font-semibold py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-teal-600 dark:text-teal-500">404</h1>
            <p class="mb-4 text-2xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Something's missing.</p>
            <p class="mb-4 text-2lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that page. You'll find lots to explore on the home page. </p>
            <a href="/" class="inline-flex text-white bg-teal-600 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-teal-900 my-4">Back to Homepage</a>
        </div>   
    </div>
</section>

</body>
</html>