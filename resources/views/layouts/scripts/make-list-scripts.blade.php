
<script>

document.addEventListener('DOMContentLoaded', function () {
    // let table = new DataTable('#clientTypeTable');
    $('#makeListTable').DataTable();
});

document.addEventListener("DOMContentLoaded", () => {

    Livewire.hook('element.updated', (el, component) => {
        $("#makeListTable").DataTable().destroy();
        $('#makeListTable').DataTable({
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

window.livewire.on('closeMakeListModal', () => {
    $('#makeListModal').modal('hide');
    $('#makeListTable').DataTable();
});

window.livewire.on('openMakeListModal', () => {
    $('#makeListModal').modal('show');
});

window.addEventListener('swal:confirmMakeListDelete', event => {
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
        window.livewire.emit('deleteMakeList',event.detail.id)
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