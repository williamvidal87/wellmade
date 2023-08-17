<script>
    document.addEventListener('DOMContentLoaded', function() {
        // let table = new DataTable('#permissionTable');
        $('#permissionTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#permissionTable").DataTable().destroy();
            $('#permissionTable').DataTable({
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

    window.livewire.on('closePermissionModal', () => {
        $('#permissionModal').modal('hide');
        $('#permissionTable').DataTable();
    });

    window.livewire.on('openPermissionModal', () => {
        $('#permissionModal').modal('show');
    });

    window.addEventListener('swal:confirmPermissionDelete', event => {
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
                window.livewire.emit('deletePermission', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });

    document.addEventListener("livewire:load", function(event) { 
        window.livewire.hook('afterDomUpdate', () => { 
            setTimeout(function() { $('.alert').fadeOut('fast'); }, 300);
         }); 
    });
</script>
