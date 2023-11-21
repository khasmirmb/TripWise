@include('partials.header')

    @include('components.navigation')

    <section class="bg-white dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl dark:text-white">Manage Booking</h2>
                    <p class="mx-auto mb-8 max-w-2xl font-light text-gray-500 md:mb-12 sm:text-xl dark:text-gray-400">Enter your Booking Reference Number and Email below to access and manage your booking details.</p>
                </div>
                <div class="mx-auto max-w-screen-md">
                    <form action="{{route('booking.manage.find')}}" method="POST">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="booking_reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Reference Number<span class="text-red-600">*</span></label>
                                <input type="text" id="booking_reference" name="booking_reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="e.g. sFHO-fDQx5n6BTnD" value="{{ old('booking_reference') }}" required>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email<span class="text-red-600">*</span></label>
                                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="name@email.com" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="text-sm text-left text-gray-500 newsletter-form-footer dark:text-gray-300">Should you need assistance with your booking, please submit your concerns/inquiries to our <a href="#" class="font-medium text-teal-600 dark:text-teal-500 hover:underline">Help/Support</a>.</div>
                        <div class="flex justify-end my-4">
                            <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">
                                Find My Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@include('partials.footer')