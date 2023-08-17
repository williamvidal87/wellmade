<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#userProfileTable');
        $('#userProfileTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#userProfileTable").DataTable().destroy();
            // $('#userProfileTable').DataTable({
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

    window.livewire.on('closeUserProfileModal', () => {
        $('#userProfileModal').modal('hide');
        $('#userProfileTable').DataTable();
    });

    window.livewire.on('openUserProfileModal', () => {
        $('#userProfileModal').modal('show');
    });

    window.livewire.on('openUserQRcodeModal', () => {
        $('#userqrcodeModal').modal('show');
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

    //

</script>