<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-plant-assigned').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-plant-assigned").DataTable().destroy();
            $('#machine-plant-assigned').DataTable({
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

    window.livewire.on('openmachineplantassignedmodal', () => {
        $('#machine-plant-assigned-modal').modal('show');
    });


    window.livewire.on('closemachineplantassignedmodal', () => {
        $('#machine-plant-assigned-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachinePlantAssigned', event => {
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
                window.livewire.emit('MachinePlantAssigned', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Plant Assigned Name has been deleted.',
                    'success'
                )

            }
        });
    });
</script>
