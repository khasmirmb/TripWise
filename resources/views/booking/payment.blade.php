@include('partials.header')

    @include('components.navigation')

    @include('layouts.itinerary')

    @include('layouts.progress-payment')

    @include('components.error-message')

    @php
        use App\Models\Schedules;
        use App\Models\Ferries;

        $depart_sched = Schedules::find($dep_sched_id);

        $depart_ferry = Ferries::find($depart_sched->ferry_id);

        if(!is_null($return_date)){

            $return_sched = Schedules::find($ret_sched_id);

            $return_ferry = Ferries::find($return_sched->ferry_id);
        }

    @endphp

    <section class="bg-white dark:bg-gray-800">
        <div class="grid w-full lg:px-8 lg:grid-cols-2 lg:py-8 px-4 py-4">

            @include('layouts.payment-summary')

            @include('layouts.payment-gateway')
            
        </div>
    </section>

@include('partials.footer')