@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-400 focus:ring-blue-400']) }}>
