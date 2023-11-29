@include('partials.header')
    
@include('components.navigation')

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl">
            <h2 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Booking Guide</h2>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step1.png')}}" alt="Step 1">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 1</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    To begin, select your trip type and then choose your origin and destination. Next, specify the departure date. If you're opting for a round trip, also select the return date. Finally, indicate the number of passengers and press "Search Voyage."
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step2.png')}}" alt="Step 2">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 2</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    Next, the system will display available options for your desired departure date and future departure dates. Once you've identified your preferred departure date, simply click "Select," and it will automatically be added to the summary. The system will provide feedback on the booking status, indicating whether the selected voyage is full or not, when you proceed by clicking "Continue."
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step3.png')}}" alt="Step 3">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 3</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    In this step, the system will prompt you to enter contact information and passenger details corresponding to the number of passengers you previously specified. Please ensure the accuracy of the provided contact information, as this will be used for sending important updates and information.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step4.png')}}" alt="Step 4">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 4</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    In this step, you'll find a comprehensive summary of your booking, including trip details and the information you provided. Additionally, a payment summary will be displayed, showing the total cost of your booking. You can choose from various payment methods, each with its associated charges. Once you've selected your preferred payment method, click "Proceed to Payment" to be redirected to the payment gateway.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step5.png')}}" alt="Step 5 Online">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 5: Online Payment</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    Upon completing the payment, you will be redirected back to our website. Here, you can select your seat number based on the type of accommodation chosen during your booking. If you already have a specific seat in mind, simply click "Select". After confirming your seat, you'll have the option to download your ticket using the provided download button.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/booking_step6.png')}}" alt="Step 5 OTC">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 5: Over The Counter</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    After clicking "Proceed to Payment," you will be redirected to a page where you can view your booking details. You can download these details and visit our office to make the payment at your convenience, as long as it is during our business hours.
                </p>
            </div>
        </div>
    </section>

@include('partials.footer')