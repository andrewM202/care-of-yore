<h3 class='font-semibold text-lg text-gray-800 leading-tight'>Family Member's Home</h3>
<section>
    <form>
        <div class="grid grid-cols-2 gap-4 m-5">
            <div class='grid grid-rows-2 gap-4'>
                <div>
                    <x-label for='date' :value="__('Date')" />
                    <x-input type="date" id="date" class="form-input" />
                </div>
                <div>
                    <x-label for='family-code' :value="__('Family Code')" />
                    <x-input type="text" id="family-code" class="form-input" />
                </div>
            </div>
            <div class='grid grid-rows-2 gap-4'>
                <div>
                    <x-label for='patient-id' :value="__('Patient ID')" />
                    <x-input type="text" id="patient-id" class="form-input" />
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
                            <div class="flex items-center text-sm">
                                Dr. Arafat
                            </div>
                        </td>
                        <td class="px-4 py-3 text-ms font-semibold border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            Mainul Chowdhury
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <input type='checkbox' disabled>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</section>