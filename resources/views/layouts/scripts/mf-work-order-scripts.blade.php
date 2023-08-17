<script>

    $(document).ready(function() {
        document.getElementById("peso_sign").innerHTML = "\u20B1";
        });

    document.addEventListener('DOMContentLoaded', function () {
        // let table = new DataTable('#mfWorkOrderTable');
        $('#mfWorkOrderTable').DataTable();
    });
    

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#mfWorkOrderTable").DataTable().destroy();
            $('#mfWorkOrderTable').DataTable({
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

    window.livewire.on('closeMFModal', () => {
        $('#mfModal').modal('hide');
        $('#joborderTable').DataTable();
    });
    
    window.livewire.on('closeERModal', () => {
        $('#erModal').modal('hide');
        $('#joborderTable').DataTable();
    });
    
    window.livewire.on('closeCalibModal', () => {
        $('#calibModal').modal('hide');
        $('#joborderTable').DataTable();
    });
    
    window.livewire.on('openMFModal', () => {
        $('#mfModal').modal('show');
    });

    window.livewire.on('openERModal', () => {
        $('#erModal').modal('show');
    });

    window.livewire.on('openCalibModal', () => {
        $('#calibModal').modal('show');
    });

    window.livewire.on('openPrintModal', () => {
        $('#printModal').modal('show');
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

</script>