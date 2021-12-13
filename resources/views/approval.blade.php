<x-app-layout>
    <body>
        <x-spencer>
            <slot name="slot">
            <div class='flex justify-center'>
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Registration Approval') }}
                        </h2>
                    </x-slot>
                        <div class='container m-5 flex justify-center flex-col'>
                            @if ($users ?? [] != [])
                                <h2 class='text-xl text-center'>Approve User? There {{ (count($users) == 1 ? 'is ' : 'are ').count($users).(count($users) == 1 ? ' user' : ' users') }} to evaluate</h2>
                                <div class='flex justify-center'>
                                    <table class='table-auto mt-5'>
                                        <thead>
                                            <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                                <th class="px-4 py-3">Name</th>
                                                <th class="px-4 py-3">Role</th>
                                                <th class="px-4 py-3">Email</th>
                                                <th class="px-4 py-3">Phone</th>
                                                <th class="px-4 py-3">Date of Birth</th>
                                            </tr>
                                        </thead>
                                        <tbody class='bg-white'>
                                            <input type='hidden' name='id' value='{{ $users[0]->id }}'>
                                            <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                                <td class="px-4 py-3">{{ $users[0]->first_name." ".$users[0]->last_name }}</td>
                                                <td class="px-4 py-3">{{ $users[0]->role }}</td>
                                                <td class="px-4 py-3">{{ $users[0]->email }}</td>
                                                <td class="px-4 py-3">{{ $users[0]->phone }}</td>
                                                <td class="px-4 py-3">{{ $users[0]->date_of_birth }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class='m-5'>
                                        <form method='POST' action='{{ route("approve-user") }}'>
                                            @csrf 
                                            <input type='hidden' name='id' value='{{ $users[0]->id }}'>
                                            <x-button type='submit' class=''>Approve</x-button>
                                        </form>
                                        <form class='mt-5' method='POST' action='{{ route("decline-user") }}'>
                                            @csrf 
                                            <input type='hidden' name='id' value='{{ $users[0]->id }}'>
                                            <x-button type='submit' class=''>Decline</x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h2 class='text-xl'>There are no users to evaluate</h2>
                        @endif
                    </div>
                </div>
            </slot>
        </x-spencer>
    </body>
</x-app-layout>
