@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm']) }} style="color: var(--color1);">
    {{ $value ?? $slot }}
</label>
