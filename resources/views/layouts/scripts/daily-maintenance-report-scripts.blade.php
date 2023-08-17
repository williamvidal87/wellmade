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
        $('#dailyMaintenanceReportModal').modal('hide');
        // $('#reconciliationTable').DataTable();-
    });

    window.livewire.on('openModal', () => {
        $('#dailyMaintenanceReportModal').modal('show');
    });   

  
</script>
