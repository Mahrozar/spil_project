@props(['title' => '', 'value' => null, 'icon' => ''])

<div class="stat-card large">
    <div class="stat-left">
        <div class="stat-label">{{ $title }}</div>
        <div class="stat-value">{{ $value }}</div>
    </div>
    <div class="stat-icon">
        @if($icon)
            {!! $icon !!}
        @else
            <x-icon name="users" class="w-6 h-6" />
        @endif
    </div>
</div>
