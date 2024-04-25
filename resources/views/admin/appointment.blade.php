
<x-admin>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appoinments') }}
        </h2>
    </x-slot>

    <table class="w-full text-sm text-left rtl:text-right text-secondary-text">
				<thead class="text-xs text-primary-text uppercase bg-gray-50 border-b font-semibold">
					<tr>
						<th class="px-6 py-3" scope="col">
							Patient Name
						</th>
						<th class="px-6 py-3 hidden sm:table-cell" scope="col">
							Provider
						</th>
						<th class="px-6 py-3" scope="col">
							Procedure
						</th>
						<th class="px-6 py-3" scope="col">
							Date
						</th>
						<th class="px-6 py-3" scope="col">
							Time
						</th>
						<th class="px-6 py-3" scope="col">
							Status
						</th>
						<th class="px-6 py-3" scope="col">
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						<th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							Elice Chua
						</th>
						<td class="px-6 py-4 hidden sm:table-cell">
							Dr. James Walter
						</td>
						<td class="px-6 py-4">
							Dental Checkup
						</td>
						<td class="px-6 py-4">
							03/10/2024
						</td>
						<td class="px-6 py-4">
							12:00PM
						</td>
						<td class="px-6 py-4" x-data="{ status: 'Accepted' }">
							<span
								x-bind:class="{
								    'text-yellow-500': status === 'Pending',
								    'text-green-600': status === 'Accepted',
								    'text-red-600': status === 'Rejected'
								}"
								x-text="status"></span>
						</td>

						<td class="px-6 py-4 flex flex-col gap-1 xl:block xl:space-x-1">
							<a class="font-medium text-center text-white text-[12px] hover:bg-blue-700 bg-blue-600 px-3 py-1 rounded"
								href="#">Done </a>
							<a class="font-medium text-center text-white text-[12px] hover:bg-red-700 bg-red-600 px-3 py-1 rounded"
								href="#">Reject</a>
						</td>
					</tr>
					<tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						<th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							Elice Chua
						</th>
						<td class="px-6 py-4 hidden sm:table-cell">
							Dr. James Walter
						</td>
						<td class="px-6 py-4">
							Dental Checkup
						</td>
						<td class="px-6 py-4">
							03/10/2024
						</td>
						<td class="px-6 py-4">
							12:00PM
						</td>
						<td class="px-6 py-4" x-data="{ status: 'Accepted' }">
							<span
								x-bind:class="{
								    'text-yellow-500': status === 'Pending',
								    'text-green-600': status === 'Accepted',
								    'text-red-600': status === 'Rejected'
								}"
								x-text="status"></span>
						</td>

						<td class="px-6 py-4 flex flex-col gap-1 xl:block xl:space-x-1">
							<a class="font-medium text-center text-white text-[12px] hover:bg-blue-700 bg-blue-600 px-3 py-1 rounded"
								href="#">Done </a>
							<a class="font-medium text-center text-white text-[12px] hover:bg-red-700 bg-red-600 px-3 py-1 rounded"
								href="#">Reject</a>
						</td>
					</tr>
				</tbody>
			</table>
    <script src="{{ asset('js/filter.js') }}"></script>
</x-admin>
