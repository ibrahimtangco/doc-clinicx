<x-master-layout>

	<!-- ===== Page Wrapper Start ===== -->
	<div class="flex h-screen overflow-y-hidden bg-gray-100">
		<!-- ===== Sidebar Start ===== -->
		<x-admin_sidebar />
		<!-- ===== Sidebar End ===== -->
		<div class="flex-1 overflow-y-auto overflow-x-hidden w-full">
			<!-- ===== Header Start ===== -->
			<x-admin_nav />
			<!-- Page Heading -->
			@if (isset($header))
				<header class="bg-white shadow">
					<div class="flex items-center justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
						{{ $header }}
						@if (request()->routeIs('patients.index') ||
								request()->routeIs('providers.index') ||
								request()->routeIs('services.index'))
						@endif
					</div>
				</header>
			@endif

			<div>
				{{ $slot }}
			</div>
		</div>
	</div>
</x-master-layout>
