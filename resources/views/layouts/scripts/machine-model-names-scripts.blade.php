<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-model-name').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-model-name").DataTable().destroy();
            $('#machine-model-name').DataTable({
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

    window.livewire.on('openmachinemodelnamemodal', () => {
        $('#machine-model-name-modal').modal('show');
    });


    window.livewire.on('closemachinemodelnamemodal', () => {
        $('#machine-model-name-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineModelName', event => {
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
                window.livewire.emit('deleteMachineModelName', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Model Name has been deleted.',
                    'success'
                )

            }
        });
    });
</script>
