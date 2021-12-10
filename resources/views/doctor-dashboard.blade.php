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
                    <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Doctor's Home</h3>

                    <section class="container mx-auto mt-5">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <form method='post' action='{{ route('update-meds')}}'>
                                    @csrf
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">Name</th>
                                            <th class="px-4 py-3">Date</th>
                                            <th class="px-4 py-3">Comment</th>
                                            <th class="px-4 py-3">Morning Med</th>
                                            <th class="px-4 py-3">Afternoon Med</th>
                                            <th class="px-4 py-3">Night Med</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($appointments as $appointment)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">
                                                <div class="flex items-center text-sm">
                                                    {{ $appointment->patient_name }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $appointment->appointment_date }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                Placeholder comment
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $appointment->morning_med }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $appointment->afternoon_med }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $appointment->evening_med }}
                                            </td>
                                        </tr>
                    `                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section>
                        <form>
                            <div class="grid grid-cols-3 gap-4 m-5">
                                <p>Appointments</p>
                                <div>
                                    <x-label for='till-date' :value="__('Till Date')" />
                                    <x-input type="date" id="till-date" class="form-input" />
                                </div>
                                <x-button>Submit</x-button>
                            </div>
                        </form>
                    </section>

                    <section class="container mx-auto mt-5">
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
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">
                                                <div class="flex items-center text-sm">
                                                    Dr. Arafat
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                Date
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