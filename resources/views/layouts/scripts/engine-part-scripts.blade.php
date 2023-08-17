
<script >


    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#enginepartTable');
        $('#enginepartTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#enginepartTable").DataTable().destroy();
            $('#enginepartTable').DataTable({
                responsive: true,
                paging : true,
                destroy : true,
                scrollCollapse:true,
                scrollY:'50vh',
            });
        });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeEnginePartListModal', () => {
        $('#enginepartListModal').modal('hide');
        $('#enginepartTable').DataTable();
    });

    window.livewire.on('openEnginePartListModal', () => {
        // alert("This is an alert message box.");
        $('#enginepartListModal').modal('show');
    });

    window.addEventListener('swal:confirmEnginePartListDelete', event => {
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
            window.livewire.emit('deleteEnginePartList',event.detail.id)
            swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
    });

</script>