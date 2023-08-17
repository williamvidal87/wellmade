<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#procurementManagementTable');
        $('#procurementManagementTable').DataTable();

        window.initSupplierIdDrop = () => {
            $('#supplierId').select2({
                dropdownParent: $("#procurementManagementModal"),
                placeholder: '-- Select a supplier --',
                allowClear: false,
                closeOnSelect: true
            });
        }

        initSupplierIdDrop();
        $('#supplierId').on('change', function(e) {
            livewire.emit('selectedSupplierId', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initSupplierIdDrop();
        });

        window.initProductIdDrop = () => {
        $('.product_id').select2({
            dropdownParent: $("#procurementManagementModal"),
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
            dropdownParent: $("#procurementManagementModal"),
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
            // $("#procurementManagementTable").DataTable().destroy();
            // $('#procurementManagementTable').DataTable({
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

    window.livewire.on('disableOption', () => {
        $("tr").each(function() {
            $(".listItems .optionNull").attr("disabled", true);
        });
    });

    Livewire.hook('message.processed', (message, component) => {
        $('.listItems').on('change', function () {

        
        // $(".listItems .optionNull").attr("disabled", true);

            /* enable any previously disabled options */
            $('option[disabled]').prop('disabled', false);

            /* loop over each select */
            $('select').each(function() {

                /* for every other select, disable option which matches this this.value */
                $('select').not(this).find('option[value="' + this.value + '"]').prop('disabled', true); 

            });

        });
    });

    window.livewire.on('closeProcurementManagementModal', () => {
        $('#procurementManagementModal').modal('hide');
        $('#procurementManagementTable').DataTable();
    });

    window.livewire.on('openProcurementManagementModal', () => {
        $('#procurementManagementModal').modal('show');
    });

    window.livewire.on('closeStockModal', () => {
        $('#stockModal').modal('hide');       
    });

    window.livewire.on('openStockModal', () => {
        $('#stockModal').modal('show');
    });

    window.livewire.on('closeStockManagementModal', () => {
        $('#stockManagementModal').modal('hide');       
    });

    window.livewire.on('openStockManagementModal', () => {
        $('#stockManagementModal').modal('show');
    });

    window.livewire.on('disableOption', () => {

        // /* enable any previously disabled options */
        $('option[disabled]').prop('disabled', false);

        // /* loop over each select */
        $('select').each(function() {

             // /* for every other select, disable option which matches this this.value */
            $('select').not(this).find('option[value="' + this.value + '"]').prop('disabled', true); 
            $('select').find('option[value=" "]').prop('disabled', true); 
        });

    });

    window.addEventListener('swal:confirmProcurementManagementDelete', event => {
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
            window.livewire.emit('deleteProcurementManagement',event.detail.id)
            swal.fire(
            'Cancelled!',
            'Your file has been cancelled.',
            'success'
            )
        }
        });
    });

    window.addEventListener('swal:confirmProcurementManagement', event => {
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
            window.livewire.emit('approveProcurement',event.detail.id)
            swal.fire(
            'Approved!',
            'Your request has been approved.',
            'success'
            )
        }
        });
    });


</script>