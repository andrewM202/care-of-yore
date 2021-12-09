<x-app-layout>
    <body>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- <div class='flex flex-row justify-center'> -->
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Employee List') }}
                                </h2>
                            </x-slot>
                            <div class="flex-col">
                                <form method="GET" class='m-10' action={{ route('get-roster') }}>
                                    @csrf 
                                    <h1 class="ml-2 text-2xl mb-4">Search For Employee</h1>
                                    <div class="flex flex-col md:flex-row">
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>ID</label>
                                          <x-input type='text' name='roster_date'/>
                                       </div>
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>Name</label>
                                          <x-input type='text' name='roster_date'/>
                                       </div>
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>Roll</label>
                                          <x-input type='text' name='roster_date'/>
                                       </div>
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>Salary</label>
                                          <x-input type='text' name='roster_date'/>
                                       </div>
                                    </div>
                                    <div class='mt-5'>
                                        <x-button type="submit">Search</x-button>
                                    </div>
                                </form>
                                <form method="GET" class='m-10' action={{ route('get-roster') }}>
                                    @csrf 
                                    <h1 class="ml-2 text-2xl mb-4">Set New Salary</h1>
                                    <div class="flex flex-col md:flex-row">
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>ID</label>
                                          <x-input type='text' name='roster_date'/>
                                       </div>
                                       <div id='roleCreation' class='flex flex-col max-w-sm mx-2'>
                                          <label for='newRole'>New Salary</label>
                                          <x-input type='text' name='roster_date'/>
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
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
