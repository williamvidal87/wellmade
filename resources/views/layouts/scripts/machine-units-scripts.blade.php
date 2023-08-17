<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-units').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-units").DataTable().destroy();
            $('#machine-units').DataTable({
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

    window.livewire.on('openmachineunitsmodal', () => {
        $('#machine-units-modal').modal('show');
    });


    window.livewire.on('closemachineunitsmodal', () => {
        $('#machine-units-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineUnits', event => {
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
                window.livewire.emit('deleteUnits', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Machine Unit has been deleted.',
                    'success'
                )
            }


        });
    });
</script>
