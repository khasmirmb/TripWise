@for ($x = 1; $x <= $passenger; $x++)
<div class="grid gap-4 sm:grid-cols-3 sm:gap-6 rounded-lg my-4 py-8 px-6 bg-gray-100 dark:bg-gray-700">
    <div class="sm:col-span-3 my-2">
        <span class="bg-blue-100 text-blue-800 text-lg font-medium mr-2 px-2.5 py-1.5 rounded dark:bg-blue-900 dark:text-blue-300"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 inline w-6 h-6 mr-1 mb-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Passenger #{{$x}}</span>
    </div>
    <div class="w-full">
        <label for="firstname{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name<span class="text-red-600">*</span></label>
        <input type="text" name="firstname{{$x}}" id="firstname{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old("firstname{$x}") }}" style="text-transform: capitalize;" required>
        @error("firstname{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="middlename{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
        <input type="text" name="middlename{{$x}}" id="middlename{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old("middlename{$x}") }}" style="text-transform: capitalize;">
        @error("middlename{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="lastname{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name<span class="text-red-600">*</span></label>
        <input type="text" name="lastname{{$x}}" id="lastname{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old("lastname{$x}") }}" style="text-transform: capitalize;" required>
        @error("lastname{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="gender{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender<span class="text-red-600">*</span></label>
        <select id="gender{{$x}}" name="gender{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option selected="" {{ (old("gender{$x}") == '') ? 'selected' : '' }}>Select Gender</option>
            <option value="Male" {{ (old("gender{$x}") == 'Male') ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ (old("gender{$x}") == 'Female') ? 'selected' : '' }}>Female</option>
        </select>
        @error("gender{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="birthday{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth<span class="text-red-600">*</span></label>
        <input type="date" name="birthday{{$x}}" id="birthday{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old("birthday{$x}") }}" max="{{ now()->toDateString() }}" required>
        @error("birthday{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full mt-2 sm:mt-9">
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" name="discountToggle{{$x}}" value="discountToggle{{$x}}" class="sr-only peer" id="discountToggle{{$x}}">
            <div class="w-11 h-6 bg-gray-500 rounded-full peer peer-focus:ring-4 peer-focus:ring-teal-300 dark:peer-focus:ring-teal-800 dark:bg-gray-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-teal-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">PWD/Student/Senior</span>
        </label>
    </div>
    <div id="discountSection{{$x}}" class="w-full sm:col-span-3 grid gap-4 sm:grid-cols-3 sm:gap-6 rounded-lg" style="display: none;">
        <div class="w-full">
            <label for="dis_type{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type<span class="text-red-600">*</span></label>
            <select id="dis_type{{$x}}" name="dis_type{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected value="">Select Type</option>
                <option value="Student">Student</option>
                <option value="PWD">PWD</option>
                <option value="Senior">Senior</option>
            </select>
            @error("dis_type{$x}")
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input_front{{$x}}">Upload Front of ID<span class="text-red-600">*</span></label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_front_help{{$x}}" id="file_input_front{{$x}}" type="file" name="id_front{{$x}}" accept="image/jpeg, image/png, image/jpg">
            @error("id_front{$x}")
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input_back{{$x}}">Upload Back of ID<span class="text-red-600">*</span></label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_back_help{{$x}}" id="file_input_back{{$x}}" type="file" name="id_back{{$x}}" accept="image/jpeg, image/png, image/jpg">
            @error("id_back{$x}")
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
@endfor

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="module">
    $(document).ready(function () {
        @for ($x = 1; $x <= $passenger; $x++)
            const discountToggle{{$x}} = $("#discountToggle{{$x}}");
            const discountSection{{$x}} = $("#discountSection{{$x}}");
            const disType{{$x}} = $("#dis_type{{$x}}");

            // Get the stored state from localStorage
            const storedState{{$x}} = localStorage.getItem("discountToggleState{{$x}}");

            // Set the initial state based on the stored value
            if (storedState{{$x}} === "true") {
                discountToggle{{$x}}.prop("checked", true);
                discountSection{{$x}}.show();
            }

            discountToggle{{$x}}.change(function () {
                if (discountToggle{{$x}}.prop("checked")) {
                    discountSection{{$x}}.show();
                } else {
                    discountSection{{$x}}.hide();
                    disType{{$x}}.val('');
                }

                // Store the state in localStorage
                localStorage.setItem("discountToggleState{{$x}}", discountToggle{{$x}}.prop("checked"));
            });
        @endfor
    });
</script>
