<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-purchase-types').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-purchase-types").DataTable().destroy();
            $('#machine-purchase-types').DataTable({
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

    window.livewire.on('openmachinepurchasetypemodal', () => {
        $('#machine-purchase-type-modal').modal('show');
    });


    window.livewire.on('closemachinepurchasetypemodal', () => {
        $('#machine-purchase-type-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachinePurchaseType', event => {
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
                window.livewire.emit('deleteMachinePurchaseType', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Purchase type has been deleted.',
                    'success'
                )
            }


        });
    });
</script>
