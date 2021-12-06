<x-app-layout>
    <body>
    <div class="py-12 justify-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class='flex justify-center'>
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Registration Approval') }}
                        </h2>
                    </x-slot>
                    <form method='POST'>
                        <div id='roles' class='m-10 flex flex-row'>
                            <table class='table-auto'>
                                <thead>
                                    <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3">Yes</th>
                                        <th class="px-4 py-3">No</th>
                                    </tr>
                                </thead>
                                <tbody class='bg-white'>
                                    @foreach($users as $user)
                                        <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                            <td class="px-4 py-3">{{ $user->first_name." ".$user->last_name }}</td>
                                            <td class="px-4 py-3">{{ $user->role }}</td>
                                            <td class="px-4 py-3 border">
                                                <input type='radio' name='approve'>
                                            </td>
                                            <td class="px-4 py-3 border">
                                                <input type='radio' name='approve'>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <x-button type='submit' class='ml-10 max-h-10 self-end mb-2'>Submit</x-button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </body>
</x-app-layout>
