@include('layouts.header')

        <div class="bg-white min-h-screen sm:flex flex-col justify-center items-center pt-6 sm:pt-0 sm:bg-gray-100 mt-8 sm:mt-0">
            <div class="flex items-center justify-center -ml-6">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/LOGO_ICON.png') }}" alt="" class="w-24 sm:w-28">
                    <span class="-ml-1 font-logo text-4xl sm:text-[42px]">DocClinix</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 sm:shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
@include('layouts.footer')