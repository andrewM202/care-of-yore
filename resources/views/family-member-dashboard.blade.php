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
                    <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Family Member's Home</h3>
                    @if (isset($error))
                    <h3 class="text-red-500">{{ $error }}</h3>
                    @endif
                    <section>
                        <form method="post" action="{{ route('family-member-patient-details') }}">
                            @csrf
                            <div class="grid grid-cols-2 gap-4 m-5">
                                <div class='grid grid-rows-2 gap-4'>
                                    <div>
                                        <x-label for='date' :value="__('Date (Optional)')" />
                                        <x-input type="date" id="date" class="form-input" />
                                    </div>
                                    <div>
                                        <x-label for='family_code' :value="__('Family Code')" />
                                        <x-input type="text" name="family_code" id="family_code" class="form-input" />
                                    </div>
                                </div>
                                <div class='grid grid-rows-2 gap-4'>
                                    <div>
                                        <x-label for='patient_id' :value="__('Patient ID')" />
                                        <x-input type="text" name="patient_id" id="patient_id" class="form-input" />
                                    </div>
                                    <div>
                                        <x-button>Ok</x-button>
                                        <x-button type='reset'>Cancel</x-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>

                    <section class="container mx-auto mt-5">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">Doctor's Name</th>
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
                                                {{ $doctor[0]->doctor_name }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                {{ $doctor[0]->appointment_date }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                {{ $caregiver[0]->caregiver_name }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                {{ $medicine[0]->morning_med ?? 'None' }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                {{ $medicine[0]->afternoon_med ?? 'None' }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                {{ $medicine[0]->evening_med ?? 'None' }}
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                @if($feed[0]->breakfast == '')
                                                Not Set
                                                @else
                                                {{ $feed[0]->breakfast ?? 'Not Set' }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                @if($feed[0]->lunch == '')
                                                Not Set
                                                @else
                                                {{ $feed[0]->lunch ?? 'Not Set' }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                @if($feed[0]->dinner == '')
                                                Not Set
                                                @else
                                                {{ $feed[0]->dinner ?? 'Not Set' }}
                                                @endif
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