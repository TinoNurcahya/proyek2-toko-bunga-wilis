<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-secondary fw-semibold text-uppercase']) }}>
    {{ $slot }}
</button>
