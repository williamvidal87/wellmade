<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#accounttypesTable');
        $('#activityLogTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#activityLogTable").DataTable().destroy();
            $('#activityLogTable').DataTable({
                responsive: true,
                paging: true,
                destroy: true,
                scrollCollapse: true,
                scrollY: '50vh',
            });
        });
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });


    });
    window.livewire.on('closeModal', () => {
        $('#activityLogtModal').modal('hide');
        $('#activityLogTable').DataTable();
    });

    window.livewire.on('openModal', () => {
        $('#activityLogtModal').modal('show');
    });
</script>
