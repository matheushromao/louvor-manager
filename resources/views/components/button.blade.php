<button
    {{ $attributes->merge([
        'class' => '
            px-4
            py-2
            rounded
            text-white
            bg-blue-500
            hover:bg-blue-600
            transition
        '
    ]) }}
>

    {{ $slot }}

</button>