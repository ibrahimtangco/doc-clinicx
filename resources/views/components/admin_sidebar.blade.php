<aside :class="isAsideOpen ? 'translate-x-0' : '-translate-x-full'" @click.outside="isAsideOpen = false"
	class="fixed left-0 z-30 top-0 h-screen hide-scrollbar overflow-y-scroll w-64 bg-[#1C2434] text-white-text flex flex-col gap-6 duration-300 ease-linear lg:static lg:translate-x-0">
	{{-- LOGO START --}}
	<div class="flex items-center justify-between pr-6 py-4 mb-4">
		<a class="flex items-center" href="{{ url('admin/') }}">
			<img alt="" class="w-20" src="{{ asset('images/LOGO_ICON.png') }}">
			<div class="font-logo text-4xl -ml-2">DocClinicx</div>
		</a>
		<div
			class="h-10 w-10 cursor-pointer block rounded-full p-2 lg:hidden hover:bg-gray-200 hover:text-primary-text ease-linear duration-100">
			<svg @click.stop="isAsideOpen = !isAsideOpen" fill="currentColor" id="Layer_1"
				style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve"
				xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
				<g>
					<polygon points="48.1,29.1 13.2,64 48.1,98.9 53.8,93.2 28.5,68 92,68 92,60 28.5,60 53.8,34.8  " />
					<rect height="8" width="8" x="104" y="60" />
				</g>
			</svg>
		</div>

	</div>
	{{-- LOGO END --}}

	{{-- MENU START --}}

	<div class="flex flex-col gap-2 px-6 mb-2">
		<h2 class="text-white-text/75 font-medium mb-2">MENU</h2>
		<ul class="font-medium space-y-1">
			<li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">
				<div class="flex items-center gap-2">
					<?xml version="1.0" ?><svg baseProfile="tiny" fill="currentColor" height="21px" id="Layer_1" version="1.2"
						viewBox="0 0 24 24" width="21px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12,3c0,0-6.186,5.34-9.643,8.232C2.104,11.416,2,11.684,2,12c0,0.553,0.447,1,1,1h2v7c0,0.553,0.447,1,1,1h3  c0.553,0,1-0.448,1-1v-4h4v4c0,0.552,0.447,1,1,1h3c0.553,0,1-0.447,1-1v-7h2c0.553,0,1-0.447,1-1c0-0.316-0.104-0.584-0.383-0.768  C18.184,8.34,12,3,12,3z" />
					</svg>
					<a href="{{ route('admin.dashboard') }}">Dashboard</a>
				</div>
			</li>

			<li class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.inventory') ? 'bg-white/10' : '' }}">
				<a class="flex gap-2 items-center" href="{{ route('admin.inventory') }}">
					<?xml version="1.0" ?><svg fill="currentColor" height="19px" viewBox="0 0 24 24" width="19px"
						xmlns="http://www.w3.org/2000/svg">
						<title />
						<g id="archieve">
							<path
								d="M22,2H2A1,1,0,0,0,1,3V21a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1V3A1,1,0,0,0,22,2ZM3,14V10H9a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1h6v4ZM3,4H9a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1h6V8H3ZM21,20H3V16H9a1,1,0,0,0,1,1h4a1,1,0,0,0,1-1h6Z" />
						</g>
					</svg>
					<span>Inventory</span>
				</a>

			</li>
		</ul>
	</div>
	{{-- MENU END --}}

	{{-- ACTIONS START --}}
	<x-action_group />
	{{-- ACTIONS END --}}

	{{-- OTHERS START --}}
	<div class="flex flex-col gap-2 px-6 mb-2">
		<h2 class="text-white-text/75 font-medium mb-2">OTHERS</h2>
		<ul class="font-medium space-y-1">
			<li class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.patients') ? 'bg-white/10' : '' }}">
				<a class="flex items-center gap-2" href="#">
					<?xml version="1.0" ?><svg fill="currentColor" viewBox="0 0 640 512" width="20"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-110.2-110.2-110.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 10.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z" />
					</svg>

					<span>Users</span>
				</a>
			</li>

			<li class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.feedback') ? 'bg-white/10' : '' }}">
				<a class="flex items-center gap-2" href="{{ url('admin/feedback') }}">
					<?xml version="1.0" ?><svg fill="currentColor" height="20" viewBox="0 0 48 48" width="19"
						xmlns="http://www.w3.org/2000/svg">
						<path d="M0 0h48v48H0z" fill="none" />
						<path
							d="M40 4H8C5.79 4 4.02 5.79 4.02 8L4 44l8-8h28c2.21 0 4-1.79 4-4V8c0-2.21-1.79-4-4-4zM26 28h-4v-4h4v4zm0-8h-4v-8h4v8z" />
					</svg>

					<span>Feedback</span>
				</a>
			</li>

		</ul>
	</div>
	{{-- OTHERS END --}}

</aside>
