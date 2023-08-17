<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#checkVoucherTable').DataTable();

        window.initChartIdDrop = () => {
        $('.voucher_id').select2({
            dropdownParent: $("#checkVoucherModal"),
            placeholder: '-- Choose a product --',
            allowClear: false,
            closeOnSelect: true

        });
        }

        initChartIdDrop();
        $('.voucher_id').on('change', function(e) {
            var index = e.target['name'].split("[")[1].split("]")[0]
            livewire.emit('selectedChart', e.target.value, index)
        });
        
        window.livewire.on('select2', () => {
            initChartIdDrop();
        });
    });

    document.addEventListener('reApplySelect2', function() {
        window.initChartIdDrop = () => {
        $('.voucher_id').select2({
            dropdownParent: $("#checkVoucherModal"),
            placeholder: '-- Choose a product --',
            allowClear: false,
            closeOnSelect: true

        });
        }

        initChartIdDrop();
        $('.voucher_id').on('change', function(e) {
            var index = e.target['name'].split("[")[1].split("]")[0]
            livewire.emit('selectedChart', e.target.value, index)
        });
        
        window.livewire.on('select2', () => {
            initChartIdDrop();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#checkVoucherTable").DataTable().destroy();
            // $('#checkVoucherTable').DataTable({
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

    window.livewire.on('closeCheckVoucherModal', () => {
        $('#checkVoucherModal').modal('hide');
        $('#checkVoucherTable').DataTable();
    });

    window.livewire.on('openCheckVoucherModal', () => {
        $('#checkVoucherModal').modal('show');
    });

    window.livewire.on('closeSupplier', () => {
        $('#supplierModal').modal('hide');
    });

    window.livewire.on('openSupplierModal', () => {
        $('#supplierModal').modal('show');
    });

    window.addEventListener('swal:confirmCheckVoucherDelete', event => {
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
                window.livewire.emit('deleteCheckVoucher', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:postConfirmCheckVoucher', event => {
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
                window.livewire.emit('postCheckVoucher', event.detail.id)
                swal.fire(
                    'Posted!',
                    'Your file has been updated.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:reverseConfirmCheckVoucher', event => {
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
                window.livewire.emit('reverseCheckVoucher', event.detail.id)
                swal.fire(
                    'Reversed!',
                    'Your file has been reversed.',
                    'success'
                )
            }
        });
    });

</script>
