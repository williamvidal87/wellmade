<script>
    document.addEventListener('DOMContentLoaded', function() {      
        $('#userReportTable').DataTable();
       
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#userReportTable").DataTable().destroy();            
            $('#userReportTable').DataTable({               
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
        $('#userReportModal').modal('hide');
        $('#userReportTable').DataTable();
    });

    window.livewire.on('openModal', () => {
        $('#userReportModal').modal('show');
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
