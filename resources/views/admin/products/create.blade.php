<x-admin-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="{{ route('products.index') }}">{{ __('Products') }}</a>
		</h2>
	</x-slot>

	{{-- main container --}}
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					<section>
						<header>
							<h2 class="text-lg font-medium text-gray-900">
								{{ __('Add Product') }}
							</h2>

							<p class="mt-1 text-sm text-gray-600">
								{{ __('Fill in the required details to add a new product.') }}
							</p>
						</header>

						<form action="{{ route('products.store') }}" class="mt-6 space-y-6" method="post">
							@csrf

							<div class="mt-4">
								<x-input-label :value="__('Name')" for="name" />
								<x-text-input :value="old('name')" autocomplete="name" autofocus class="block mt-1 w-full" id="name"
									name="name" type="text" />
								<x-input-error :messages="$errors->get('name')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Category')" for="category_id" />
								<select class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
									id="category_id" name="category_id">
									<option value="">-Select Category-</option>
									@foreach ($categories as $categoryOption)
										<option {{ old('category_id') == $categoryOption->id ? 'selected' : '' }} value="{{ $categoryOption->id }}">
											{{ $categoryOption->name }}
										</option>
									@endforeach
								</select>
								<x-input-error :messages="$errors->get('category')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Description')" for="description" />
								<textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1"
								 id="description" name="description" rows="3"></textarea>
								<x-input-error :messages="$errors->get('description')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Quantity')" for="quantity" />
								<x-text-input :value="old('quantity')" autocomplete="quantity" autofocus class="block mt-1 w-full" id="quantity"
									name="quantity" type="number" />
								<x-input-error :messages="$errors->get('quantity')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Buying Price')" for="buying-price" />
								<x-text-input :value="old('buying_price')" step="0.01" autocomplete="buying-price" autofocus class="block mt-1 w-full"
									id="buying-price" name="buying_price" placeholder="123.33" type="number" />
								<x-input-error :messages="$errors->get('buying_price')" class="mt-2" />
							</div>

							<div class="mt-4">
								<x-input-label :value="__('Selling Price')" for="selling-price" />
								<x-text-input :value="old('selling_price')" step="0.01" autocomplete="selling-price" autofocus class="block mt-1 w-full"
									id="selling-price" name="selling_price" placeholder="123.33" type="number" />
								<x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
							</div>

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Create') }}</x-primary-button>

							</div>
						</form>
					</section>

				</div>
			</div>
		</div>
	</div>
</x-admin-layout>
