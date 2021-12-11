<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name='slot'>
            @if (Auth::user()->role == 1)
                <x-admin-home></x-admin-home>
            @elseif (Auth::user()->role == 3)
                <x-patient-home></x-patient-home>
            @elseif (Auth::user()->role == 4)
                <x-doctor-home></x-doctor-home>
            @elseif (Auth::user()->role == 5)
                <x-caregiver-home></x-caregiver-home>
            @elseif (Auth::user()->role == 6)
                <x-family-member-home></x-family-member-home>
            @endif
        </x-slot>
    </x-spencer>
</x-app-layout>
