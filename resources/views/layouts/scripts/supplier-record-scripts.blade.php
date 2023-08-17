<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#supplierRecordTable');
        $('#supplierRecordTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#supplierRecordTable").DataTable().destroy();
            // $('#supplierRecordTable').DataTable({
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

    window.livewire.on('closeSupplierRecordModal', () => {
        $('#supplierRecordModal').modal('hide');
        $('#supplierRecordTable').DataTable();
    });

    window.livewire.on('openSupplierRecordModal', () => {
        $('#supplierRecordModal').modal('show');
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