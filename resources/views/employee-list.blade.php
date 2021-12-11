<x-app-layout>
    <body>
        <x-spencer>
            <x-slot name="slot">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Employee List') }}
                </h2>
            </x-slot>
            <div class="flex-col">
                <form method="POST" class='m-10' action={{ route('employee-search') }}>
                    @csrf 
                    <h1 class="ml-2 text-2xl mb-4">Search For Employee</h1>
                    <div class="flex flex-col md:flex-row">
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='employee_id'>ID</label>
                            <x-input type='text' name='employee_id'/>
                        </div>
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='employee_name'>Name</label>
                            <x-input type='text' name='employee_name'/>
                        </div>
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='employee_roll'>Roll</label>
                            <x-input type='text' name='employee_roll'/>
                        </div>
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='employee_salary'>Salary</label>
                            <x-input type='text' name='employee_salary'/>
                        </div>
                    </div>
                    <div class='mt-5'>
                        <x-button type="submit">Search</x-button>
                        <a href="/employee-list" class=" ml-5 inline-flex items-center px-4 border-gray-500 rounded-md py-2 bg-green-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Refresh Search</a>
                    </div>
                </form>
                <form method="POST" class='m-10' action={{ route('employee-new-salary') }}>
                    @csrf 
                    <h1 class="ml-2 text-2xl mb-4">Set New Salary</h1>
                    <div class="flex flex-col md:flex-row">
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='employee_id'>ID</label>
                            <x-input type='text' name='employee_id'/>
                        </div>
                        <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                            <label for='new_salary'>New Salary</label>
                            <x-input type='text' name='new_salary'/>
                        </div>
                    </div>
                    <div class='mt-5'>
                        <x-button type="submit">Submit</x-button>
                    </div>
                </form>
            </div>
                <h1 class="mb-1.5 text-center text-2xl">Employees</h1>
                <table class='table-auto w-full'>
                    <thead>
                        <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Salary</th>
                        </tr>
                    </thead>
                    <tbody class='bg-white'>
                        @foreach($employees as $employee)
                        <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">{{ $employee->id }}</td>
                                <td class="px-4 py-3 border">{{ $employee->name }}</td>
                                <td class="px-4 py-3 border">{{ $employee->role }}</td>
                                <td class="px-4 py-3 border">{{ $employee->salary }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
        </x-spencer>
    </body>
</x-app-layout>
