<button {{ $attributes->merge(['type' => 'submit', 'class' => 'buttons']) }} >
    {{ $slot }}
</button>
