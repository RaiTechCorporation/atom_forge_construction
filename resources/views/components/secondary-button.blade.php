<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-2.5 bg-white border border-slate-200 rounded-xl font-bold text-sm text-slate-700 transition-all hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-200 disabled:opacity-50 shadow-sm shadow-slate-200/50']) }}>
    {{ $slot }}
</button>
