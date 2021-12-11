<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Processing') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name="slot">
            <div class="flex justify-center">
                <div class='grid grid-rows-2 gap-4'>
                    <div class="flex justify-center flex-col">
                        <x-label for='patient-id' :value="__('Patient ID')" />
                        <x-input type="text" id="patient-id" class="form-input" />
                    </div>
                    <div class="flex justify-center flex-col">
                        <x-label for='total-due' :value="__('Total Due')" />
                        <x-input type="text" id="total-due" class="form-input" />
                    </div>
                    <div  class="flex justify-center flex-col">
                        <x-label for='new-payment' :value="__('New Payment')" />
                        <x-input type="text" id="new-payment" class="form-input" />
                    </div>
                    <div class="flex justify-center">
                        <x-button class="mx-4">Ok</x-button>
                        <x-button type='reset' class="mx-4">Cancel</x-button>
                        <x-button class="mx-4">Update</x-button>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-spencer>
</x-app-layout>
