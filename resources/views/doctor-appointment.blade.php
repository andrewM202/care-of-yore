<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctor Appointment') }}
        </h2>
    </x-slot>

    <x-spencer>
        <x-slot name="slot">
        <div class="flex justify-center">
            @if (isset($patient_id))
            <form
                method="post"
                action="{{ route('create-doctor-appointment') }}"
            >
                @csrf

                <div class="flex justify-center flex-col my-4">
                    <x-label
                        for="patient-id"
                        :value="__('Patient ID')"
                    />
                    <x-input
                        readonly
                        value="{{ $patient_id }}"
                        name="patient_id"
                        type="text"
                        id="patient-id"
                        class="form-input"
                    />
                </div>
                <div class="flex justify-center flex-col my-4">
                    <x-label
                        for="appointment_date"
                        :value="__('Appointment Date')"
                    />
                    <x-input
                        name="appointment_date"
                        type="date"
                        id="appointment_date"
                        class="form-input"
                    />
                </div>
                <div class="flex justify-center flex-col my-4">
                    <x-label
                        for="doctors"
                        :value="__('Available Doctors')"
                    />
                    <select
                        name="doctors"
                        id="doctors"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full mt-1"
                    >
                        @if(isset($doctors)) @foreach($doctors as
                        $doctor)
                        <option value="{{ $doctor->id }}">
                            {{ $doctor->name }}
                        </option>
                        @endforeach @endif
                    </select>
                    @if (isset($patient_name))
                    <div class="flex justify-center flex-col my-4">
                        <x-label
                            for="patient-name"
                            :value="__('Patient Name')"
                        />
                        <x-input
                            name="patient-name"
                            value='{{ $patient_name["name"] }}'
                            type="text"
                            id="patient-name"
                            class="form-input"
                            readonly
                        />
                    </div>
                    @else
                    <div class="flex justify-center flex-col my-4">
                        <x-label
                            hidden
                            for="patient-name"
                            :value="__('Patient Name')"
                        />
                        <x-input
                            hidden
                            name="patient-name"
                            type="text"
                            id="patient-name"
                            class="form-input"
                            readonly
                        />
                    </div>
                    @endif
                </div>
                <div class="flex justify-center">
                    <x-button type="submit" class="mx-4"
                        >Ok</x-button
                    >
                    <a href="/doctor-appointment" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
                </div>
            </form>
            @else
            <form
                method="post"
                action="{{ route('fill-appointment-form') }}"
            >
                @csrf

                <div class="flex justify-center flex-col my-4">
                    <x-label
                        for="patient-id"
                        :value="__('Patient ID')"
                    />
                    <x-input
                        name="patient_id"
                        type="text"
                        id="patient-id"
                        class="form-input"
                        required
                    />
                </div>
                <div class="flex justify-center">
                    <x-button type="submit" class="mx-4"
                        >Ok</x-button
                    >
                    <a href="/doctor-appointment" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
                </div>
            </form>
            @endif
        </div>
        <div class="w-full mt-8">
            <h1 class="mb-1.5 text-center text-2xl">Appointments Already Scheduled</h1>
            <table class="table-auto w-full mt-4">
                <thead>
                    <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                        <th class="px-4 py-3">Patient ID</th>
                        <th class="px-4 py-3">Doctor Name</th>
                        <th class="px-4 py-3">Appointment Date</th>
                        <th class="px-4 py-3">Delete Appointments</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($appointments as $appointment)
                    <tr class="text-gray-700 font-semibold">
                        <td class="px-4 py-3 border">{{ $appointment->patient_id }}</td>
                        <td class="px-4 py-3 border">{{ $appointment->doctor_name }}</td>
                        <td class="px-4 py-3 border">{{ $appointment->appointment_date }}</td>
                        <form method="POST" action="{{ route('delete-appointment') }}">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                            <input type="hidden" name="doctor_name" value="{{ $appointment->doctor_name }}">
                            <input type="hidden" name="appointment_date" value="{{ $appointment->appointment_date }}">
                            <td class="px-4 py-3 border"><x-button type="submit">Delete</x-button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </x-slot>
    </x-spencer>
</x-app-layout>
