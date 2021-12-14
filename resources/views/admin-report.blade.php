<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Report') }}
        </h2>
    </x-slot>

    <x-spencer>
       <x-slot name="slot">
         <form method="get" action="{{ route('admin-report-by-id')}}">
            @csrf
            <div class="flex items-center justify-center h-full w-full my-4">
               <div class="flex justify-center flex-col">
                     <x-label for='patient_id' :value="__('Patient ID')" />
                     <x-input type="text" name="patient_id" id="patient_id" class="form-input" />
               </div>
               <div class="flex justify-center mt-3">
                     <x-button class="mx-4 w-24">Search</x-button>
               </div>
            </div>
         </form>
         <table class="w-full">
            <thead>
                  <tr class="text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600">
                     <th class="px-4 py-3">Patient's Name</th>
                     <th class="px-4 py-3">Patient's ID</th>
                     <th class="px-4 py-3">Doctor's Name</th>
                     <th class="px-4 py-3">Appointment</th>
                     <th class="px-4 py-3">Caregiver's Name</th>
                     <th class="px-4 py-3">Morning Med</th>
                     <th class="px-4 py-3">Afternoon Med</th>
                     <th class="px-4 py-3">Night Med</th>
                     <th class="px-4 py-3">Breakfast</th>
                     <th class="px-4 py-3">Lunch</th>
                     <th class="px-4 py-3">Dinner</th>
                  </tr>
            </thead>
            <tbody class="bg-white">
               @foreach($patients as $patient)
               <tr class="text-gray-700">
                  <td class="px-4 py-3 text-ms border">
                     {{ $patient->patient_name }}
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     {{ $patient->patient_id }}
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     {{ $patient->doctor_name }}
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     {{ $patient->appointment_date }}
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     {{ $patient->caregiver_name }}
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->morning_med == '')
                     None
                     @else
                     {{ $patient->morning_med ?? 'None' }}
                     @endif
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->afternoon_med == '')
                     None
                     @else
                     {{ $patient->afternoon_med ?? 'None' }}
                     @endif
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->evening_med == '')
                     None
                     @else
                     {{ $patient->evening_med ?? 'None' }}
                     @endif
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->breakfast == '')
                     Not Set
                     @else
                     {{ $patient->breakfast ?? 'Not Set' }}
                     @endif
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->lunch == '')
                     Not Set
                     @else
                     {{ $patient->lunch ?? 'Not Set' }}
                     @endif
                  </td>
                  <td class="px-4 py-3 text-ms border">
                     @if($patient->dinner == '')
                     Not Set
                     @else
                     {{ $patient->dinner ?? 'Not Set' }}
                     @endif
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
       </x-slot>
    </x-spencer>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            </div>
        </div>
    </div>
</x-app-layout>
