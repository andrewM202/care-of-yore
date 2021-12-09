<x-app-layout>

    <body>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class='flex flex-row justify-center'>
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Additional Information of Patient') }}
                                </h2>
                            </x-slot>
                            <form method="post" action="{{ route('get-patient-name') }}" class='m-10'>
                                @csrf
                                @if (isset($patient[0]))
                                    <div class='flex flex-col mt-5'>
                                        <label for='patientID'>Patient ID</label>
                                        <input type='number' placeholder='005' min='0' name='patientID' class=''
                                            value='{{ $patient[0]->id }}'>
                                    </div>
                                    <div id='readOnlyInfo' class='flex flex-col mt-5'>
                                        <label for='patientName'>Patient Name</label>
                                        <input type='text' name='patientName'
                                            value='{{ $patient[0]->first_name . ' ' . $patient[0]->last_name }}'
                                            disabled>
                                    </div>
                                @else
                                    <div class='flex flex-col mt-5'>
                                        <label for='patientID'>Patient ID</label>
                                        <input type='number' placeholder='005' min='0' name='patientID'>
                                    </div>
                                    <div id='readOnlyInfo' class='flex flex-col mt-5'>
                                        <label for='patientName'>Patient Name</label>
                                        <input type='text' name='patientName' disabled>
                                    </div>
                                @endif
                                <x-button type='submit' class='mt-5'>
                                    {{ __('Search') }}</x-button>
                            </form>
                            <form method="POST" class='m-10' action='{{ route('update-patient-info') }}'>
                                @csrf
                                @if (isset($patient[0]))
                                    <input type='hidden' name='patientID' value='{{ $patient[0]->id }}'>
                                @endif
                                <div id='addPatientInfo' class='flex flex-row'>
                                    @if (isset($patient[0]))
                                        <div id='fillablePatientInfo' class='flex flex-col'>
                                            <label for='patientGroup' class='mt-5'>Group</label>
                                            <input type='number' placeholder='3' min="0" name='patientGroup' value='{{ $patient[0]->group }}'>
                                            <label for='admissionDate' class='mt-5'>Admission Date</label>
                                            <input type='date' placeholder='3' min="0" name='admissionDate' value='{{ $patient[0]->admission_date }}'>
                                        </div>
                                    @else
                                        <div id='fillablePatientInfo' class='flex flex-col'>
                                            <label for='patientGroup' class='mt-5'>Group</label>
                                            <input type='number' placeholder='3' min="0" name='patientGroup'
                                                class='bg-gray-300' disabled>
                                            <label for='admissionDate' class='mt-5'>Admission Date</label>
                                            <input type='date' placeholder='3' min="0" name='admissionDate'
                                                class='bg-gray-300' disabled>
                                        </div>
                                    @endif
                                </div>
                                @if (isset($patient[0]))
                                    <div class='mt-5'>
                                        <x-button type="submit">Ok</x-button>
                                        <x-button type="reset">Cancel</x-button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
