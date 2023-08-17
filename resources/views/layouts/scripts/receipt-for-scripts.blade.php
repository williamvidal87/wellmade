<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#scopeTable');
        $('#receiptForTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#receiptForTable").DataTable().destroy();
            $('#receiptForTable').DataTable({
                responsive: true,
                paging: true,
                destroy: true,
                scrollCollapse: true,
                scrollY: '50vh',
            });
        })
    });

    window.livewire.on('closeReceiptForModal', () => {
        $('#receiptForModal').modal('hide');
        $('#receiptForTable').DataTable();
    });

    window.livewire.on('openReceiptForModal', () => {
        $('#receiptForModal').modal('show');
    });


    window.addEventListener('swal:confirmReceiptForDelete', event => {
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
                window.livewire.emit('deleteReceiptFor', event.detail.id)
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
