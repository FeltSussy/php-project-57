<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-blue-700']) }}>
    {{ $slot }}
</button>
