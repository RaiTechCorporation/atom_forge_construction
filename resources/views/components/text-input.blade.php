@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-slate-50 border-slate-200 focus:border-blue-600 focus:ring-blue-600/20 rounded-lg shadow-sm transition-all text-sm font-medium text-slate-900 placeholder-slate-400']) }}>
