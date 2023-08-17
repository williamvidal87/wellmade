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

    window.livewire.on('closeWeeklyRevenueCsaModal', () => {
        $('#weeklyRevenueCsaModel').modal('hide');
        // $('#weeklyRevenueCsaTable').DataTable();
    });

    window.livewire.on('openWeeklyRevenueCsaModal', () => {
        $('#weeklyRevenueCsaModel').modal('show');
    });

</script>
