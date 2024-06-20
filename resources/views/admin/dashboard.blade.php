<x-admin-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="grid grid-cols-4 gap-4">
            <a href="{{ route('patients.index') }}">
                <div class="hover:bg-primary/10 transition-colors bg-white p-6 shadow-sm rounded-lg col-span-1 flex flex-col gap-2">
                <div class="bg-primary text-white rounded-full w-14 h-14 flex items-center justify-center ">
                    <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.0//EN'  'http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd'><svg fill="currentColor" height="30px" width="30px" enable-background="new 0 0 24 24" id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M9,9c0-1.7,1.3-3,3-3s3,1.3,3,3c0,1.7-1.3,3-3,3S9,10.7,9,9z M12,14c-4.6,0-6,3.3-6,3.3V19h12v-1.7C18,17.3,16.6,14,12,14z   "/></g><g><g><circle cx="18.5" cy="8.5" r="2.5"/></g><g><path d="M18.5,13c-1.2,0-2.1,0.3-2.8,0.8c2.3,1.1,3.2,3,3.2,3.2l0,0.1H23v-1.3C23,15.7,21.9,13,18.5,13z"/></g></g><g><g><circle cx="18.5" cy="8.5" r="2.5"/></g><g><path d="M18.5,13c-1.2,0-2.1,0.3-2.8,0.8c2.3,1.1,3.2,3,3.2,3.2l0,0.1H23v-1.3C23,15.7,21.9,13,18.5,13z"/></g></g><g><g><circle cx="5.5" cy="8.5" r="2.5"/></g><g><path d="M5.5,13c1.2,0,2.1,0.3,2.8,0.8c-2.3,1.1-3.2,3-3.2,3.2l0,0.1H1v-1.3C1,15.7,2.1,13,5.5,13z"/></g></g></svg>
                </div>
                <p class="text-text-desc font-semibold">Total Patients</p>
                <p class="text-4xl font-bold">{{ $totalPatients }}</p>
            </div>
            </a>

            <a href="{{ route('admin.appointments.view') }}">
                <div class="hover:bg-purple-100 transition-colors bg-white p-6 shadow-sm rounded-lg col-span-1 flex flex-col gap-2">
                <div class="bg-purple-800 text-white rounded-full w-14 h-14 flex items-center justify-center ">
                   <?xml version="1.0" ?><svg id="Icons" fill="currentColor" height="27px" width="27px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path class="cls-1" d="M20,2H19V1a1,1,0,0,0-2,0V2H7V1A1,1,0,0,0,5,1V2H4A4,4,0,0,0,0,6V20a4,4,0,0,0,4,4H20a4,4,0,0,0,4-4V6A4,4,0,0,0,20,2Zm2,18a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H5V5A1,1,0,0,0,7,5V4H17V5a1,1,0,0,0,2,0V4h1a2,2,0,0,1,2,2Z"/><path class="cls-1" d="M19,7H5A1,1,0,0,0,5,9H19a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M7,12H5a1,1,0,0,0,0,2H7a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M7,17H5a1,1,0,0,0,0,2H7a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M13,12H11a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M13,17H11a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M19,12H17a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z"/><path class="cls-1" d="M19,17H17a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z"/></svg>
                </div>
                <p class="text-text-desc font-semibold">Total Appointments</p>
                <p class="text-4xl font-bold">{{ $totalAppointments }}</p>
            </div>
            </a>


        </div>
    </div>
</x-admin>
