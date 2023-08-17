<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-depreciation').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-depreciation").DataTable().destroy();
            $('#machine-depreciation').DataTable({
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

    window.livewire.on('openmachinedepreciationmodal', () => {
        $('#machine-depreciation-modal').modal('show');
    });


    window.livewire.on('closemachinedepreciationmodal', () => {
        $('#machine-depreciation-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineDepreciation', event => {
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
                window.livewire.emit('deleteMachineDecpreciation', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Machine Deprecation has been deleted.',
                    'success'
                )

            }
        });
    });
</script>
