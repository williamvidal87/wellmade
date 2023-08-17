<script>
    // document.addEventListener('DOMContentLoaded', function() {      
    //     $('#jobReportTable').DataTable();
       
    // });

    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });   

    window.livewire.on('closeMonthlyNewCustomerModal', () => {
        $('#monthlyNewCustomerPerformanceReportModal').modal('hide');
    });

    window.livewire.on('openMonthlyNewCustomerModal', () => {
        $('#monthlyNewCustomerPerformanceReportModal').modal('show');
    });   


  
</script>
