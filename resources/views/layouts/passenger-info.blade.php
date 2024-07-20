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
        <input type="text" name="firstname{{$x}}" id="firstname{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{ old("firstname{$x}") }}" style="text-transform: capitalize;" placeholder="Firstname" required>
        @error("firstname{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="middlename{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
        <input type="text" name="middlename{{$x}}" id="middlename{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="Middlename" value="{{ old("middlename{$x}") }}" style="text-transform: capitalize;">
        @error("middlename{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="lastname{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name<span class="text-red-600">*</span></label>
        <input type="text" name="lastname{{$x}}" id="lastname{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{ old("lastname{$x}") }}" style="text-transform: capitalize;" placeholder="Lastname" required>
        @error("lastname{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="gender{{$x}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender<span class="text-red-600">*</span></label>
        <select id="gender{{$x}}" name="gender{{$x}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500">
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
        <input type="date" name="birthday{{$x}}" id="birthday{{$x}}" class="birthday-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" value="{{ old("birthday{$x}") }}" max="{{ now()->toDateString() }}" required>
        @error("birthday{$x}")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
@endfor
