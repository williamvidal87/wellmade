<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#contactPersonTable');
        $('#contactPersonTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            // $("#contactPersonTable").DataTable().destroy();
            // $('#contactPersonTable').DataTable({
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


    window.livewire.on('closeContactModal', () => {
        $('#contactModal').modal('hide');
        $('#contactPersonTable').DataTable();
    });

    window.livewire.on('openContactModal', () => {
        $('#contactModal').modal('show');
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