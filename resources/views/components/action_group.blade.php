<div class="flex flex-col gap-2 px-6 mb-2">
		<h2 class="font-medium text-white-text/75 mb-4">ACTIONS</h2>
		<ul class="font-medium space-y-1" x-data="{ isOpenProvider: false, isOpenProcedure: false, isOpenPatient: false }"
>
            <li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.appointments') ? 'bg-white/10' : '' }}">
				<a class="flex gap-2 items-center " href="{{ route('admin.appointments.view') }}">
					<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="19px"width="19px"><path d="M18 4h-1V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H6a3 3 0 0 0-3 3v11a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3ZM8 18a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm0-4a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm4 4a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm0-4a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm4 0a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm3-4H5V7a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h1a1 1 0 0 1 1 1Z" fill="currentColor" class="fill-464646 "></path></svg>

					<span>Appointments</span>
				</a>

			</li>
            <li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.business_hours') ? 'bg-white/10' : '' }}">
				<a class="flex gap-2 items-center " href="{{ route('admin.business_hours') }}">

                    <?xml version="1.0" ?><svg width="17px" height="17px" fill="currentColor" enable-background="new 0 0 12 12" id="Слой_1" version="1.1" viewBox="0 0 12 12" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M6,0C2.6862793,0,0,2.6862793,0,6s2.6862793,6,6,6s6-2.6862793,6-6S9.3137207,0,6,0z M8.5,6.5h-3v-4h1v3h2  V6.5z"/></svg>
					<span>Business Hours</span>
				</a>

			</li>
			<li @click="isOpenProvider = !isOpenProvider"
				class="">
				<button class="flex  w-full items-center justify-between cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.providers') ? 'bg-white/10' : '' }}  ">
                    <div class="flex gap-2 items-center">
					<svg fill="currentColor" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
						<path d=" M11 14.0619V20H13V14.0619C16.9463 14.554 20 17.9204 20 22H4C4 17.9204 7.05369 14.554 11 14.0619ZM12
				13C8.685 13 6 10.310 6 7C6 3.685 8.685 1 12 1C10.310 1 18 3.685 18 7C18 10.310 10.310 13 12 13Z">
                    </path>
                    </svg>
                    <span>Providers</span>
	            </div>
	            {{-- arrow --}}
                <svg fill="currentColor" height="20px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                    viewBox="0 0 512 512" width="20px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        x-bind:d="isOpenProvider ?
                            'M413.1,327.3l-1.8-2.1l-136-106.5c-4.6-5.3-11.5-8.6-19.2-8.6c-7.7,0-14.6,3.4-19.2,8.6L101,324.9l-2.3,2.6  C97,330,96,333,96,336.2c0,8.7,7.4,10.8,16.6,10.8v0h286.8v0c9.2,0,16.6-7.1,16.6-10.8C416,332.9,414.9,329.8,413.1,327.3z' :
                            'M98.9,184.7l1.8,2.1l136,106.5c4.6,5.3,11.5,8.6,19.2,8.6c7.7,0,14.6-3.4,19.2-8.6L411,187.1l2.3-2.6  c1.7-2.5,2.7-5.5,2.7-8.7c0-8.7-7.4-10.8-16.6-10.8v0H112.6v0c-9.2,0-16.6,7.1-16.6,10.8C96,179.1,97.1,182.2,98.9,184.7z'" />
                </svg>
                </button>
                <div x-show="isOpenProvider" class="pl-6 space-y-1">
                    <a href="{{ route('providers.index') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('providers.index') ? 'bg-white/10' : '' }}">
                    <?xml version="1.0" ?><svg class="bi bi-eye-fill" fill="currentColor" height="19px" viewBox="0 0 16 16" width="19px" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>

                        <span>View Providers</span>
                    </a>
                    <a href="{{ route('providers.create') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('providers.create') ? 'bg-white/10' : '' }}">
                    <svg height="19px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" fill="currentColor" viewBox="0 0 512 512" width="19px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" /></svg>
                        <span>Add Provider</span>
                    </a>
                </div>
            </li>

            <li @click="isOpenProcedure = !isOpenProcedure"
				class="">
				<button class="flex w-full items-center justify-between cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.services') ? 'bg-white/10' : '' }}">
                    <div class="flex gap-2 items-center">
					<svg enable-background="new 0 0 64 64" height="19" id="Layer_1" version="1.1" viewBox="0 0 64 64" width="19" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M43,2.235c-2.653,0-5.135,0.71-7.285,1.93c-0.016,0.007-0.029,0.01-0.048,0.02  c-1.99,0.949-3.221-0.321-3.221-0.321S32.44,3.877,32.44,3.878c-2.767-2.402-6.369-3.862-10.323-3.862  c-8.747,0-10.825,7.095-10.825,10.825c0,2.755,0.725,5.334,1.965,7.592h-0.01c0,0,6.954,13.34,7.445,14.7  c0.925,2.579,1.722,4.902,2.001,6.005c0.807,3.125,2.901,17.585,9.32,19.8c0.322,0.054,0.876,0.102,1.11-0.118  c0.426-0.55,0.506-1.618,0.074-3.198v-0.019c0,0-0.857-3.119-0.685-4.923c0.316-4.486,1.865-11.177,2.058-12  c0.386-1.714,3.410-1.03,3.410-1.03l0.003-0.003c1.109,0.564,2.104,0.962,2.712,1.203l0,0c0,0,1.587,0.611,2.199,3.119  c0.047,0.244,0.092,0.499,0.134,0.784c0.029,0.221,0.071,0.422,0.086,0.666c0.019,0.163,0.036,0.339,0.054,0.517  c0.006,0.033,0.006,0.077,0.012,0.107c0.24,2.597,0.262,6.565-0.232,12.642c0,0.003,0,0.003,0,0.006  c-0.118,1.531,0.72,2.021,0.72,2.021c0.312,0.122,0.716,0.244,1.075,0.231c0.698-0.023,1.423-0.166,1.898-0.65  c0.253-0.255,0.521-0.542,0.806-0.893c3.841-4.709,5.442-6.245,6.126-16.578c0.484-7.065,3.135-13.52,5.054-17.675l1.776-3.28  v-0.003c1.455-2.282,2.302-4.993,2.302-7.906C57.708,8.831,51.113,2.235,43,2.235z" fill="currentColor"/></svg>

                    <span>Services</span>
	            </div>
	            {{-- arrow --}}
                <svg fill="currentColor" height="20px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                    viewBox="0 0 512 512" width="20px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        x-bind:d="isOpenProcedure ?
                            'M413.1,327.3l-1.8-2.1l-136-106.5c-4.6-5.3-11.5-8.6-19.2-8.6c-7.7,0-14.6,3.4-19.2,8.6L101,324.9l-2.3,2.6  C97,330,96,333,96,336.2c0,8.7,7.4,10.8,16.6,10.8v0h286.8v0c9.2,0,16.6-7.1,16.6-10.8C416,332.9,414.9,329.8,413.1,327.3z' :
                            'M98.9,184.7l1.8,2.1l136,106.5c4.6,5.3,11.5,8.6,19.2,8.6c7.7,0,14.6-3.4,19.2-8.6L411,187.1l2.3-2.6  c1.7-2.5,2.7-5.5,2.7-8.7c0-8.7-7.4-10.8-16.6-10.8v0H112.6v0c-9.2,0-16.6,7.1-16.6,10.8C96,179.1,97.1,182.2,98.9,184.7z'" />
                </svg>
                </button>
                <div x-show="isOpenProcedure" class="pl-6 space-y-1">
                    <a href="{{ route('services.index') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
                    <?xml version="1.0" ?><svg class="bi bi-eye-fill" fill="currentColor" height="19px" viewBox="0 0 16 16" width="19px" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>

                        <span>View Service</span>
                    </a>
                    <a href="{{ route('services.create') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
                    <svg height="19px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" fill="currentColor" viewBox="0 0 512 512" width="19px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" /></svg>
                        <span>Add Service</span>
                    </a>
                </div>
            </li>

            <li @click="isOpenPatient = !isOpenPatient"
				class="">
				<button class="flex w-full items-center justify-between cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.services') ? 'bg-white/10' : '' }}">
                    <div class="flex gap-2 items-center">
					<?xml version="1.0" ?><svg fill="currentColor" viewBox="0 0 640 512" width="20"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-110.2-110.2-110.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 10.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z" />
					</svg>

                    <span>Patients</span>
	            </div>
	            {{-- arrow --}}
                <svg fill="currentColor" height="20px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                    viewBox="0 0 512 512" width="20px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        x-bind:d="isOpenProcedure ?
                            'M413.1,327.3l-1.8-2.1l-136-106.5c-4.6-5.3-11.5-8.6-19.2-8.6c-7.7,0-14.6,3.4-19.2,8.6L101,324.9l-2.3,2.6  C97,330,96,333,96,336.2c0,8.7,7.4,10.8,16.6,10.8v0h286.8v0c9.2,0,16.6-7.1,16.6-10.8C416,332.9,414.9,329.8,413.1,327.3z' :
                            'M98.9,184.7l1.8,2.1l136,106.5c4.6,5.3,11.5,8.6,19.2,8.6c7.7,0,14.6-3.4,19.2-8.6L411,187.1l2.3-2.6  c1.7-2.5,2.7-5.5,2.7-8.7c0-8.7-7.4-10.8-16.6-10.8v0H112.6v0c-9.2,0-16.6,7.1-16.6,10.8C96,179.1,97.1,182.2,98.9,184.7z'" />
                </svg>
                </button>
                <div x-show="isOpenPatient" class="pl-6 space-y-1">
                    <a href="{{ route('patients.index') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
                    <?xml version="1.0" ?><svg class="bi bi-eye-fill" fill="currentColor" height="19px" viewBox="0 0 16 16" width="19px" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/></svg>

                        <span>View Patient</span>
                    </a>
                    <a href="{{ route('patients.create') }}" class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
                    <svg height="19" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" fill="currentColor" viewBox="0 0 512 512" width="19" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" /></svg>
                        <span>Add Patient</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
