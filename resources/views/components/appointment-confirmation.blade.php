<div id="confirmation-modal" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center pt-28 w-full md:inset-0 h-full max-h-full bg-slate-800/25">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-2xl text-primary w-full text-center font-logo tracking-widest ">
                    Appointment Card
                    <br>
                    <span class="font-sans text-base tracking-wider">Established Patient</span>
                </h3>
                <button id="hide-modal-btn" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="space-y-2">
                    <p class="font-semibold text-lg text-primary">
                    {{ Auth::user()->first_name }}
                        @if (Auth::user()->middle_name)
                            {{ ucfirst(substr(Auth::user()->middle_name, 0, 1)) }}.
                        @endif
                    {{ Auth::user()->last_name }}
                </p>
                <p class="text-primary text-sm uppercase tracking-wider" id="confirmServiceName"></p>
                <p class="text-primary text-sm uppercase tracking-wider" id="confirmDate"></p>
                <p class="text-primary text-sm uppercase tracking-wider" id="confirmTime"></p>
                </div>

                <div class="mt-12 space-y-2">
                    <a class="text-primary flex items-center gap-3" href="https://www.google.com/maps/place/Filarca-Rabena+Dental+Clinic/@17.5723906,120.3823113,17z/data=!3m1!4b1!4m6!3m5!1s0x338e658cfeda5f71:0xeb1cde8a4557b257!8m2!3d17.5723855!4d120.3848862!16s%2Fg%2F11qbgw0vnh?entry=ttu" target="_blank"><?xml version="1.0" ?><svg height="20" viewBox="0 0 48 48" fill="currentColor" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M24 4c-7.73 0-14 6.27-14 14 0 10.5 14 26 14 26s14-15.5 14-26c0-7.73-6.27-14-14-14zm0 19c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/><path d="M0 0h48v48h-48z" fill="none"/></svg> <span>113 Salcedo, Brgy. 3, Vigan City, Ilocos Sur</span></a>

                    <a class="text-primary flex items-center gap-3 ml-1" href="https://www.google.com/maps/place/Filarca-Rabena+Dental+Clinic/@17.5723906,120.3823113,17z/data=!3m1!4b1!4m6!3m5!1s0x338e658cfeda5f71:0xeb1cde8a4557b257!8m2!3d17.5723855!4d120.3848862!16s%2Fg%2F11qbgw0vnh?entry=ttu" target="_blank"><?xml version="1.0" ?><svg height="15" width="15" fill="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/></svg> <span>09123456789</span></a>
                </div>

                <x-primary-button id="confirm-submit-btn" type='submit' class="mt-12">
                    Book Appointment
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
