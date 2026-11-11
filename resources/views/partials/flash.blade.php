@php
    $flash = collect(['success', 'error', 'warning'])
        ->mapWithKeys(fn ($type) => [$type => session($type)])
        ->filter();
    $firstError = $errors->any() ? $errors->first() : null;
@endphp
@if ($flash->isNotEmpty() || $firstError)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($flash as $type => $message)
            SKO.toast(@json($type), @json($message));
        @endforeach
        @if ($firstError && $flash->isEmpty())
            SKO.toast('error', @json($firstError));
        @endif
    });
</script>
@endif
