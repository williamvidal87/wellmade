<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#scopeTable');
        $('#serviceInvoiceTable').DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#serviceInvoiceTable").DataTable().destroy();
            // $('#serviceInvoiceTable').DataTable({
            //     responsive: true,
            //     paging: true,
            //     destroy: true,
            //     scrollCollapse: true,
            //     scrollY: '50vh',
            // });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeServiceInvoiceModal', () => {
        $('#serviceInvoiceModal').modal('hide');
        $('#serviceInvoiceTable').DataTable();
    });

    window.livewire.on('openServiceInvoiceModal', () => {
        $('#serviceInvoiceModal').modal('show');
    });

    window.livewire.on('openServiceInvoiceViewModal', () => {
        $('#serviceInvoiceViewModal').modal('show');
    });


    window.addEventListener('swal:confirmServiceInvoiceTransaction', event => {
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
                window.livewire.emit('postServiceInvoice', event.detail.id, event.detail.data, null)
                swal.fire(
                    'Success!',
                    'Your request has been approved.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:cancelConfirmServiceInvoiceTransaction', event => {
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
                window.livewire.emit('cancelServiceInvoice', event.detail.id, event.detail.data)
                swal.fire(
                    'Cancelled!',
                    'Your transaction has been cancelled.',
                    'success'
                )
            }
        });
    });

</script>
