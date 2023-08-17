<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#clientTable');
        $('#componentpartsTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#componentpartsTable").DataTable().destroy();
            $('#componentpartsTable').DataTable({
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

    window.livewire.on('closeComponentPartsListModal', () => {
        $('#componentpartsListModal').modal('hide');
        $('#componentpartsTable').DataTable();
    });

    window.livewire.on('openComponentPartsListModal', () => {
        $('#componentpartsListModal').modal('show');
    });


    window.addEventListener('swal:confirmComponentPartsListDelete', event => {
        swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.icon,
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: event.detail.confirmButtonText,
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('deleteComponentPartsList', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    //
</script>
