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
                    <form method='get' action='{{ route('payment-search') }}'>
                        @csrf
                        <h1 class="mb-1.5 text-center text-2xl">Search For Patient</h1>
                        <div class="flex justify-center flex-col">
                            <x-label for='patient_id' :value="__('Patient ID')" />
                            <x-input type="text" name="patient_id" id="patient_id" class="form-input" />
                        </div>
                        <div class="flex justify-center my-4">
                            <x-button type="submit">Search</x-button>
                        </div>
                    </form>
                    <form method='post' action='{{ route('add-payment') }}'>
                        @csrf
                        <h1 class="mb-1.5 text-center text-2xl">Add Payment</h1>
                        <div class="flex justify-center flex-col">
                            <x-label for='total_due' :value="__('Total Due')" />
                            <x-input type="text" name="total_due" id="total_due" class="form-input" />
                        </div>
                        <div  class="flex justify-center flex-col my-4">
                            <x-label for='patient_id' :value="__('Patient ID')" />
                            <x-input type="text" name="patient_id" id="patient_id" class="form-input" />
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
                        @foreach($payments as $payment)
                        <tr class="text-gray-700">
                            <form method='post' action='{{ route('modify-payment') }}'>
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $payment->payment_id }}">
                                <td class="px-4 py-3 border">
                                    {{ $payment->patient_id }}
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    {{ $payment->patient_name }}
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    <input type="text" name='total_due' value="{{ $payment->total_due }}" placeholder="None Due">
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    <input type="text" name='total_paid' value="{{ $payment->total_paid }}" placeholder="None Paid">
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    {{ $payment->amount_left }}
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    <x-button type='submit'>Update</x-button>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-spencer>
</x-app-layout>
