

@php
$classes = 'block w-full py-2 text-start text-base font-medium text-gray-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
