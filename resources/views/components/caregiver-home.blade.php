<h3 class='font-semibold text-lg text-gray-800 leading-tight'>Caregiver's Home</h3>

<form>
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
                                <input type='checkbox'>
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                <input type='checkbox'>
                            </td>
                            <td class="px-4 py-3 text-sm border">
                                <input type='checkbox'>
                            </td>
                            <td class="px-4 py-3 text-sm border">
                                <input type='checkbox'>
                            </td>
                            <td class="px-4 py-3 text-sm border">
                                <input type='checkbox'>
                            </td>
                            <td class="px-4 py-3 text-sm border">
                                <input type='checkbox'>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class='float-right m-5'>
            <x-button>Ok</x-button>
            <x-button type='reset'>Cancel</x-button>
        </div>
    </section>
</form>