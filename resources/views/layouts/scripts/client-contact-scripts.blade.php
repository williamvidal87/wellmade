<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#clientContactTable');
        $('#clientContactTable').DataTable();
        $('#transactionClientContactModal').on('shown.bs.modal', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });
        $('#counterReceiptClientContactTable').on('shown.bs.modal', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });

        window.initContactPersonIdDrop = () => {
            $('#contactPersonId').select2({
                dropdownParent: $("#clientContactModal"),
                placeholder: '-- Select a contact person --',
                allowClear: false,
                closeOnSelect: true
            });
        }
        
        initContactPersonIdDrop();
        $('#contactPersonId').on('change', function(e) {
            livewire.emit('selectedContactPerson', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initContactPersonIdDrop();
        });

    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#clientContactTable").DataTable().destroy();
            // $('#clientContactTable').DataTable({
            //     responsive: true,
            //     paging : true,
            //     destroy : true, 
            //     scrollCollapse: true,
            //     scrollY:'50vh',
            // });
        });

        Livewire.hook('element.updated', (el, component) => {
            // $("#transactionClientContactTable").DataTable().destroy();
            // $('#transactionClientContactTable').DataTable({
            //     responsive: true,
            //     paging : true,
            //     destroy : true, 
            //     scrollCollapse: true,
            //     scrollY:'50vh',
            // });
        });

        Livewire.hook('element.updated', (el, component) => {
            // $("#counterReceiptClientContactTable").DataTable().destroy();
            // $('#counterReceiptClientContactTable').DataTable({
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


    window.livewire.on('closeClientContactModal', () => {
        $('#clientContactModal').modal('hide');
        $('#clientContactTable').DataTable();
    });

    window.livewire.on('openClientContactModal', () => {
        $('#clientContactModal').modal('show');
    });

    window.livewire.on('closeContactModal', () => {
        $('#contactModal').modal('hide');       
    });

    window.livewire.on('openContactModal', () => {
        $('#contactModal').modal('show');
    });

    window.livewire.on('openTransactionClientContactModal', () => {
        $('#transactionClientContactModal').modal('show');
    });

    window.livewire.on('openPaymentClientContactModal', () => {
        $('#paymentClientContactModal').modal('show');
    });

    window.livewire.on('closePaymentClientContactModal', () => {
        $('#paymentClientContactModal').modal('hide');
    });

    window.livewire.on('closeCounterReceiptModal', () => {
        $('#counterReceiptClientContactModal').modal('hide');       
    });

    window.livewire.on('openCounterReceiptModal', () => {
        $('#counterReceiptClientContactModal').modal('show');
    });

    window.addEventListener('swal:confirmChangeToInactive', event => {
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
            window.livewire.emit('toInActive',event.detail.id)
            swal.fire(
            'Inactive!',
            'Status has been changed.',
            'success'
            )
        }
        });
    });

    window.addEventListener('swal:confirmChangeToActive', event => {
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
            window.livewire.emit('toActive',event.detail.id)
            swal.fire(
            'Active!',
            'Status has been changed.',
            'success'
            )
        }
        });
    });

</script>