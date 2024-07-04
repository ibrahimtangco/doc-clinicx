<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    {{-- main container --}}
    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between w-full py-2">
                <a class="flex items-center gap-2 bg-primary text-white-text py-1 px-3 rounded-md"
                    href="{{ route('categories.create') }}">
                    <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg">
                        <g id="plus">
                            <line x1="16" x2="16" y1="7" y2="25" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:3px;"/>
                            <line x1="7" x2="25" y1="16" y2="16" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:3px;"/>
                        </g>
                    </svg> {{ __('Add') }}
                </a>
                <x-search id="searchCategory" value="Categories" />
            </div>

            @if ($categories->count() > 0)
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="p-2 w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3" scope="col">Name</th>
                                <th class="px-6 py-3 hidden md:block" scope="col">Description</th>
                                <th class="px-6 py-3" scope="col">Status</th>
                                <th class="px-6 py-3" scope="col"><span>Action</span></th>
                            </tr>
                        </thead>
                        <tbody id="allData">
                            @foreach ($categories as $category)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $category->name }}</td>
                                    <td class="px-6 py-4 hidden md:block">{{ $category->description }}</td>
                                    <td class="px-6 py-4">
                                        @if ($category->formatted_availability == 'Active')
                                            <span class="text-green-500">{{ $category->formatted_availability }}</span>
                                        @else
                                            <span class="text-red-500">{{ $category->formatted_availability }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 flex items-center">
                                        <a class=" block font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
                                            href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                            <svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            <span class="hidden md:block">Edit</span>
                                        </a>
                                        <form class="inline-block" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-btn font-medium text-white bg-red-600 px-2 py-1 rounded hover:bg-red-700 flex items-center justify-center gap-1 w-fit" type="submit">
                                                <svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                <span class="hidden md:block">Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody id="searchData"></tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-xl text-text-desc">No Category Found</div>
            @endif
        </div>
    </div>
<x-delete-modal/>
<script src="{{ asset('js/delete-modal.js') }}"></script>
    <script>

        // search
        $('#searchCategory').on('keyup', function() {
            const searchValue = $(this).val();
            if (searchValue !== '') {
                $('#searchData').show();
                $('#allData').hide();
            } else {
                $('#searchData').hide();
                $('#allData').show();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('admin/category/search') }}',
                data: {
                    'search': searchValue
                },
                success: function(data) {
                    $('#searchData').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
</x-admin-layout>
