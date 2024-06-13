<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Appointment') }}
        </h2>
    </x-slot>
   {{-- breadcrumbs --}}
   <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
    <p class="text-sm font-semibold flex items-center"><a href="{{ route('user.dashboard') }}" class="text-primary">Services</a>
        <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg fill="currentColor" height="18px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="18px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="160,115.4 180.7,96 352,256 180.7,416 160,396.7 310.5,256 "/></svg>
        <span>Slots</span>
    </p>
   </div>
    <div class="py-4">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <p class="text-text-desc text-sm">Available services:</p>
                <div class="py-4 text-gray-900">
                   <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                     @foreach ($services as $service)
                         <a href="{{ url('reserve/'.$service->id) }}" >
                            <div class="bg-primary px-4 py-2 rounded-xl text-white flex items-center justify-between">
                                <div class="flex gap-6 items-center">
                                    <div class="bg-white rounded-full w-8 h-8"></div>
                                    <div class=" font-medium">{{ $service->name }}</div>
                                </div>
                                <div class="text-[12px] space-y-4">
                                    <div>Php {{ $service->formatted_price }}</div>
                                    <div class="flex items-center -ml-2">
                                        <?xml version="1.0" ?><svg class="feather feather-clock" fill="none" height="14" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>{{ $service->formatted_duration }}</span></div>
                                </div>
                            </div>
                        </a>

                     @endforeach

                   </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
