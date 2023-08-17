<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('#supervisorApprovalTable').DataTable();

    });

    window.livewire.on('openJobOrderNoModal', () => {
        $('#showjono').modal('show');
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {

            $("#supervisorApprovalTable").DataTable().destroy();
            $('#supervisorApprovalTable').DataTable({
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
    window.addEventListener('swal:confirmAuthorizeWorkOrder', event => {
        swal.fire({
            title: 'Authorization',
            text: 'Start All Work Order?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Yes, Start All Work Orders',
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('authorizedWorkOrder', event.detail.id)
                swal.fire(
                    'Approved!',
                    'Work orders successfully started',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmReWorkWorkOrder', event => {
        swal.fire({
            title: 'Re-Work',
            text: 'Re-work Work Order?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('reworkconfirmWorkOrder', event.detail.id)
                swal.fire(
                    'Re-Work!',
                    'Work order has been re-worked.',
                    'success'
                )
            }
        });
    });

    window.addEventListener('swal:confirmReleaseWorkOrder', event => {
        swal.fire({
            title: 'For Released',
            text: 'Release Work Order?',
            icon: 'question',
            showCancelButton: event.detail.showCancelButton,
            confirmButtonColor: event.detail.confirmButtonColor,
            cancelButtonColor: event.detail.cancelButtonColor,
            confirmButtonText: 'Confirm',
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('releasedworkorder', event.detail.id)
                swal.fire(
                    'Released!',
                    'Work order has been released.',
                    'success'
                )
            }
        });
    });
</script>
