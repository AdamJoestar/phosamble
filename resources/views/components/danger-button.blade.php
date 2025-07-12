<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-warm-accent border border-transparent rounded-md font-semibold text-xs text-warm-light uppercase tracking-widest hover:bg-warm-muted active:bg-warm-dark focus:outline-none focus:ring-2 focus:ring-warm-accent focus:ring-offset-2 dark:focus:ring-offset-warm-dark transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
