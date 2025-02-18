@props(['type' => 'info', 'message' => session('mensaje')])

@php
    $colors = [
        'success' => 'bg-green-500 text-white',
        'error' => 'bg-red-500 text-white',
        'warning' => 'bg-yellow-500 text-black',
        'info' => 'bg-blue-500 text-white',
    ];
@endphp

@if ($message)
    <div class="p-4 mb-4 rounded-lg {{ $colors[$type] ?? 'bg-blue-500 text-white' }}">
        <strong>{{ ucfirst($type) }}:</strong> {{ $message }}
    </div>
@endif
