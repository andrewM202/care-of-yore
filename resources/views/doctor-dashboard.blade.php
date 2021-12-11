<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Doctor's Home</h3>

                    <section class="container mt-5 w-full">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <h4>Previous appointments</h4>
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">Name</th>
                                            <th class="px-4 py-3">Date</th>
                                            <th class="px-4 py-3">Comment</th>
                                            <th class="px-4 py-3">Morning Med</th>
                                            <th class="px-4 py-3">Afternoon Med</th>
                                            <th class="px-4 py-3">Night Med</th>
                                            <th class="px-4 py-3">Update Meds</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($oldAppointments as $appointment)
                                            <tr class="text-gray-700">
                                                <form method='post' action='{{ route('update-meds') }}'>
                                                    @csrf
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            {{ $appointment->patient_name }}
                                                            <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        {{ $appointment->appointment_date }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        Placeholder comment
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        <input type="text" name='morning_med' value="{{ $appointment->morning_med }}">
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        <input type="text" name='afternoon_med' value="{{ $appointment->afternoon_med }}">
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        <input type="text" name='evening_med' value="{{ $appointment->evening_med }}">
                                                    </td>
                                                    <td class="px-4 py-3 text-sm border">
                                                        <x-button type='submit'>Update</x-button>
                                                    </td>
                                                </form>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section class="flex">
                        <form action='{{ route('doctor-dashboard') }}' method='get'>
                            <div class="flex flex-col mx-4">
                                <p>Appointments</p>
                                <div class="py-4">
                                    <x-label for='till-date' :value="__('Till Date')" />
                                    <x-input type="date" name='till-date' id="till-date" class="form-input" />
                                </div>
                                <x-button class="w-32 flex justify-center">Submit</x-button>
                            </div>
                        </form>
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">Patient</th>
                                            <th class="px-4 py-3">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($appointmentsTill as $appointment)
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        {{ $appointment->patient_name }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm border">
                                                    {{ $appointment->appointment_date }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <!-- <section class="container mx-auto mt-5">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">Patient</th>
                                            <th class="px-4 py-3">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($appointmentsTill as $appointment)
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        {{ $appointment->patient_name }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm border">
                                                    {{ $appointment->appointment_date }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
