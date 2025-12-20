@props([
    'variant' => null,         // Bootstrap ya Config variant
    'customColor' => null,     // Direct hex/rgb
    'size' => null,            // sm, lg
    'shadow' => false,
    'icon' => null,
    'href' => null,
    'type' => 'button',        // default button (submit, reset bhi ho sakta)
])

@php
    // Theme config colors
    $themeColors = config('theme.colors');

    $bgColor = null;
    $textColor = null;
    $borderColor = null;

    if ($variant && isset($themeColors[$variant])) {
        // Theme config color pick
        $bgColor = $themeColors[$variant]['bg'];
        $textColor = $themeColors[$variant]['text'];
        $borderColor = $themeColors[$variant]['border'];
    } elseif ($customColor) {
        // Direct custom color
        $bgColor = $customColor;
        $textColor = '#ffffff'; // default white text
        $borderColor = $customColor;
    }

    // Classes
    $classes = "btn";
    $classes .= $size ? " btn-{$size}" : "";
    $classes .= $shadow ? " shadow" : "";

    // Inline styles (if custom theme color)
    $style = $bgColor ? "background-color: {$bgColor}; color: {$textColor}; border-color: {$borderColor};" : "";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
        @if($icon)<i class="bi bi-{{ $icon }} me-1"></i>@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
        @if($icon)<i class="bi bi-{{ $icon }} me-1"></i>@endif
        {{ $slot }}
    </button>
@endif
