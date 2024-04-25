<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <p class="text-text-desc text-sm">Available services:</p>
                <div class="py-4 text-gray-900">
                   <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                     @foreach ($services as $service)
                         <a href="#" >
                            <div class="bg-primary px-4 py-2 rounded-xl text-white flex items-center justify-between">
                                <div class="flex gap-6 items-center">
                                    <div class="bg-white rounded-full w-8 h-8"></div>
                                    <div class=" font-medium">{{ $service->name }}</div>
                                </div>
                                <div class="text-[12px] space-y-4">
                                    <div>Php {{ $service->price }}</div>
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
