@include('layouts.header')

        <div class="bg-white min-h-screen sm:flex flex-col justify-center items-center md:pt-6 sm:pt-0 sm:bg-gray-100 mt-8 sm:mt-0">
            <div class="flex items-center justify-center -ml-6">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/LOGO_ICON.png') }}" alt="Logo" class="w-24 sm:w-28">
                    <span class="-ml-1 font-logo text-4xl sm:text-[42px]">DocClinix</span>
                </a>
            </div>

            <div class="w-full flex items-center justify-center">
                {{ $slot }}
            </div>
        </div>
@include('layouts.footer')
