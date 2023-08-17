<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">System Settings</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <button class="btn btn-primary btn-labeled"><i class="btn-label fa fa-cog icon-fw"></i>Edit</button>
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <h4><i class="fa fa-home"></i> Company Name:</h4>
                    <hr>
                    <h4><i class="fa fa-address-card-o"></i> Address: </h4>
                    <hr>
                    <h4><i class="fa fa-address-book-o"></i> Contact Number:</h4>
                    <hr>
                    <h4><i class="fa fa-user-o"></i> Owner Name:</h4>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
</div>
{{-- @section('custom_script')
    @include('layouts.scripts.user-profile-scripts'); 
@endsection --}}
