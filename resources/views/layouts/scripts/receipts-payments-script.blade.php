<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#serviceInvoiceTable').DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
        });

        window.initClientIdDrop = () => {
            $('#clientId').select2({
                dropdownParent: $("#serviceInvoiceModal"),
                placeholder: '-- Select a client --',
                allowClear: false,
                closeOnSelect: true

            });
        }

        initClientIdDrop();
        $('#clientId').on('change', function(e) {
            livewire.emit('selectedClient', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initClientIdDrop();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        // Livewire.hook('element.updated', (el, component) => {
        //     $("#serviceInvoiceTable").DataTable().destroy();
        //     $('#serviceInvoiceTable').DataTable({
        //         responsive: true,
        //         paging: true,
        //         destroy: true,
        //         scrollCollapse: true,
        //         scrollY: '50vh',
        //     });
        // });

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

    window.livewire.on('openBankModal', () => {
        $('#bankModal').modal('show');
    });

    window.livewire.on('closeBankModal', () => {
        $('#bankModal').modal('hide');
        $('#serviceInvoiceTable').DataTable();
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
                    window.livewire.emit('deleteServiceInvoice', event.detail.id, event.detail.data, event.detail.particular, null)
                    swal.fire(
                        'Success!',
                        'Your request has been approved.',
                        'success'
                    )
                }
            });
    });
</script>
