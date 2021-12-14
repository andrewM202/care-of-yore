<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Patient's Home</h3>
                <section>
                    <div class="grid grid-cols-2 gap-4 m-5">
                        <div class='grid grid-rows-2 gap-4'>
                            <div>
                                <x-label for='patient-id' :value="__('Patient ID')" />
                                <x-input type="text" id="patient-id" class="form-input" value='{{ $patient_id }}' readonly />
                            </div>
                            <div>
                                <x-label for='patient-name' :value="__('Patient Name')" />
                                <x-input type="text" id="patient-name" class="form-input" value='{{ $patient_name[0]->name }}' readonly />
                            </div>
                        </div>
                        <div class='grid grid-rows-2 gap-4'>
                            <div>
                                <x-label for='date' :value="__('Date')" />
                                <x-input type="text" id="patient-id" class="form-input" value='{{ date("m/d/Y") }}' readonly />
                            </div>
                        </div>
                    </div>
                </section>
                <section class="container mx-auto mt-5">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                        <th class="px-4 py-3">Doctor Name</th>
                                        <th class="px-4 py-3">Doctor's Appointment</th>
                                        <th class="px-4 py-3">Caregiver's Name</th>
                                        <th class="px-4 py-3">Morning Medicine</th>
                                        <th class="px-4 py-3">Afternoon Medicine</th>
                                        <th class="px-4 py-3">Night Medicine</th>
                                        <th class="px-4 py-3">Breakfast</th>
                                        <th class="px-4 py-3">Lunch</th>
                                        <th class="px-4 py-3">Dinner</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                {{ $doctor[0]->doctor_name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            {{ $doctor[0]->appointment_date }}
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            {{ $caregiver_name[0]->name }}
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            @if($medicine[0]->morning_med == '')
                                            None
                                            @else
                                            {{ $medicine[0]->morning_med ?? 'None' }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            @if($medicine[0]->afternoon_med == '')
                                            None
                                            @else
                                            {{ $medicine[0]->afternon_med ?? 'None' }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            @if($medicine[0]->evening_med == '')
                                            None
                                            @else
                                            {{ $medicine[0]->evening_med ?? 'None' }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            {{ $feed[0]->breakfast ?? 'None' }}
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            {{ $feed[0]->lunch ?? 'None' }}
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            {{ $feed[0]->dinner ?? 'None' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>