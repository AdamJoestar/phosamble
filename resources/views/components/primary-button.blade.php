<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-warm-accent dark:bg-warm-dark border border-transparent rounded-md font-semibold text-xs text-warm-light dark:text-warm-light uppercase tracking-widest hover:bg-warm-dark dark:hover:bg-warm-accent focus:bg-warm-dark dark:focus:bg-warm-accent active:bg-warm-dark dark:active:bg-warm-accent focus:outline-none focus:ring-2 focus:ring-warm-accent focus:ring-offset-2 dark:focus:ring-offset-warm-dark transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
