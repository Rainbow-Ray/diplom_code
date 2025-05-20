<button
    {{ $attributes->merge(['type' => 'submit', 'class' => ' items-center px-4']) }}>
    {{ $slot }}
</button>
