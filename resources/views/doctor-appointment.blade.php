<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Appointment') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name="slot">
            <div class='flex justify-center'>
            @if (isset($patient_id))
            <form method='post' action="{{ route('create-doctor-appointment') }}">
                @csrf

                <div class="flex justify-center flex-col">
                    <x-label for='patient-id' :value="__('Patient ID')" />
                    <x-input readonly value='{{ $patient_id }}' name='patient_id' type="text" id="patient-id" class="form-input" />
                </div>
                <div class="flex justify-center flex-col">
                    <x-label for='appointment_date' :value="__('Appointment Date')" />
                    <x-input name='appointment_date' type="date" id="appointment_date" class="form-input"/>
                </div>
                <div class="flex justify-center flex-col">
                    <x-label for='doctors' :value="__('Available Doctors')" />
                    <select name='doctors' id="doctors" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1">
                        @if(isset($doctors))
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @if (isset($patient_name))
                    <div class="flex justify-center flex-col">
                        <x-label for='patient-name' :value="__('Patient Name')" />
                        <x-input name='patient-name' value='{{ $patient_name["name"] }}' type="text" id="patient-name" class="form-input" readonly/>
                    </div>
                    @else
                    <div class="flex justify-center flex-col">
                        <x-label hidden for='patient-name' :value="__('Patient Name')" />
                        <x-input hidden name='patient-name' type="text" id="patient-name" class="form-input" readonly/>
                    </div>
                    @endif
                </div>
                <div class="flex justify-center">
                    <x-button type='submit' class="mx-4">Ok</x-button>
                    <x-button type='reset' class="mx-4">Cancel</x-button>
                </div>
            </form>
            @else
            <form method='post' action="{{ route('fill-appointment-form') }}">
                @csrf

                <div class="flex justify-center flex-col">
                    <x-label for='patient-id' :value="__('Patient ID')" />
                    <x-input name='patient_id' type="text" id="patient-id" class="form-input" />
                </div>
                <div class="flex justify-center mt-5">
                    <x-button type='submit' class="mx-4">Ok</x-button>
                    <x-button type='reset' class="mx-4">Cancel</x-button>
                </div>
            </form>
            @endif
        </div>
        </x-slot>
    </x-spencer>
</x-app-layout>
