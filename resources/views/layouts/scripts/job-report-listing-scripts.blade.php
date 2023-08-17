<script>
    // document.addEventListener('DOMContentLoaded', function() {      
    //     $('#jobReportTable').DataTable();
       
    // });

    document.addEventListener("DOMContentLoaded", () => {

        // Livewire.hook('element.updated', (el, component) => {
        //     $("#jobReportTable").DataTable().destroy();            
        //     $('#jobReportTable').DataTable({               
        //         responsive: true,
        //         paging: true,
        //         destroy: true,
        //         scrollCollapse: true,                
        //         scrollY: '50vh',  
                
               
        //     });
        // });

        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeModal', () => {
        $('#jobReportModal').modal('hide');
        // $('#jobReportTable').DataTable();-
    });

    window.livewire.on('openModal', () => {
        $('#jobReportModal').modal('show');
    });

    window.livewire.on('closeConsumableModal', () => {
        $('#consumableModal').modal('hide');
        // $('#consumableModal').DataTable();
    });

    window.livewire.on('openConsumableModal', () => {
        $('#consumableModal').modal('show');
    });

    //delete contact
    window.addEventListener('swal:confirmClientDelete', event => {
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
                    window.livewire.emit('deleteClientType', event.detail.id)
                    swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
            }
        });
    });  //
</script>
