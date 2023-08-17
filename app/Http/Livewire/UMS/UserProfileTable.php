<?php

namespace App\Http\Livewire\UMS;

use App\Enums\Status;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade as PDF;

class UserProfileTable extends Component
{
    use WithPagination;

    public $userProfileId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'toInActive',
        'toActive',
    ];

    public function createUserProfile()
    {
        $this->emit('resetInputFields');
        $this->emit('openUserProfileModal');
    }

    public function editUserProfile($userProfileId)
    {
        $this->emit('resetInputFields');
        $this->userProfileId = $userProfileId;
        $this->emit('userProfileId', $this->userProfileId);
        $this->emit('openUserProfileModal');
    }

    public function changeToInactive($clientContactId)
    {
        $this->dispatchBrowserEvent('swal:confirmChangeToInactive', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to inactive!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, change it!',
            'id' => $clientContactId
        ]);
    }

    public function toInActive($clientContactId)
    {
        User::where('id' ,$clientContactId)->update([
            'status_id' => Status::INACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/user-profile');
    }

    public function changeToActive($clientContactId)
    {
        $this->dispatchBrowserEvent('swal:confirmChangeToActive', [
            'title' => 'Are you sure?',
            'text' => "Client status will be changed to active!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, change it!',
            'id' => $clientContactId
        ]);
    }

    public function toActive($clientContactId)
    {
        User::where('id' ,$clientContactId)->update([
            'status_id' => Status::ACTIVE,
        ]);
        $this->resetPage();
        return redirect()->to('/user-profile');
    }

    public function render()
    {
        return view('livewire.u-m-s.user-profile-table', [
            'userProfile' => User::with('getStatus')->get()->except(1),
        ]);
    }

    public function downloadALLqrcodes(){

        $pdfContent = PDF::loadView('livewire.print-work-order.print-all-user-qrcodes', ['viewdata'=>User::all()->except(1)])->output();
        redirect()->to('/user-profile');
        return response()->streamDownload(
        fn () => print($pdfContent),
        "qr_codes.pdf"
        );
    }

    public function viewUserQRcode($userID){

        $this->emit('openUserQRcodeModal');
        $this->emit('UserQRCode', $userID);
    }
}
