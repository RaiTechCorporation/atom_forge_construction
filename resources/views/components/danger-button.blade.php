<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-red-600 border border-transparent rounded-xl font-bold text-sm text-white transition-all hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-600/10 shadow-lg shadow-red-500/20']) }}>
    {{ $slot }}
</button>
