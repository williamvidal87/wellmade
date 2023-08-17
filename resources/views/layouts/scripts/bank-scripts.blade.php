<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#scopeTable');
        $('#bankTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#bankTable").DataTable().destroy();
            $('#bankTable').DataTable({
                responsive: true,
                paging: true,
                destroy: true,
                scrollCollapse: true,
                scrollY: '50vh',
            });
        })
    });

    window.livewire.on('closeBankModal', () => {
        $('#bankModal').modal('hide');
        $('#bankTable').DataTable();
    });

    window.livewire.on('openBankModal', () => {
        $('#bankModal').modal('show');
    });


    window.addEventListener('swal:confirmBankDelete', event => {
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
                window.livewire.emit('deleteBank', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    //
</script>
