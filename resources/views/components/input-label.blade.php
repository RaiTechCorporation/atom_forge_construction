@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-xs uppercase tracking-[0.2em] text-slate-700 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
