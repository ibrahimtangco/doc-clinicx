@props(['id', 'value'])

<div class="max-w-sm">

	<div class="relative ">
		<input
			class="text-md block px-2 py-1 rounded-md w-full
                                    bg-white border-2 border-gray-300 shadow-sm
                                    focus:bg-white
                                    focus:border-indigo-500
                                    focus:ring-indigo-500
                                    focus:outline-none"
			id="{{ $id }}" type="text" placeholder="Search {{ $value }}">

	</div>
</div>
