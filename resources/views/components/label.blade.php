@props(['value' => null])

<label
    {{ $attributes->merge([
        'class' => '
            block
            mb-2
            text-sm
            font-medium
            text-slate-700
        '
    ]) }}
>

    {{ $value ?? $slot }}

</label>