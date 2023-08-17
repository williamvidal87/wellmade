<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#job-order-table').DataTable();

        // $(document).ready(function(){
            
        window.initCustomerIDDrop = () => {
            $('#customerID').select2({
                dropdownParent: $("#JOFormModal"),
                placeholder: 'Select a Customer',
                allowClear: false,
                closeOnSelect: true

            });
        }

        initCustomerIDDrop();
        $('#customerID').on('change', function(e) {
            livewire.emit('selectedCustomer', e.target.value)
        });
        
        window.livewire.on('select2', () => {
            initCustomerIDDrop();
        });

        window.initEngineModelDrop = () => {
            $('#engineModel').select2({
                dropdownParent: $("#JOFormModal"),
                placeholder: 'Engine Model',
                allowClear: false,
                closeOnSelect: true
            });
        }
        initEngineModelDrop();
        $('#engineModel').on('change', function(e) {
            livewire.emit('selectedEngineModel', e.target.value)
        });
        window.livewire.on('select2', () => {
            initEngineModelDrop();
        });
    
        // });

        window.initContactPersonDrop = () => {
            $('#contact_person').select2({
                dropdownParent: $("#JOFormModal"),
                placeholder: 'Assigned Mechanic',
                allowClear: false,
                closeOnSelect: true
            });
        }

        initContactPersonDrop();
        $('#contact_person').on('change', function(e) {
            livewire.emit('selectedAssinedMechanic', e.target.value)
        });
        window.livewire.on('select2', () => {
            initContactPersonDrop();
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {

            // $("#job-order-table").DataTable().destroy();
            // $('#job-order-table').DataTable({
            //     responsive: true,
            //     paging: true,
            //     destroy: true,
            //     scrollCollapse: true,
            //     scrollY: '50vh',
            // });

            Livewire.hook('message.processed', (component) => {
                setTimeout(function() {
                    $('#alert_modal1').fadeOut('fast');
                }, 10000);
                setTimeout(function() {
                    $('#alert_modal2').fadeOut('fast');
                }, 10000);
                setTimeout(function() {
                    $('#alert').fadeOut('fast');
                }, 10000);
            });
        });

    });

    window.livewire.on('openJobOrderFormModal', () => {
        $('#JOFormModal').modal('show');
    });

    window.livewire.on('selectAllWorkOrders', (work_order_id) => {
        var ele=document.getElementsByName('wv_checkbox');  
        for(var i=0; i<ele.length; i++){  
            // ele[i].checked=true; 
            for(var a=0; a<work_order_id.length;a++){
                if(ele[i].value == work_order_id[a]){
                    ele[i].checked=true;
                }
            }
        }
    });

    window.livewire.on('deselectAllWorkOrders', () => {
        var ele=document.getElementsByName('wv_checkbox');  
        for(var i=0; i<ele.length; i++){  
            if(ele[i].type=='checkbox'){
                ele[i].checked=false; 
            } 
        } 
    });

    window.livewire.on('checkedByWorkOrderType', (work_order_id) => {
        var ele=document.getElementsByName('wv_checkbox');
        var deselect = [];
        for(var i=0; i<ele.length; i++){
            for(var a=0; a<work_order_id.length; a++){
                if(ele[i].value == work_order_id[a]){
                    ele[i].checked=true;
                }else{
                    if(deselect.includes(ele[i]) == false){
                        deselect.push(ele[i].value);
                    }
                }
            }
        }
        console.log(deselect);
        for(var b=0; b<work_order_id.length; b++){
            for(var c=0; c<deselect.length; c++){
                if(work_order_id[b] == deselect[c]){
                    delete deselect[c];
                }
            }
        }
        for(var d=0; d<ele.length; d++){
            for(var e=0; e<deselect.length; e++){
                if(ele[d].value == deselect[e]){
                    ele[d].checked=false;
                }
            }
        }

        var val = false;
        livewire.emit('turnToDeselect',val);

    });

    window.livewire.on('print_work_orders_script', () => {
        let work_order_vals = [];
        let count;
        var ele=document.getElementsByName('wv_checkbox');
        for(var i=0; i<ele.length; i++){  
            if(ele[i].checked == true){
                work_order_vals.push(ele[i].value);
            }else{
                count++;
            }
        }
        console.log(work_order_vals);
        if(count == ele.length){
            const note = 'none';
            livewire.emit('PrintWorkOdersMethod',note);
        }else{
            livewire.emit('PrintWorkOdersMethod',work_order_vals)
        }
    });

    
    window.livewire.on('closeJobOrderModal', () => {
        $('#JOFormModal').modal('hide');
    });

    
    window.livewire.on('openClientContactModal', () => {
        $('#clientContactModal').modal('show');
    });

    
    window.livewire.on('closeClientContactModal', () => {
        $('#clientContactModal').modal('hide');
    });

    window.livewire.on('closeScopeListModal', () => {
        $('#workSubtypeModal').modal('hide');
    });

    
    window.livewire.on('openMFModal', () => {
        $('#mfModal').modal('show');
    });

    window.livewire.on('openERModal', () => {
        $('#erModal').modal('show');
    });

    window.livewire.on('openCalibModal', () => {
        $('#calibModal').modal('show');
    });

    window.livewire.on('openAddWorkerTable', () => {
        $('#addworkertable').modal('show');
    });

    window.livewire.on('openWorkerForm', () => {
        $('#workerForm').modal('show');
    });

    window.livewire.on('closeWorkerForm', () => {
        $('#workerForm').modal('hide');
    });

    window.livewire.on('openWorkerStartForm', () => {
        $('#workerStartForm').modal('show');
    });

    window.livewire.on('closeWorkerStartForm', () => {
        $('#workerStartForm').modal('hide');
    });

    window.livewire.on('openWorkerEndForm', () => {
        $('#workerEndForm').modal('show');
    });

    window.livewire.on('closeWorkerEndForm', () => {
        $('#workerEndForm').modal('hide');
    });


    window.livewire.on('closeMFModal', () => { // william edited
        $('#mfModal').modal('hide');
    });

    window.livewire.on('closeERModal', () => { // william edited
        $('#erModal').modal('hide');
    });

    window.livewire.on('closeCalibModal', () => { // william edited
        $('#calibModal').modal('hide');
    });

    window.livewire.on('openWorkSubTypeModal', () => {
        $('#workSubtypeModal').modal('show');
    });

    window.livewire.on('openAddWorkOderTable', () => {
        $('#addworkordertable').modal('show');
    });

    window.livewire.on('cancelWorkOrderModal', () => {
        $('#cancelworkordermodal').modal('show');
    });

    window.livewire.on('ClosecancelWorkOrderModal', () => {
        $('#cancelworkordermodal').modal('hide');
    });

    window.livewire.on('OpenstopWorkerModal', () => {
        $('#stopworkordermodal').modal('show');
    });

    window.livewire.on('ClosestopWorkerModal', () => {
        $('#stopworkordermodal').modal('hide');
    });

    window.livewire.on('salesinvoiceModal', () => {
        $('#opensalesinvoiceModal').modal('show');
    });

    window.livewire.on('priceModal', () => {
        $('#jobOrderPrice').modal('show');
    });

    window.livewire.on('closePriceModal', () => {
        $('#jobOrderPrice').modal('hide');
    });

    window.addEventListener('swal:confirmDelete', event => {
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
                window.livewire.emit('delete', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmDeleteWorker', event => {
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
                window.livewire.emit('deleteWorker', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    window.livewire.on('openviewDetailsModal', () => {
        $('#viewDetails').modal('show');
    });

    window.livewire.on('closeContactModal', () => {
        $('#contactModal').modal('hide');
    });

    window.livewire.on('openContactModal', () => {
        $('#contactModal').modal('show');
    });

    window.addEventListener('swal:confirmJobOrderApprove', event => {
        swal.fire({
            title: 'Approval',
            text: 'Approve Job Order?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Yes, Approve JO',
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('approvedJob', event.detail.id)
                swal.fire(
                    'Approved!',
                    'Job Order has been approved.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmJobOrderCancel', event => {
        swal.fire({
            title: 'Cancel',
            text: 'Cancel Job Order?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Yes, Cancel this JO',
        }).then((result) => {
            location.reload();
            if (result.isConfirmed) {
                window.livewire.emit('canceledJO', event.detail.id)
                swal.fire(
                    'Canceled!',
                    'Job Order has been canceled.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmUpdatePrice', event => {
        swal.fire({
            title: 'Update',
            text: 'Update Price?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Yes, Update this Price',
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('updatePriceJO', event.detail.id)
                swal.fire(
                    'Update!',
                    'Price has been updated.',
                    'success'
                )
            }
        });
    });

</script>
