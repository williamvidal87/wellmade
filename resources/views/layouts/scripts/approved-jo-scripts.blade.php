<script>
    document.addEventListener("livewire:load", function () {
       
    });
    document.addEventListener('DOMContentLoaded', function() {
        $('#approvedjoborderTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", () => {  

        
        Livewire.hook('element.updated', (el, component) => {
            $("#approvedjoborderTable").DataTable().destroy();
            $('#approvedjoborderTable').DataTable({
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
            }, 300);
        });

    });
    
    window.livewire.on('closeJobOrderModal', () => {
        $('#approvedjoModal').modal('hide');
        $('#approvedjoborderTable').DataTable();
    });

    window.livewire.on('openApprovedJobOrderModal', () => {
        $('#approvedjoModal').modal('show');
    });

    window.livewire.on('openJournalizeModal', () => {
        $('#serviceInvoiceModal').modal('show');
    });

    window.livewire.on('closeJournalizeModal', () => {
        $('#serviceInvoiceModal').modal('hide');       
    });

    window.addEventListener('swal:confirmJobOrderDelete', event => {
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
                window.livewire.emit('deleteJobOrder', event.detail.id)
                swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });
    
</script>
