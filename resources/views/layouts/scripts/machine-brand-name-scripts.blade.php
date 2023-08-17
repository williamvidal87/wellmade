<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-brand-name').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-brand-name").DataTable().destroy();
            $('#machine-brand-name').DataTable({
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

    window.livewire.on('openmachinebrandnamemodal', () => {
        $('#machine-brand-name-modal').modal('show');
    });


    window.livewire.on('closemachinebrandnamemodal', () => {
        $('#machine-brand-name-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineBrandName', event => {
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
                window.livewire.emit('deleteMachineBrandName', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Brand Name has been deleted.',
                    'success'
                )
            }


        });
    });
</script>
