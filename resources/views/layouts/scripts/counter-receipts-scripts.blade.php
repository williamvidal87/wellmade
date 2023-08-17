<script>

    document.addEventListener('DOMContentLoaded', function () {
        $('#counterReceiptTable').DataTable();
        $('#counterReceiptModal').on('shown.bs.modal', function (e) {
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
        });

        window.initClientIdDrop = () => {
            $('#clientId').select2({
                dropdownParent: $("#counterReceiptModal"),
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

        Livewire.hook('element.updated', (el, component) => {
            $("#counterReceiptTable").DataTable().destroy();
            $('#counterReceiptTable').DataTable({
                responsive: true,
                paging : true,
                destroy : true, 
                scrollCollapse: true,
                scrollY:'50vh',
            });
        });

        Livewire.hook('element.updated', (el, component) => {
            $("#counterReceiptDataTable").DataTable().destroy();
            $('#counterReceiptDataTable').DataTable({
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


    window.livewire.on('closeCounterReceiptModal', () => {
        $('#counterReceiptModal').modal('hide');
        $('#counterReceiptTable').DataTable();
    });

    window.livewire.on('openCounterReceiptModal', () => {
        $('#counterReceiptModal').modal('show');
    });


    window.addEventListener('swal:confirmCounterReceiptDelete', event => {
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
            window.livewire.emit('deleteCounterReceipt',event.detail.id)
            swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
    });

    window.addEventListener('swal:postConfirmCounterReceipt', event => {
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
            window.livewire.emit('postCounterReceipt',event.detail.id)
            swal.fire(
            'Updated!',
            'Your file has been updated.',
            'success'
            )
        }
        });
    });

    window.addEventListener('swal:reverseConfirmCounterReceipt', event => {
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
            window.livewire.emit('reverseCounterReceipt',event.detail.id)
            swal.fire(
            'Updated!',
            'Your file has been updated.',
            'success'
            )
        }
        });
    });

</script>