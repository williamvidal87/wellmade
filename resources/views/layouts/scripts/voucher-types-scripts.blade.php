<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#voucherTypeTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#voucherTypeTable").DataTable().destroy();
            $('#voucherTypeTable').DataTable({
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

    window.livewire.on('closeVoucherTypeModal', () => {
        $('#voucherTypeModal').modal('hide');
        $('#voucherTypeTable').DataTable();
    });

    window.livewire.on('openVoucherTypeModal', () => {
        $('#voucherTypeModal').modal('show');
    });

    window.addEventListener('swal:confirmVoucherTypeDelete', event => {
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
                window.livewire.emit('deleteVoucherType', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });
</script>
