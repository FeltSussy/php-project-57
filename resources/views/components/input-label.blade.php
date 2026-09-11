@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-normal text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
