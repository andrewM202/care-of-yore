<h3 class='font-semibold text-lg text-gray-800 leading-tight'>Doctor's Home</h3>

<section class="container mx-auto mt-5">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
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
                    </tr>

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
                <label for='date'>Till Date</label>
                <input type='date' placeholder='Till Date' name='date' value='date'>
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
                        <td class="px-4 py-3 text-ms font-semibold border">
                            <input type='checkbox' disabled>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</section>