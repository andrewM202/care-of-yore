<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Home Page</h3>
                    <section class="container mx-auto p-6 font-mono">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                          <div class="w-full overflow-x-auto">
                            <table class="w-full">
                              <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
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
                                    <td class="px-4 py-3 text-ms font-semibold border">12:00</td>
                                    <td class="px-4 py-3 text-sm border">
                                        Mainul Chowdhury
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
                      </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
