<x-app-layout>
    <body>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- <div class='flex flex-row justify-center'> -->
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Set Roster') }}
                                </h2>
                            </x-slot>
                            <div class="flex">
                                <form method="GET" class='m-10' action={{ route('get-roster') }}>
                                    @csrf 
                                    <div id='roleCreation' class='flex flex-col max-w-sm'>
                                        <label for='newRole'>Roster Date</label>
                                        <x-input type='date' name='roster_date'/>
                                        <x-input type='hidden' name='is-view-roster' value=0 />
                                    </div>
                                    <div class='mt-5'>
                                        <x-button type="submit">Search</x-button>
                                    </div>
                                </form>
                            </div>
                            <form id='roles' class='m-10 flex justify-center flex-col' method='POST' action="{{ route('set-roster')}}">
                                @csrf
                                @empty($date)
                                <x-input type='hidden' name="roster_date" value='<?php echo date("m/d/Y"); ?>' />
                                <h1 class="mb-1.5 text-center text-xl">
                                    <?php echo date("m/d/Y") ?>
                                </h1>
                                @endempty
                                @foreach($date as $date)
                                <x-input type='hidden' name="roster_date" value="{{ $date }}" />
                                <h1 class="mb-1.5 text-center text-2xl">
                                    <?php 
                                        $date = strtotime($date); 
                                        echo date('m/d/Y', $date);
                                    ?>
                                </h1>
                                @endforeach
                                <table class='table-auto'>
                                    <thead>
                                        <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                                            <th class="px-4 py-3">Role</th>
                                            <th class="px-4 py-3">Personnel Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class='bg-white'>
                                        @foreach($roster as $rostee)
                                            @if(isset($rostee->roster_date) and isset($rostee->personnel_name))
                                            <tr class='text-gray-700 font-semibold'>
                                                <td class="px-4 py-3 border">{{ $rostee->role }}</td>
                                                @if($rostee->personnel_name !== '')
                                                <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='{{ $rostee->role }}' 
                                                value="{{ $rostee->personnel_name }}" /></td>
                                                @else
                                                <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='{{ $rostee->role }}' 
                                                value="" placeholder="Not Set" /></td>
                                                @endif
                                            </tr>
                                            @else
                                            <tr class='text-gray-700 font-semibold'>
                                                <td class="px-4 py-3 border">{{ $rostee->role }}</td>
                                                <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='supervisor' 
                                                value="" placeholder="Not Set" /></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @empty($roster)
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Supervisor</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='supervisor' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Doctor</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='doctor' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Caregiver 1</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='caregiver1' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Caregiver 2</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='caregiver2' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Caregiver 3</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='caregiver3' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        <tr class='text-gray-700 font-semibold'>
                                            <td class="px-4 py-3 border">Caregiver 4</td>
                                            <td class="px-4 py-3 border"><x-input class="w-full" type='text' name='caregiver4' value="" placeholder="Not Set" /></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="flex justify-center mt-4">
                                    <x-button type="submit">Set Roster</x-button>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
