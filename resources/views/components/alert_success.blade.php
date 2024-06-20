@props(['message'])

<div {{ $attributes->merge(['class' => 'text-green-800 bg-green-50 p-4 mb-4 rounded-lg']) }} x-data="{ isVisible: true }"
	x-init="setTimeout(() => { isVisible = false }, 3000)" x-show="isVisible">
	{{ $message }}
</div>
