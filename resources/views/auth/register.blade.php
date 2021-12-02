<x-guest-layout>
    <x-slot name="header">
        <h2 class="absolute bottom-1/4 hidden sm:inline-block font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register') }}
        </h2>
        <h1 class="absolute left-2/4 font-semibold text-3xl bg-white p-8 px-32 text-gray-800 text-center 
        border-green-300 border-b-4 border-r-4 border-l-4 rounded-xl" 
        style="left: calc(50% - 218.135px);">
            Care Of Yore
        </h1>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-36 h-36 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class='grid grid-rows-6 grid-flow-col gap-y-2 gap-x-4 border-b-2 pb-3'>
                <!--Role-->
                <div>
                    <x-label for='role' :value='__("Select Role")' />

                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='role' id='role'>
                        <option value="">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Patient</option>
                        <option value="4">Doctor</option>
                        <option value="5">Caregiver</option>
                        <option value="6">Family Member</option>
                    </select>
                </div>

                <div>
                    <x-label for='first_name' :value='__("First Name")' />
                    
                    <x-input id='first_name' class='block mt-1 w-full' type='text' name='first_name' :value='old("first_name")' required />
                </div>

                <div>
                    <x-label for='last_name' :value='__("Last Name")' />
                    
                    <x-input id='last_name' class='block mt-1 w-full' type='text' name='last_name' :value='old("last_name")' required />
                </div>

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                </div>

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div>
                    <x-label for='phone' 
                    :value='__("Phone")' />
                    
                    <x-input id='phone' 
                    class='block mt-1 w-full' 
                    type='tel' 
                    name='phone' 
                    :value='old("phone")'
                    pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' 
                    placeholder='123-456-7890'
                    required />
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>
                <div>
                    <x-label for='date_of_birth' :value='__("Date of Birth")' />
                    
                    <x-input id='date_of_birth' class='block mt-1 w-full' type='date' name='date_of_birth' :value='old("address")' required />
                </div>
                <div>
                    <x-label for='family_code' :value='__("Family Code")' />
                    
                    <x-input id='family_code' class='block mt-1 w-full' type='text' name='family_code' :value='old("family-code")' />
                </div>
                <div>
                    <x-label for='emergency_contact' :value='__("Emergency Contact")' />
                    
                    <x-input id='emergency_contact' class='block mt-1 w-full' type='text' name='emergency_contact' :value='old("emergency_contact")' />
                </div>
                <div>
                    <x-label for='emergency_contact' :value='__("Relation to Emergency Contact")' />
                    
                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' id='emergency_contact' name='emergency_contact'>
                        <option value="">Select Relation</option>
                        <option value="1">Mother</option>
                        <option value="2">Father</option>
                        <option value="3">Sister</option>
                        <option value="4">Brother</option>
                        <option value="5">Son</option>
                        <option value="6">Daughter</option>
                        <option value="7">Grandson</option>
                        <option value="8">Granddaughter</option>
                        <option valur='7'>Cousin</option>
                        <option value="8">Friend</option>
                        <option value="9">Other</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end mt-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
