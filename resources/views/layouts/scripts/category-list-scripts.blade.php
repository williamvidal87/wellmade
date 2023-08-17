
<script>

document.addEventListener('DOMContentLoaded', function () {
    // let table = new DataTable('#clientTypeTable');
    $('#categoryListTable').DataTable();
});

document.addEventListener("DOMContentLoaded", () => {

    Livewire.hook('element.updated', (el, component) => {
        $("#categoryListTable").DataTable().destroy();
        $('#categoryListTable').DataTable({
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

window.livewire.on('closeCategoryListModal', () => {
    $('#categoryListModal').modal('hide');
    $('#categoryListTable').DataTable();
});

window.livewire.on('openCategoryListModal', () => {
    $('#categoryListModal').modal('show');
});

window.addEventListener('swal:confirmCategoryListDelete', event => {
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
        window.livewire.emit('deleteCategoryList',event.detail.id)
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