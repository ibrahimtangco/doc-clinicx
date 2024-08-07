<x-admin-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                   <?xml version="1.0" ?><svg height="26" fill="currentColor" viewBox="0 0 24 24" width="26" xmlns="http://www.w3.org/2000/svg"><path d="M11,14 L11,11 L13,11 L13,14 L16,14 L16,16 L13,16 L13,19 L11,19 L11,16 L8,16 L8,14 L11,14 Z M20,8 L20,5 L18,5 L18,6 L16,6 L16,5 L8,5 L8,6 L6,6 L6,5 L4,5 L4,8 L20,8 Z M20,10 L4,10 L4,20 L20,20 L20,10 Z M18,3 L20,3 C21.1045695,3 22,3.8954305 22,5 L22,20 C22,21.1045695 21.1045695,22 20,22 L4,22 C2.8954305,22 2,21.1045695 2,20 L2,5 C2,3.8954305 2.8954305,3 4,3 L6,3 L6,2 L8,2 L8,3 L16,3 L16,2 L18,2 L18,3 Z" fill-rule="evenodd"/></svg>
                </div>
                <p class="text-text-desc font-semibold">Total Appointments</p>
                <p class="text-4xl font-bold">{{ $totalAppointments }}</p>
            </div>
            </a>


        </div>
    </div>
</x-admin>
