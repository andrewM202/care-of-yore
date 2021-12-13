<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Processing') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name="slot">
            <div class="flex justify-center flex-col">
                <div class='flex flex-col'>
                    <form method='post' action='{{ route('update-meds') }}'>
                        @csrf
                        <h1 class="mb-1.5 text-center text-2xl">Search For Patient</h1>
                        <div class="flex justify-center flex-col">
                            <x-label for='patient-id' :value="__('Patient ID')" />
                            <x-input type="text" id="patient-id" class="form-input" />
                        </div>
                        <div class="flex justify-center my-4">
                            <x-button type="submit">Search</x-button>
                        </div>
                    </form>
                    <form method='post' action='{{ route('update-meds') }}'>
                        @csrf
                        <h1 class="mb-1.5 text-center text-2xl">Add Payment</h1>
                        <div class="flex justify-center flex-col">
                            <x-label for='total-due' :value="__('Total Due')" />
                            <x-input type="text" id="total-due" class="form-input" />
                        </div>
                        <div  class="flex justify-center flex-col my-4">
                            <x-label for='new-payment' :value="__('Patient ID')" />
                            <x-input type="text" id="new-payment" class="form-input" />
                        </div>
                        <div class="flex justify-center">
                            <x-button class="mx-4" type="submit">Add Payment</x-button>
                            <x-button type='reset' class="mx-4">Cancel</x-button>
                        </div>
                    </form>
                </div>
                <table class="w-full my-8">
                    <thead>
                        <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                            <th class="px-4 py-3">Patient ID</th>
                            <th class="px-4 py-3">Patient Name</th>
                            <th class="px-4 py-3">Total Due</th>
                            <th class="px-4 py-3">Total Paid</th>
                            <th class="px-4 py-3">Amount Left</th>
                            <th class="px-4 py-3">Update</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                            <tr class="text-gray-700">
                                <form method='post' action='{{ route('update-meds') }}'>
                                    @csrf
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <input type="hidden" name="patient_id" value="}">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm border">
                                        <input type="hidden" name="appointment_id" value="">
                                    </td>
                                    <td class="px-4 py-3 text-sm border">
                                        <input type="text" name='comment' value="" placeholder="No Comment">
                                    </td>
                                    <td class="px-4 py-3 text-sm border">
                                        <input type="text" name='morning_med' value="}">
                                    </td>
                                    <td class="px-4 py-3 text-sm border">
                                        test
                                    </td>
                                    <td class="px-4 py-3 text-sm border">
                                        <x-button type='submit'>Update</x-button>
                                    </td>
                                </form>
                            </tr>
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-spencer>
</x-app-layout>
