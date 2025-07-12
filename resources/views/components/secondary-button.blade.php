<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-warm-light dark:bg-warm-dark border border-warm-muted dark:border-warm-muted rounded-md font-semibold text-xs text-nostalgic-dark dark:text-warm-light uppercase tracking-widest shadow-sm hover:bg-warm-muted dark:hover:bg-warm-muted focus:outline-none focus:ring-2 focus:ring-warm-accent focus:ring-offset-2 dark:focus:ring-offset-warm-dark disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
