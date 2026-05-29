<input
    {{ $attributes->merge([
        'class' => '
            w-full
            rounded-xl
            border
            border-slate-300
            bg-white
            px-4
            py-3
            text-sm
            text-slate-900
            transition
            placeholder:text-slate-400
            focus:border-[var(--site-primary)]
            focus:outline-none
            focus:ring-2
            focus:ring-[var(--site-primary)]/20
        '
    ]) }}
>