<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-purchase-from').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-purchase-from").DataTable().destroy();
            $('#machine-purchase-from').DataTable({
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

    window.livewire.on('openmachinepurchasefrommodal', () => {
        $('#machine-purchase-form-modal').modal('show');
    });


    window.livewire.on('closemachinepurchasefrommodal', () => {
        $('#machine-purchase-form-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachinePurchaseFrom', event => {
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
                window.livewire.emit('deleteMachinePurchaseFrom', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Purchase form has been deleted.',
                    'success'
                )
            }


        });
    });
</script>
