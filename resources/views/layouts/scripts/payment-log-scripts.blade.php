<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#paymentLogTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#paymentLogTable").DataTable().destroy();
            $('#paymentLogTable').DataTable({
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

    window.livewire.on('closePaymentLogModal', () => {
        $('#paymentLogModal').modal('hide');
        $('#paymentLogTable').DataTable();
    });

    window.livewire.on('openPaymentLogModal', () => {
        $('#paymentLogModal').modal('show');
    });

    window.addEventListener('swal:confirmPermissionDelete', event => {
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
                window.livewire.emit('deletePermission', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });
</script>
