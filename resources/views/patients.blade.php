<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class='m-10' action={{ route('patient-search') }}>
                        @csrf 
                        <h1 class="ml-2 text-2xl mb-4">Search For Patient</h1>
                        <div class="flex flex-wrap flex-col md:flex-row">
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='patient_id'>ID</label>
                                <x-input type='text' name='patient_id'/>
                            </div>
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='patient_name'>Name</label>
                                <x-input type='text' name='patient_name'/>
                            </div>
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='patient_date_of_birth'>Date of Birth</label>
                                <x-input type='date' name='patient_date_of_birth'/>
                            </div>
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='emergency_contact'>Emergency Contact</label>
                                <x-input type='text' name='emergency_contact'/>
                            </div>
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='emergency_contact_relation'>Emergency Contact Relation</label>
                                <x-input type='text' name='emergency_contact_relation'/>
                            </div>
                            <div id='roleCreation' class='flex flex-col max-w-sm mx-2 py-2'>
                                <label for='admission_date'>Admission Date</label>
                                <x-input type='date' name='admission_date'/>
                            </div>
                        </div>
                        <div class='mt-5'>
                            <x-button type="submit">Search</x-button>
                            <a href="/patients" class="ml-5 inline-flex items-center px-4 border-gray-500 rounded-md py-2 bg-green-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Refresh Search</a>
                        </div>
                    </form>
                    <section class="container mx-auto mt-5">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Name</th>
                                            <th class="px-4 py-3">Date Of Birth</th>
                                            <th class="px-4 py-3">Emergency Contact</th>
                                            <th class="px-4 py-3">Emergency Contact Relation</th>
                                            <th class="px-4 py-3">Admission Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach($patients as $patient)
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">
                                                {{ $patient->id }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $patient->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $patient->date_of_birth }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $patient->emergency_contact }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $patient->emergency_contact_relation }}
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                {{ $patient->admission_date }}
                                            </td>
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