<script>

    $(document).ready(function(){
        document.getElementById("forscanned").autofocus;
    });

    function rescanAgain(){

        var timeleft = 5;
        var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            window.livewire.emit('rescanagain', timeleft);
        }
        timeleft -= 1;
        }, 1000);

    }

    window.livewire.on('openActionModal', () => {
        $('#actionModal').modal('show');
    });

    window.livewire.on('closeActionModal', () => {
        $('#actionModal').modal('close');
    });

    function countDownTimer(){

        var timeleft = 15;
        var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = "Finished";
            window.livewire.emit('countdown', timeleft);
        } else {
            document.getElementById("countdown").innerHTML = timeleft;
        }
        timeleft -= 1;
        }, 1000);
    }
    // document.getElementById("countdown").innerHTML = countDownTimer(); 

</script>