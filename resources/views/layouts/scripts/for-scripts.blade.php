<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#scopeTable');
        $('#forTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#forTable").DataTable().destroy();
            $('#forTable').DataTable({
                responsive: true,
                paging: true,
                destroy: true,
                scrollCollapse: true,
                scrollY: '50vh',
            });
        })
    });

    window.livewire.on('closeForModal', () => {
        $('#forModal').modal('hide');
        $('#forTable').DataTable();
    });

    window.livewire.on('openForModal', () => {
        $('#forModal').modal('show');
    });


    window.addEventListener('swal:confirmForDelete', event => {
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
                window.livewire.emit('deleteFor', event.detail.id)
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
