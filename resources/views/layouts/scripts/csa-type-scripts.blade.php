<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#clientContactTable');
        $('#csaTypeTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#csaTypeTable").DataTable().destroy();
            $('#csaTypeTable').DataTable({
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


    window.livewire.on('closeCsaTypeModal', () => {
        $('#csaTypeModal').modal('hide');
        $('#csaTypeTable').DataTable();
    });

    window.livewire.on('openCsaTypeModal', () => {
        $('#csaTypeModal').modal('show');
    });


    window.addEventListener('swal:confirmCsaTypeDelete', event => {
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
            window.livewire.emit('deleteCsaType',event.detail.id)
            swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
    });

</script>