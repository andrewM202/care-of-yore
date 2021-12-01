<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col sm:flex-row justify-center p-6 bg-white border-b border-gray-200">
                    <div class="mx-8 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Employees</h3>
                     <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                           <thead>
                              <tr>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">ID</th>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Name</th>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Role</th>
                                 <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Salary</th>
                              </tr>
                           </thead>
                           <tbody class="divide-y divide-gray-100">
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">30%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">24%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">18%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">12%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                                 <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                                 <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">9%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-indigo-600 h-2 rounded-sm" style="width: 9%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="text-gray-500">
                                 <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                                 <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                                 <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                                    <div class="flex items-center">
                                       <span class="mr-2 text-xs font-medium">7%</span>
                                       <div class="relative w-full">
                                          <div class="w-full bg-gray-200 rounded-sm h-2">
                                             <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                    </div>
                    <div class="flex items-center h-full">
                        <div class='h-full grid grid-rows-2 gap-4'>
                            <div class="flex justify-center flex-col">
                                <x-label for='employee-id' :value="__('Employee ID')" />
                                <x-input type="text" id="employee-id" class="form-input" />
                            </div>
                            <div class="flex justify-center flex-col">
                                <x-label for='employee-name' :value="__('Employee Name')" />
                                <x-input type="text" id="employee-name" class="form-input" />
                            </div>
                            <div class="flex justify-center flex-col">
                                <x-label for='employee-role' :value="__('Employee Role')" />
                                <x-input type="text" id="employee-role" class="form-input" />
                            </div>
                            <div class="flex justify-center flex-col">
                                <x-label for='new-salary' :value="__('New Salary')" />
                                <x-input type="text" id="new-salary" class="form-input" />
                            </div>
                            <div class="flex justify-center">
                                <x-button class="mx-4">Ok</x-button>
                                <x-button type='reset' class="mx-4">Cancel</x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
