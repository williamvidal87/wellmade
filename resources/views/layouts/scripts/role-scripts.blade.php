<script>

    $(document).ready(function() {
        
    });

    document.addEventListener('DOMContentLoaded', function () {
        $("#roleTable").DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#roleTable").DataTable().destroy();
            $('#roleTable').DataTable({
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

    window.livewire.on('closeRoleModal', () => {
        $('#roleModal').modal('hide');
        $('#roleTable').DataTable();
    });

    window.livewire.on('openRoleModal', () => {
        $('#roleModal').modal('show');
    });

    window.livewire.on('closeSetRoleModal', () => {
        $('#setRoleModal').modal('hide');
        $('#roleTable').DataTable();
    });

    window.livewire.on('openSetRoleModal', () => {
        $('#setRoleModal').modal('show');
    });
    
    window.addEventListener('swal:confirmRoleDelete', event => {
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
            window.livewire.emit('deleteRole',event.detail.id)
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