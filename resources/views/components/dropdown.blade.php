@props(['align' => 'end', 'contentClasses' => ''])

<div class="dropdown">
    {{-- Tombol atau link yang memicu dropdown --}}
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </button>

    {{-- Isi dropdown --}}
    <ul class="dropdown-menu dropdown-menu-{{ $align }} {{ $contentClasses }}">
        {{ $content }}
    </ul>
</div>
