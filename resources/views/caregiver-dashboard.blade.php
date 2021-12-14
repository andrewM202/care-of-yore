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
                <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Caregiver's Home : <?php echo date('Y-m-d'); ?></h3>
                    <section class="container mx-auto mt-5">
                            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                                <th class="px-4 py-3">Name</th>
                                                <th class="px-4 py-3">Morning Med</th>
                                                <th class="px-4 py-3">Afternoon Med</th>
                                                <th class="px-4 py-3">Night Med</th>
                                                <th class="px-4 py-3">Breakfast</th>
                                                <th class="px-4 py-3">Lunch</th>
                                                <th class="px-4 py-3">Dinner</th>
                                                <th class="px-4 py-3">Update</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach($patients as $patient)
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3 border">
                                                    {{ $patient->patient_name ?? 'Name Not Set' }}
                                                </td>
                                                <td class="px-4 py-3 text-ms font-semibold border">
                                                    {{ $patient->morning_med ?? 'None' }}
                                                </td>
                                                <td class="px-4 py-3 text-ms font-semibold border">
                                                    {{ $patient->afternoon_med ?? 'None' }}
                                                </td>
                                                <td class="px-4 py-3 text-ms font-semibold  border">
                                                    {{ $patient->evening_med ?? 'None' }}
                                                </td>
                                                <form method='post' action='{{ route('update-food') }}'>
                                                @csrf
                                                    <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
                                                    <td class="px-4 py-3 text-ms font-semibold border">
                                                        <input type="text" name='breakfast' value="{{ $patient->breakfast ?? 'Not Set' }}" placeholder="None Set">
                                                    </td>
                                                    <td class="px-4 py-3 text-ms font-semibold border">
                                                        <input type="text" name='lunch' value="{{ $patient->lunch ?? 'Not Set' }}" placeholder="None Set">
                                                    </td>
                                                    <td class="px-4 py-3 text-ms font-semibold border">
                                                        <input type="text" name='dinner' value="{{ $patient->dinner ?? 'Not Set' }}" placeholder="None Set">
                                                    </td>
                                                    <td class="px-4 py-3 text-ms font-semibold border">
                                                        <x-button>Ok</x-button>
                                                    </td>
                                                </form>
                                            </tr>
                                            @endforeach
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