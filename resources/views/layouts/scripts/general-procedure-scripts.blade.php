<script>

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#generalProcedureTable');
        $('#generalProcedureTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#generalProcedureTable").DataTable().destroy();
            $('#generalProcedureTable').DataTable({
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

    window.livewire.on('closeModal', () => {
        $('#generalProcedureModal').modal('hide');
        $('#generalProcedureTable').DataTable();
    });

    window.livewire.on('openModal', () => {
        $('#generalProcedureModal').modal('show');
        // $("#generalProcedureTable").DataTable().clear().destroy();
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
            window.livewire.emit('delete',event.detail.id)
            swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
    });
    //

</script>;