<div class="w-full h-[500px]">
    <iframe
        src="{{ $iframeUrl }}"
        class="w-full h-full border-0"
        id="pesapalIframe"
        onload="iframeLoaded()"></iframe>
</div>

<script>
    function iframeLoaded() {
        // Handle iframe load completion
        console.log('PesaPal iframe loaded');
    }

    // Listen for messages from PesaPal iframe
    window.addEventListener('message', function(e) {
        if (e.data === 'pesapal-payment-completed') {
            window.Livewire.emit('paymentCompleted', {
                {
                    $bookingId
                }
            });
        }
    });
</script>