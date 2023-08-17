
<script>

    document.addEventListener('DOMContentLoaded', function() {
        $('#valveTable').DataTable();

    });


        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 2000);
        });
        
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert_modal1').fadeOut('fast');
            }, 2000);
        });
        
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert_modal2').fadeOut('fast');
            }, 500);
        });
        
    
    window.livewire.on('closeValveModal', () => {
        $('#valveformModal').modal('hide');
    });

    window.livewire.on('openValveModal', () => {
        $('#valveformModal').modal('show');
    });
    

    window.addEventListener('swal:confirmValveDelete', event => {
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
            window.livewire.emit('valveDelete',event.detail.id)
            swal.fire(
            'Deleted!',
            'Valve has been deleted.',
            'success'
            )
        }
        });
    });

    // window.addEventListener('swal:confirmJobOrderDelete', event => {
    //     swal.fire({
    //         title: event.detail.title,
    //         text: event.detail.text,
    //         icon: event.detail.icon,
    //         showCancelButton: event.detail.showCancelButton,
    //         confirmButtonColor: event.detail.confirmButtonColor,
    //         cancelButtonColor: event.detail.cancelButtonColor,
    //         confirmButtonText: event.detail.confirmButtonText,
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             window.livewire.emit('deleteJobOrder', event.detail.id)
    //             swal.fire(
    //                 'Deleted!',
    //                 'Your file has been deleted.',
    //                 'success'
    //             )
    //         }
    //     });
    // });
    
    
</script>