<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#machine-country-made').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#machine-country-made").DataTable().destroy();
            $('#machine-country-made').DataTable({
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

    window.livewire.on('openmachinecountrymademodal', () => {
        $('#machine-country-made-modal').modal('show');
    });


    window.livewire.on('closemachinecountrymademodal', () => {
        $('#machine-country-made-modal').modal('hide');
    });

    window.addEventListener('swal:deleteConfirmMachineCountryMade', event => {
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
                window.livewire.emit('deleteMachineCountryMade', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Country Made has been deleted.',
                    'success'
                )

            }
        });
    });
</script>
