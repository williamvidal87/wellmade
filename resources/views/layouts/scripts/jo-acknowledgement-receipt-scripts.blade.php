
<script >
    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#invoicetypeTable');
        $('#joAcknowledgementReceiptTable').DataTable();
        $('#joAcknowledgementReceiptInvoicesTable').on('shown.bs.modal', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#joAcknowledgementReceiptTable").DataTable().destroy();
            // $('#joAcknowledgementReceiptTable').DataTable({
            //     responsive: true,
            //     paging : true,
            //     destroy : true,
            //     scrollCollapse:true,
            //     scrollY:'50vh',
            // });
        });

        Livewire.hook('element.updated', (el, component) => {
            // $("#joAcknowledgementReceiptInvoicesTable").DataTable().destroy();
            // $('#joAcknowledgementReceiptInvoicesTable').DataTable({
            //     responsive: true,
            //     paging : true,
            //     destroy : true, 
            //     scrollCollapse: true,
            //     scrollY:'50vh',
            // });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeJoAcknowledgementReceiptModal', () => {
        $('#joAcknowledgementReceiptModal').modal('hide');
        $('#joAcknowledgementReceiptTable').DataTable();
    });

    window.livewire.on('openJoAcknowledgementReceiptModal', () => {
        $('#joAcknowledgementReceiptModal').modal('show');
    });

    window.livewire.on('openJoAcknowledgementReceiptInvoicesModal', () => {
        $('#joAcknowledgementReceiptInvoicesModal').modal('show');
    });

    window.addEventListener('swal:confirmJoAcknowledgementReceiptDelete', event => {
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
            window.livewire.emit('deleteJoAcknowledgementReceipt',event.detail.id)
            swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
    });

</script>