<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 rounded-lg py-8 px-6 my-3 bg-gray-100 dark:bg-gray-700">
    <div class="w-full">
        <label for="contact-person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Person<span class="text-red-600">*</span></label>
        <input type="text" name="contact-person" id="contact-person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Full Name" value="{{old('contact-person')}}" required>
        @error("contact-person")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number<span class="text-red-600">*</span></label>
        <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. 09561234567" value="{{old('phone')}}" required>
        @error("phone")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Adress<span class="text-red-600">*</span></label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@email.com" value="{{old('email')}}" required>
        @error("email")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full">
        <label for="confirm-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Email Adress<span class="text-red-600">*</span></label>
        <input type="confirm-email" name="confirm-email" id="confirm-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@email.com" value="{{old('confirm-email')}}" required>
        @error("confirm-email")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="sm:col-span-2">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address<span class="text-red-600">*</span></label>
        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="e.g. Zamboanga City, Sta. Catalina" value="{{old('address')}}" required>
        @error("address")
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>