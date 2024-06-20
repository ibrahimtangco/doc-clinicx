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
		<h2 class="font-medium text-white-text/75 mb-4">ACTIONS</h2>
		<ul class="font-medium space-y-1" x-data="{ isOpenProduct: false, isOpenCategory: false }">
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
            <li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('prescriptions.create') ? 'bg-white/10' : '' }}">
				<div class="flex items-center gap-2">
			<?xml version="1.0" ?><svg viewBox="0 0 384 512" width="19" height="19" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M176 240H128v32h48C184.9 272 192 264.9 192 256S184.9 240 176 240zM256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM292.5 315.5l11.38 11.25c6.25 6.25 6.25 16.38 0 22.62l-29.88 30L304 409.4c6.25 6.25 6.25 16.38 0 22.62l-11.25 11.38c-6.25 6.25-16.5 6.25-22.75 0L240 413.3l-30 30c-6.249 6.25-16.48 6.266-22.73 .0156L176 432c-6.25-6.25-6.25-16.38 0-22.62l29.1-30.12L146.8 320H128l.0078 48.01c0 8.875-7.125 16-16 16L96 384c-8.875 0-16-7.125-16-16v-160C80 199.1 87.13 192 96 192h80c35.38 0 64 28.62 64 64c0 24.25-13.62 45-33.5 55.88L240 345.4l29.88-29.88C276.1 309.3 286.3 309.3 292.5 315.5z"/></svg>
					<a href="{{ route('admin.prescriptions.index') }}">Prescription</a>
				</div>
			</li>
			<li @click="isOpenCategory = !isOpenCategory" class="">
				<button
					class="flex w-full items-center justify-between cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
					<div class="flex gap-2 items-center">
						<?xml version="1.0" ?><svg fill="currentColor" height="21" id="icon" viewBox="0 0 32 32" width="21"
							xmlns="http://www.w3.org/2000/svg">
							<defs>
								<style>
									.cls-1 {
										fill: none;
									}
								</style>
							</defs>
							<title />
							<rect height="2" width="14" x="16" y="8" />
							<rect height="2" width="14" x="16" y="22" />
							<path
								d="M10,14H4a2.0023,2.0023,0,0,1-2-2V6A2.0023,2.0023,0,0,1,4,4h6a2.0023,2.0023,0,0,1,2,2v6A2.0023,2.0023,0,0,1,10,14ZM4,6v6h6.0012L10,6Z" />
							<path
								d="M10,28H4a2.0023,2.0023,0,0,1-2-2V20a2.0023,2.0023,0,0,1,2-2h6a2.0023,2.0023,0,0,1,2,2v6A2.0023,2.0023,0,0,1,10,28ZM4,20v6h6.0012L10,20Z" />
							<rect class="cls-1" data-name="&lt;Transparent Rectangle&gt;" height="21" id="_Transparent_Rectangle_"
								width="21" />
						</svg>

						<span>Category</span>
					</div>
					{{-- arrow --}}
					<svg fill="currentColor" height="20px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
						viewBox="0 0 512 512" width="20px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
						xmlns="http://www.w3.org/2000/svg">
						<path
							x-bind:d="isOpenCategory ?
							    'M413.1,327.3l-1.8-2.1l-136-106.5c-4.6-5.3-11.5-8.6-19.2-8.6c-7.7,0-14.6,3.4-19.2,8.6L101,324.9l-2.3,2.6  C97,330,96,333,96,336.2c0,8.7,7.4,10.8,16.6,10.8v0h286.8v0c9.2,0,16.6-7.1,16.6-10.8C416,332.9,414.9,329.8,413.1,327.3z' :
							    'M98.9,184.7l1.8,2.1l136,106.5c4.6,5.3,11.5,8.6,19.2,8.6c7.7,0,14.6-3.4,19.2-8.6L411,187.1l2.3-2.6  c1.7-2.5,2.7-5.5,2.7-8.7c0-8.7-7.4-10.8-16.6-10.8v0H112.6v0c-9.2,0-16.6,7.1-16.6,10.8C96,179.1,97.1,182.2,98.9,184.7z'" />
					</svg>
				</button>
				<div class="pl-6 space-y-1" x-show="isOpenCategory">
					<a class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('categories.index') ? 'bg-white/10' : '' }}"
						href="{{ route('categories.index') }}">
						<?xml version="1.0" ?><svg class="bi bi-eye-fill" fill="currentColor" height="19px" viewBox="0 0 16 16"
							width="19px" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
							<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
						</svg>

						<span>View Category</span>
					</a>
					<a class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('categories.create') ? 'bg-white/10' : '' }}"
						href="{{ route('categories.create') }}">
						<svg fill="currentColor" height="19px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
							viewBox="0 0 512 512" width="19px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
						</svg>
						<span>Add Category</span>
					</a>
				</div>
			</li>

			<li @click="isOpenProduct = !isOpenProduct" class="">
				<button
					class="flex w-full items-center justify-between cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200">
					<div class="flex gap-2 items-center">
						<?xml version="1.0" ?><svg class="feather feather-box" fill="none" height="20" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="20"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
							<polyline points="3.27 6.96 12 12.01 20.73 6.96" />
							<line x1="12" x2="12" y1="22.08" y2="12" />
						</svg>

						<span>Product</span>
					</div>
					{{-- arrow --}}
					<svg fill="currentColor" height="20px" id="Layer_1" style="enable-background:new 0 0 512 512;"
						version="1.1" viewBox="0 0 512 512" width="20px" xml:space="preserve"
						xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
						<path
							x-bind:d="isOpenProduct ?
							    'M413.1,327.3l-1.8-2.1l-136-106.5c-4.6-5.3-11.5-8.6-19.2-8.6c-7.7,0-14.6,3.4-19.2,8.6L101,324.9l-2.3,2.6  C97,330,96,333,96,336.2c0,8.7,7.4,10.8,16.6,10.8v0h286.8v0c9.2,0,16.6-7.1,16.6-10.8C416,332.9,414.9,329.8,413.1,327.3z' :
							    'M98.9,184.7l1.8,2.1l136,106.5c4.6,5.3,11.5,8.6,19.2,8.6c7.7,0,14.6-3.4,19.2-8.6L411,187.1l2.3-2.6  c1.7-2.5,2.7-5.5,2.7-8.7c0-8.7-7.4-10.8-16.6-10.8v0H112.6v0c-9.2,0-16.6,7.1-16.6,10.8C96,179.1,97.1,182.2,98.9,184.7z'" />
					</svg>
				</button>
				<div class="pl-6 space-y-1" x-show="isOpenProduct">
					<a class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('products.index') ? 'bg-white/10' : '' }}"
						href="{{ route('products.index') }}">
						<?xml version="1.0" ?><svg class="bi bi-eye-fill" fill="currentColor" height="19px" viewBox="0 0 16 16"
							width="19px" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
							<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
						</svg>

						<span>View Products</span>
					</a>
					<a class="flex w-full items-center gap-2 cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('products.create') ? 'bg-white/10' : '' }}"
						href="{{ route('products.create') }}">
						<svg fill="currentColor" height="19px" id="Layer_1" style="enable-background:new 0 0 512 512;"
							version="1.1" viewBox="0 0 512 512" width="19px" xml:space="preserve"
							xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
						</svg>
						<span>Add Product</span>
					</a>
				</div>
			</li>

		</ul>
	</div>

	{{-- <div class="flex flex-col gap-2 px-6 mb-2">
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
	</div> --}}
	{{-- MENU END --}}

	{{-- ACTIONS START --}}
	<x-action_group />
	{{-- ACTIONS END --}}

	{{-- OTHERS START --}}
	<div class="flex flex-col gap-2 px-6 mb-2">
		<h2 class="text-white-text/75 font-medium mb-2">OTHERS</h2>
		<ul class="font-medium space-y-1">
			<li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.patients') ? 'bg-white/10' : '' }}">
				<a class="flex items-center gap-2" href="#">
					<?xml version="1.0" ?><svg fill="currentColor" viewBox="0 0 640 512" width="20"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-110.2-110.2-110.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 10.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z" />
					</svg>

					<span>Users</span>
				</a>
			</li>

			<li
				class="cursor-pointer hover:bg-white/10 p-2 rounded-sm ease-in-out duration-200 {{ request()->routeIs('admin.feedback') ? 'bg-white/10' : '' }}">
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
