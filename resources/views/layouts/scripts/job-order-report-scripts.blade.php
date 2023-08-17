<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#machineANDfabricationTable');
        $('#jobtypeTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#jobtypeTable").DataTable().destroy();
            // $('#jobtypeTable').DataTable({
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

    window.livewire.on('openUnlockAccessModal', () => {
        $('#jobOrderIncentivesModal').modal('show');
    });

    
    window.livewire.on('closeUnlockAccessModal', () => {
        $('#jobOrderIncentivesModal').modal('hide');
    });

    window.livewire.on('openViewIncentives', () => {
        $('#jobOrderViewIncentivesModal').modal('show');
    });

    
    window.livewire.on('closeViewIncentives', () => {
        $('#jobOrderViewIncentivesModal').modal('hide');
    });

    window.addEventListener('swal:confirmUnlockAccess', event => {
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
                window.livewire.emit('unlockAccess',event.detail.id)
                swal.fire(
                'Approved!',
                'Your request has been approved.',
                'success'
                )
            }
        });
    });


    window.addEventListener('swal:confirmOriginalUnlockAccess', event => {
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
                window.livewire.emit('originalUnlockAccess',event.detail.id)
                swal.fire(
                'Approved!',
                'Your request has been approved.',
                'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmDuplicateUnlockAccess', event => {
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
                window.livewire.emit('duplicateUnlockAccess',event.detail.id)
                swal.fire(
                'Approved!',
                'Your request has been approved.',
                'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmTriplicateUnlockAccess', event => {
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
                window.livewire.emit('triplicateUnlockAccess',event.detail.id)
                swal.fire(
                'Approved!',
                'Your request has been approved.',
                'success'
                )
            }
        });
    });

    //
</script>
