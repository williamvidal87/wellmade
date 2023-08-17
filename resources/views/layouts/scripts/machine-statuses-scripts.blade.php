<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-statuses').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-statuses").DataTable().destroy();
            $('#machine-statuses').DataTable({
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

    window.livewire.on('openmachinestatusesmodal', () => {
        $('#machine-statuses-modal').modal('show');
    });


    window.livewire.on('closemachinestatusesmodal', () => {
        $('#machine-statuses-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineStatuses', event => {
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
                window.livewire.emit('deleteMachineStatuses', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Machine Status has been deleted.',
                    'success'
                )
            }


        });
    });
</script>
