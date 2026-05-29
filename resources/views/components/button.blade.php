<button
    {{ $attributes->merge([
        'class' => '
            btn-primary
            inline-flex
            items-center
            justify-center
            gap-2
            rounded-full
            px-6
            py-3
            text-sm
            font-semibold
            shadow-soft
        '
    ]) }}
>

    {{ $slot }}

</button>