@props(['value'])

<label {{ $attributes->merge(['class' => ' text-slate-900']) }}>
    {{ $value ?? $slot }}
</label>
