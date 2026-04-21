<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-cyan-500 border-2 border-cyan-400 rounded-lg font-black text-xs uppercase tracking-widest text-slate-950 transition-all hover:bg-cyan-400 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-slate-900 shadow-[0_0_20px_rgba(6,182,212,0.4)] active:scale-95']) }}>
    {{ $slot }}
</button>
