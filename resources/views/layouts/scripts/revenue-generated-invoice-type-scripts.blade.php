<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#weeklyRevenueCsaTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeRevenueGeneratedInvoiceTypeModal', () => {
        $('#revenueGeneratedInvoiceTypeModel').modal('hide');
    });

    window.livewire.on('openRevenueGeneratedInvoiceTypeModal', () => {
        $('#revenueGeneratedInvoiceTypeModel').modal('show');
    });

</script>
