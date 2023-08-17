<div>
    <div class="row">

        <livewire:flash-message.flash-messages />

        <div class="col-xs-12">
            <div class="panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Used Parts</h3>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="joUsedPartsTable" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>JO NO</th>
                                    <th>Requester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jo_used_parts as $key => $data)
                                    <tr>
                                        <td>{{ $key ?? '' }}</td>
                                        @foreach ($data as $value)
                                                @if($loop->first)
                                                    <td>{{ $value->getRequestBy->name ?? '' }}</td>
                                                @endif
                                        @endforeach
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button wire:click="viewJoUsedPart({{ $value->jo_no_id }})"
                                                    class="btn btn-primary delete-header m-1 btn-sm" title="View"><i
                                                        class="fa fa-eye" aria-hidden="true"></i>&nbsp; View</button>
                                            </div>
                                            <div class="btn-group">
                                                <button wire:click="printJoUsedPart({{ $value->jo_no_id }})"
                                                    class="btn btn-purple delete-header m-1 btn-sm" title="Edit"><i
                                                        class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button>
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
            <div wire.ignore.self class="modal fade" id="joUsedPartsModal" tabindex="-1" role="dialog"
                aria-labelledby="joUsedPartsModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <livewire:j-o-m-s.jo-used-part-form />
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.jo-used-parts-scripts');
@endsection
