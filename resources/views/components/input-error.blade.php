@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-2']) }}>
        @foreach ((array) $messages as $message)
            <div class="alert alert-danger py-1 mb-2" role="alert">
                {{ $message }}
            </div>
        @endforeach
    </div>
@endif
