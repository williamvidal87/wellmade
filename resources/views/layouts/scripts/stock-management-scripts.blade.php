<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#stockManagementTable');
        $('#stockManagementTable').DataTable();

        window.initSupplierIdDrop = () => {
            $('#supplierId').select2({
                dropdownParent: $("#stockManagementModal"),
                placeholder: '-- Select a supplier --',
                allowClear: false,
                closeOnSelect: true

            });
        }

        initSupplierIdDrop();
        $('#supplierId').on('change', function(e) {
            livewire.emit('selectedSupplier', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initSupplierIdDrop();
        });

    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#stockManagementTable").DataTable().destroy();
            // $('#stockManagementTable').DataTable({
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

            setTimeout(function() {
                $('#alertRefill').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeStockManagementModal', () => {
        $('#stockManagementModal').modal('hide');
        $('#stockManagementTable').DataTable();
    });

    window.livewire.on('openStockManagementModal', () => {
        $('#stockManagementModal').modal('show');
    });


    window.addEventListener('swal:confirmStockManagementDelete', event => {
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
                window.livewire.emit('deleteStockManagement', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });
</script>
