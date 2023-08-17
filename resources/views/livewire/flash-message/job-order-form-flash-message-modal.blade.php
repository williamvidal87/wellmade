<div>
    @if ($message = session()->has('error'))
        <div id="alert" class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong class="text-dark">{{ session('error') }}</strong>
        </div>
    @endif
</div>
