@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'sessionStatusMessage']) }}>
        <h3 class="sessionStatusTitle">
            {{ $status }}
        </h3>
    </div>
@endif
