<div>
    <div class="row">
        <div class="col-xs-12">
            <livewire:flash-message.flash-messages />
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">User Profile</h3>
                </div>
                
                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row">
                            <div class="col-sm-6 table-toolbar-left">
                                <div class="btn-group">
                                    <button class="btn btn-purple btn-labeled" wire:click="createUserProfile"><i class="btn-label demo-pli-add icon-fw"></i>Add</button>
                                    <button class="btn btn-primary btn-labeled" wire:click="downloadALLqrcodes"><i class="btn-label fa fa-qrcode icon-fw"></i>Download Qr Codes</button>
                                </div>
                                
                                <!-- <button class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="userProfileTable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>FULL NAME</th>
                                    <th>POSITION</th>
                                    <th>CONTACT NO.</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userProfile as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>
                                        @foreach ($data->roles as $role)
                                            <span class="badge badge-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$data->contact_no}}</td>
                                    <td>
                                        @if ($data->getStatus->id == 14)
                                            <span class="badge badge-success">{{$data->getStatus->status ?? ''}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$data->getStatus->status ?? ''}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">

                                            <button wire:click="editUserProfile({{ $data->id }})" class="btn btn-info delete-header m-1 btn-sm"  title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            <button wire:click="viewUserQRcode({{ $data->id }})" class="btn btn-primary delete-header m-1 btn-sm"  title="view qrcode"><i class="fa fa-qrcode" aria-hidden="true"></i></button>
                                            
                                            @if ($data->status_id == 14)
                                                <button wire:click="changeToInactive({{ $data->id }})" class="btn btn-success delete-header m-1 btn-sm"  title="Change to Inactive"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @elseif ($data->status_id == 15)
                                                <button wire:click="changeToActive({{ $data->id }})" class="btn btn-danger delete-header m-1 btn-sm"  title="Change to Active"><i class="fa fa-circle" aria-hidden="true"></i></button>
                                            @endif

                                        </div>                
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
            <!-- The Modal -->
            <div wire.ignore.self class="modal fade" id="userProfileModal" tabindex="-1" role="dialog" aria-labelledby="userProfileModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <livewire:u-m-s.user-profile-form />
                </div>
            </div>

            <!-- User qrcode Modal -->
            <div wire.ignore.self class="modal fade" id="userqrcodeModal" tabindex="-1" role="dialog" aria-labelledby="userqrcodeModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <livewire:u-m-s.view-user-q-r-code />
                </div>
            </div>

        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.user-profile-scripts'); 
@endsection
