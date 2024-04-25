@include('layouts.header')

<!-- ===== Page Wrapper Start ===== -->
<div class="flex h-screen overflow-y-hidden bg-gray-100" >
	<!-- ===== Sidebar Start ===== -->
    <x-admin_sidebar/>
	<!-- ===== Sidebar End ===== -->
	<div class="flex-1 overflow-y-auto overflow-x-hidden w-full">
		<!-- ===== Header Start ===== -->
		<x-admin_nav/>
        <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

        <div>
            {{ $slot }}
        </div>
	</div>
</div>
@include('layouts.footer')
