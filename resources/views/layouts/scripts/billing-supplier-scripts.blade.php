<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#supplierTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#supplierTable").DataTable().destroy();
            // $('#supplierTable').DataTable({
            //     responsive: true,
            //     paging: true,
            //     destroy: true,
            //     scrollCollapse: true,
            //     scrollY: '50vh',
            // });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeSupplier', () => {
        $('#supplierModal').modal('hide');
        $('#supplierTable').DataTable();
    });

    window.livewire.on('openSupplier', () => {
        $('#supplierModal').modal('show');
    });

    window.addEventListener('swal:inactiveStatusConfirmSupplier', event => {
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
                window.livewire.emit('inactiveStatusSupplier', event.detail.id)
                swal.fire(
                    'Inactive!',
                    'Status has been changed.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:activeStatusConfirmSupplier', event => {
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
                window.livewire.emit('activeStatusSupplier', event.detail.id)
                swal.fire(
                    'Active!',
                    'Status has been changed.',
                    'success'
                )
            }
        });
    });

</script>
