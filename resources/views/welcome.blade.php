
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border rounded-lg border-gray-200">
                    <div class="w-full">
                        <div class="flex bg-white justify-between" style='height: 30rem'>
                            <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
                                <div>
                                    <h1 class="py-5 text-8xl font-semibold text-gray-800 md:text-8xl">Welcome, {{ Auth::user()->first_name }}</h1>
                                    <div>
                                        <a href="{{ url('/dashboard')}}" class='inline-flex items-center px-4 border-gray-500 rounded-md py-2 bg-green-300 border border-transparent rounded-md font-semibold text-2xl text-gray-700 uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>Dashboard</a>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden sm:block lg:w-1/2">
                                <div class="h-full object-cover" style="background-image: url(https://content.fortune.com/wp-content/uploads/2015/04/courtyard-4.jpg?w=840); background-size: cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>