<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center p-6 bg-white border-b border-gray-200">
                    <div class='grid grid-rows-2 gap-4'>
                        <form method='post' action="{{ route('doctor-appointment') }}">
                            @csrf
                            <div class="flex justify-center flex-col">
                                <x-label for='patient-id' :value="__('Patient ID')" />
                                <x-input name='patient_id' type="text" id="patient-id" class="form-input" />
                            </div>
                            @if (isset($patient_name))
                            <div class="flex justify-center flex-col">
                                <x-label for='patient-name' :value="__('Patient Name')" />
                                <x-input name='patient-name' value='{{ $patient_name["name"] }}' type="text" id="patient-name" class="form-input" readonly/>
                            </div>
                            @else
                            <div class="flex justify-center flex-col">
                                <x-label for='patient-name' :value="__('Patient Name')" />
                                <x-input name='patient-name' type="text" id="patient-name" class="form-input" readonly/>
                            </div>
                            @endif
                            <div class="flex justify-center">
                                <x-button class="mx-4">Ok</x-button>
                                <x-button type='reset' class="mx-4">Cancel</x-button>
                                <x-button class="mx-4">Update</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
