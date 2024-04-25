@props([
    'message'
])

<div x-data="{ isVisible: true }"
    x-init="setTimeout(() => { isVisible = false }, 3000)"
    x-show="isVisible"
    class="text-green-500 font-medium text-sm">

    {{ $slot }}
</div>

