@include('partials.header')
    
@include('components.navigation')

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl">
            <h2 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Rebooking Guide</h2>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step1.png')}}" alt="Step 1">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 1</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    To initiate the process, locate the "Manage Booking" button in the navigation bar. Clicking on it will redirect you to the Manage Booking page.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step2.png')}}" alt="Step 2">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 2</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    At this stage, you are required to enter the booking reference along with the email address. Once entered, simply click the "Find My Booking" button. The system will search for your booking and subsequently redirect you to another page.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step3.png')}}" alt="Step 3">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 3</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    In here, you have the option to download your booking. If you haven't selected a seat for your booking, you can do so here. Alternatively, if you wish to rebook, simply click the "Rebook" button, and it will redirect you to another page.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step4.png')}}" alt="Step 4">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 4</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    At this stage, you have the option to modify your booking by selecting a new schedule based on your preferred ferry and accommodation. Please note that changes to the ferry and accommodation are not permitted. After selecting the desired schedule, simply click "Proceed to Summary."
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step5.png')}}" alt="Step 5">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 5</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    In this step, you can review the summary of the trip you have chosen, along with the payment details. Select your preferred payment method, and after making your choice, click "Proceed to Payment." This action will redirect you to a secure payment gateway.
                </p>
            </div>
        </div>
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full" src="{{asset('guide/rebooking_step6.png')}}" alt="Step 6">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Step 6</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                    Upon completing the payment, you will be redirected back to our website. Here, you can select your seat number. If you already have a specific seat in mind, simply click "Select". After confirming your seat, you'll have the option to download your ticket using the provided download button.
                </p>
            </div>
        </div>
    </section>

@include('partials.footer')