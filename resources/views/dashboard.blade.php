<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Home Page</h3>
                    <x-button>
                        Hello?
                    </x-button>
                    <section class="container mx-auto p-6 font-mono">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                          <div class="w-full overflow-x-auto">
                            <table class="w-full">
                              <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                  <th class="px-4 py-3">Name</th>
                                  <th class="px-4 py-3">Age</th>
                                  <th class="px-4 py-3">Status</th>
                                  <th class="px-4 py-3">Date</th>
                                </tr>
                              </thead>
                              <tbody class="bg-white">
                                <tr class="text-gray-700">
                                  <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                      <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="https://images.pexels.com/photos/5212324/pexels-photo-5212324.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                      </div>
                                      <div>
                                        <p class="font-semibold text-black">Sufyan</p>
                                        <p class="text-xs text-gray-600">Developer</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="px-4 py-3 text-ms font-semibold border">22</td>
                                  <td class="px-4 py-3 text-xs border">
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Acceptable </span>
                                  </td>
                                  <td class="px-4 py-3 text-sm border">6/4/2000</td>
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
