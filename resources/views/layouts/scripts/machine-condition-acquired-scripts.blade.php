<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-condition-acquired-name').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-condition-acquired-name").DataTable().destroy();
            $('#machine-condition-acquired-name').DataTable({
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

    window.livewire.on('openmachineconditionnamemodal', () => {
        $('#machine-condition-acquired-modal').modal('show');
    });


    window.livewire.on('closemachineconditionnamemodal', () => {
        $('#machine-condition-acquired-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineCostCenters', event => {
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
                window.livewire.emit('deleteMachineConditionAcquiredName', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Condition has been deleted.',
                    'success'
                )

            }
        });
    });
</script>
