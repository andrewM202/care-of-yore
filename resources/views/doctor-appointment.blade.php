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
                        <div class="flex justify-center flex-col">
                            <x-label for='patient-id' :value="__('Patient ID')" />
                            <x-input type="text" id="patient-id" class="form-input" />
                        </div>
                        <div class="flex justify-center flex-col">
                            <x-label for='total-due' :value="__('Date')" />
                            <x-input type="text" id="total-due" class="form-input" />
                        </div>
                        <div class="flex justify-center flex-col">
                            <x-label for='new-payment' :value="__('Doctor')" />
                            <x-input type="text" id="new-payment" class="form-input" />
                        </div>
                        <div class="flex justify-center flex-col">
                            <x-label for='new-payment' :value="__('Patient Name')" />
                            <x-input type="text" id="new-payment" class="form-input" />
                        </div>
                        <div class="flex justify-center">
                            <x-button class="mx-4">Ok</x-button>
                            <x-button type='reset' class="mx-4">Cancel</x-button>
                            <x-button class="mx-4">Update</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
