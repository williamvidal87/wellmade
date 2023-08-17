<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#supplierRecordTable');
        $('#transactionClientContactTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#transactionClientContactTable").DataTable().destroy();
            $('#transactionClientContactTable').DataTable({
                responsive: true,
                paging : true,
                destroy : true, 
                scrollCollapse: true,
                scrollY:'50vh',
            });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    // window.livewire.on('closeSupplierRecordModal', () => {
    //     $('#supplierRecordModal').modal('hide');
    //     $('#supplierRecordTable').DataTable();
    // });

    // window.livewire.on('openSupplierRecordModal', () => {
    //     $('#supplierRecordModal').modal('show');
    // });

    window.livewire.on('openTransactionClientContactModal', () => {
        $('#transactionClientContactModal').modal('show');
    });

    // window.addEventListener('swal:confirmSupplierRecordDelete', event => {
    //     swal.fire({
    //         title: event.detail.title,
    //         text: event.detail.text,
    //         icon: event.detail.icon,
    //         showCancelButton: event.detail.showCancelButton,
    //         confirmButtonColor: event.detail.confirmButtonColor,
    //         cancelButtonColor: event.detail.cancelButtonColor,
    //         confirmButtonText: event.detail.confirmButtonText,
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         window.livewire.emit('deleteSupplierRecord',event.detail.id)
    //         swal.fire(
    //         'Deleted!',
    //         'Your file has been deleted.',
    //         'success'
    //         )
    //     }
    //     });
    // });

</script>