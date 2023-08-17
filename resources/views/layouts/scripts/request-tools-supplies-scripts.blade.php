<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#scopeTable');
        $('#requestToolsSuppliesTable').DataTable({
            order: [[0, 'desc']],
        });

        window.initJoIdDrop = () => {
            $('#jo_no_id').select2({
                dropdownParent: $("#requestToolsSuppliesModal"),
                placeholder: '-- Select a jo --',
                allowClear: false,
                closeOnSelect: true

            });
        }

        initJoIdDrop();
        $('#jo_no_id').on('change', function(e) {
            livewire.emit('selectedJo', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initJoIdDrop();
        });

        window.initProductIdDrop = () => {
        $('.product_id').select2({
            dropdownParent: $("#requestToolsSuppliesModal"),
            placeholder: '-- Choose a product --',
            allowClear: false,
            closeOnSelect: true

        });
        }

        initProductIdDrop();
        $('.product_id').on('change', function(e) {
            var index = e.target['name'].split("[")[1].split("]")[0]
            livewire.emit('selectedProduct', e.target.value, index)
        });
        
        window.livewire.on('select2', () => {
            initProductIdDrop();
        });

    });

    document.addEventListener('reApplySelect2', function() {
        window.initProductIdDrop = () => {
        $('.product_id').select2({
            dropdownParent: $("#requestToolsSuppliesModal"),
            placeholder: '-- Choose a product --',
            allowClear: false,
            closeOnSelect: true

        });
        }

        initProductIdDrop();
        $('.product_id').on('change', function(e) {
            var index = e.target['name'].split("[")[1].split("]")[0]
            livewire.emit('selectedProduct', e.target.value, index)
        });
        
        window.livewire.on('select2', () => {
            initProductIdDrop();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#requestToolsSuppliesTable").DataTable().destroy();
            // $('#requestToolsSuppliesTable').DataTable({
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

    window.livewire.on('closeRequestToolsSuppliesModal', () => {
        $('#requestToolsSuppliesModal').modal('hide');
        $('#requestToolsSuppliesTable').DataTable();
    });

    window.livewire.on('openRequestToolsSuppliesModal', () => {
        $('#requestToolsSuppliesModal').modal('show');
    });


    window.addEventListener('swal:confirmRequestToolsDelete', event => {
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
                window.livewire.emit('deleteRequestTools', event.detail.id)
                swal.fire(
                    'Cancelled!',
                    'Your file has been cancelled.',
                    'success'
                )
            }
        });
    });


    window.addEventListener('swal:approveProcurementManagement', event => {
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
                window.livewire.emit('confirmApproveRequestTools', event.detail.id)
                swal.fire(
                    'Approved!',
                    'Your file has been approved.',
                    'success'
                )
            }
        });
    });

    //
</script>
