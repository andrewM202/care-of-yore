<x-app-layout>
    <body>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class='flex flex-row justify-center'>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Role Management') }}
                    </h2>
                </x-slot>
                        <div>
                            <form method="POST" class='m-10' action="{{ route('add-role') }}">
                                @csrf 

                                <div id='roleCreation' class='flex flex-col max-w-sm'>
                                    <label for='newRole'>New Role</label>
                                    <input type='text' placeholder='Patient' name='newRole'>
                                    <label for='accessLevel' class='mt-5'>Access Level</label>
                                    <input type='number' placeholder='5' min="0" name='accessLevel'>
                                </div>
                                <div class='mt-5'>
                                    <x-button type="submit">Ok</x-button>
                                </div>
                            </form>
                            <form method="POST" class='m-10' action="{{ route('delete-role') }}">
                                @csrf 

                                <div id='roleCreation' class='flex flex-col max-w-sm'>
                                    <label for='roleName'>Delete Role</label>
                                    <input type='text' placeholder='Roll Name' name='roleName'>
                                </div>
                                <div class='mt-5'>
                                    <x-button type="submit">Ok</x-button>
                                </div>
                            </form>
                        </div>

                        <div id='roles' class='m-10'>
                            <table class='table-auto'>
                                <thead>
                                    <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3">Access Level</th>
                                    </tr>
                                </thead>
                                <tbody class='bg-white'>
                                    @foreach($roles as $role)
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">{{ $role->role_name }}</td>
                                            <td class="px-4 py-3 border">{{ $role->access_level }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
        
        
    </body>
</x-app-layout>
