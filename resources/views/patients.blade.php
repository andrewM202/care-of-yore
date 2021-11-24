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
                    <section class="container mx-auto mt-5">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Name</th>
                                            <th class="px-4 py-3">Age</th>
                                            <th class="px-4 py-3">Emergency Contact</th>
                                            <th class="px-4 py-3">Emergency Contact Name</th>
                                            <th class="px-4 py-3">Admission Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <tr class="text-gray-700">
                                            <td class="px-4 py-3 border">
                                                1
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                Patient
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                83
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                (123) 456-7890
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                Andrew Matt
                                            </td>
                                            <td class="px-4 py-3 text-sm border">
                                                01/01/2020
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