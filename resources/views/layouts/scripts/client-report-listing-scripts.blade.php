<script>
    document.addEventListener('DOMContentLoaded', function() {      
        $('#clientReportTable').DataTable();
       
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#clientReportTable").DataTable().destroy();            
            $('#clientReportTable').DataTable({               
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

    window.livewire.on('closeModal', () => {
        $('#clientReportModal').modal('hide');
        $('#clientReportTable').DataTable();
    });

    window.livewire.on('openModal', () => {
        $('#clientReportModal').modal('show');
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
