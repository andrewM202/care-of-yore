
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name='slot'>
            <h3 class='font-semibold text-lg text-gray-800 leading-tight'>Home Page</h3>
                <x-button>
                    Hello?
                </x-button>
        </x-slot>
    </x-spencer>
</x-app-layout>