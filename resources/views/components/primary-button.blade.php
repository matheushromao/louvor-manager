<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-semibold transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[var(--site-primary)]/40 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
