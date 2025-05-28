<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Complete Payment</h2>

    @if ($iframeUrl)
    <iframe src="{{ $iframeUrl }}" width="100%" height="600" frameborder="0"></iframe>
    @else
    <p class="text-red-500">Unable to load payment iframe.</p>
    @endif
</x-filament::page>