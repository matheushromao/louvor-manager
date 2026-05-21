<label
    {{ $attributes->merge([
        'class' => '
            block
            mb-2
            font-medium
            text-gray-700
        '
    ]) }}
>

    {{ $slot }}

</label>