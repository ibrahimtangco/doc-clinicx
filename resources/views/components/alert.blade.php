@props([
    'message',
    'type' => 'success' // Default type is 'success'
])

<div x-data="{ isVisible: true }"
    x-init="setTimeout(() => { isVisible = false }, 3000)"
    x-show="isVisible"
    :class="{
        'text-red-500': '{{ $type }}' === 'error',
        'text-green-500': '{{ $type }}' === 'success'
    }"
    class="font-medium text-sm">

    {{ $slot }}
</div>
