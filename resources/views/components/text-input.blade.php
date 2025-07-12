@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-warm-muted dark:border-nostalgic-muted bg-warm-muted dark:bg-nostalgic-muted text-nostalgic-dark dark:text-warm-light focus:border-warm-accent dark:focus:border-warm-accent focus:ring-warm-accent dark:focus:ring-warm-accent rounded-md shadow-sm']) }}>
