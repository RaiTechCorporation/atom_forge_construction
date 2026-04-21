@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-semibold text-sm text-emerald-400 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]']) }}>
        {{ $status }}
    </div>
@endif
