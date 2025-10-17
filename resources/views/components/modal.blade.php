@props(['name', 'show' => false, 'maxWidth' => 'lg'])

@php
$maxWidthClass = match($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    default => '',
};
@endphp

<div class="modal fade {{ $show ? 'show' : '' }}" id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="{{ $show ? 'false' : 'true' }}" @if($show) style="display: block;" @endif>
    <div class="modal-dialog {{ $maxWidthClass }}">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
