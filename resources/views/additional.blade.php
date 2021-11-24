<x-app-layout>
    <body>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <div class='flex flex-row justify-center'>
                        <form method="POST" class='m-10'>
                            <div id='addPatientInfo' class='flex flex-row'>
                                <div id='fillablePatientInfo' class='flex flex-col'>
                                    <label for='patientID'>Patient ID</label>
                                    <input type='number' placeholder='005' name='patientID' class=''>
                                    <label for='patientGroup' class='mt-5'>Group</label>
                                    <input type='number' placeholder='3' min="0" name='patientGroup'>
                                    <label for='admissionDate' class='mt-5'>Admission Date</label>
                                    <input type='date' placeholder='3' min="0" name='admissionDate' class=''>
                                </div>
                                <div id='readOnlyInfo' class='flex flex-col ml-10'>
                                    <label for='patientName'>Patient Name</label>
                                    <input type='text' placeholder='John Smith' name='patientName' class=''>
                                </div>
                            </div>
                            <div class='mt-5'>
                                <x-button type="submit">Ok</x-button>
                                <x-button type="reset">Cancel</x-button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
        
        
    </body>
</x-app-layout>
