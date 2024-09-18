@props(['active'])

@php
$classes = ($active ?? false)
            ? 'menu-options active' // Ovde dodajte klasu za aktivne linkove ako želite
            : 'menu-options'; // Samo klasa za neaktivne linkove
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

