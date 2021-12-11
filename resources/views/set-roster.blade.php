<x-app-layout>
    <body>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Set Roster') }}
            </h2>
        </x-slot>
        <x-spencer>
            <x-slot name="slot">
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
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Supervisor</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Supervisor' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee) 
                                            @if($rostee->role == 'Supervisor')
                                            @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="None" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($supervisors as $supervisor)
                                        <option value="{{ $supervisor->name }}">{{ $supervisor->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Doctor</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Doctor' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee)
                                            @if($rostee->role == 'Doctor')
                                            @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="None" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Caregiver 1</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Caregiver1' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee)
                                            @if($rostee->role == 'Caregiver1')
                                            @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($caregivers as $caregiver)
                                        <option value="{{ $caregiver->name }}">{{ $caregiver->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Caregiver 2</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Caregiver2' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee)
                                            @if($rostee->role == 'Caregiver2')
                                            @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($caregivers as $caregiver)
                                        <option value="{{ $caregiver->name }}">{{ $caregiver->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Caregiver 3</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Caregiver3' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee)
                                            @if($rostee->role == 'Caregiver3')
                                            @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($caregivers as $caregiver)
                                        <option value="{{ $caregiver->name }}">{{ $caregiver->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class='text-gray-700 font-semibold'>
                                <td class="px-4 py-3 border">Caregiver 4</td>
                                <td class="px-4 py-3 border">
                                    <select class='rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1' name='Caregiver4' id='role' onchange="disableDisable()">
                                        @php $found = 0 @endphp
                                        @foreach($roster as $rostee)
                                            @if($rostee->role == 'Caregiver4')
                                                @php $found = 1 @endphp
                                                @if($rostee->personnel_name == '')
                                                <option value="None" disabled selected hidden>Not Set</option>
                                                @else
                                                <option value="None" disabled selected hidden>{{ $rostee->personnel_name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($found == 0)
                                            <option value="" disabled selected hidden>Not Set</option>
                                        @endif
                                        <option value="">Not Set</option>
                                        @foreach($caregivers as $caregiver)
                                        <option value="{{ $caregiver->name }}">{{ $caregiver->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-4">
                        <x-button type="submit">Set Roster</x-button>
                    </div>
                </form>
            </x-slot>
        </x-spencer>
    </body>
</x-app-layout>
