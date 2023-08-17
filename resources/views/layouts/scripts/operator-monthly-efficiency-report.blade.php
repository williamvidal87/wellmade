<script>
    document.addEventListener('DOMContentLoaded', function() {      
        $('#operatorMonthlyEffeciencyReportTable').DataTable();
       
    });

    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('element.updated', (el, component) => {
            $("#operatorMonthlyEffeciencyReportTable").DataTable().destroy();            
            $('#operatorMonthlyEffeciencyReportTable').DataTable({               
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
        $('#operatorMonthlyEffeciencyReportModal').modal('hide');
        $('#operatorMonthlyEffeciencyReportTable').DataTable();
    });

    window.livewire.on('openModal', () => {
        $('#operatorMonthlyEffeciencyReportModal').modal('show');
    });   

  
</script>
