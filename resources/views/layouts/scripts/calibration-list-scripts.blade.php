<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#clientTypeTable');
        $("#calibrationTable").DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#calibrationTable").DataTable().destroy();
            $('#calibrationTable').DataTable({
                responsive: true,
                paging: true,
                destroy: true,
                scrollCollapse: true,
                scrollY: '50vh',
            });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeCalibrationListModal', () => {
        $('#calibrationListModal').modal('hide');
        $("#calibrationTable").DataTable();
    });

    window.livewire.on('openCalibrationListModal', () => {
        $('#calibrationListModal').modal('show');
    });


    window.addEventListener('swal:confirmCalibrationListDelete', event => {
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
                window.livewire.emit('deleteCalibrationList', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    //
</script>
