<?php

namespace App\Http\Livewire\FlashMessage;

use Livewire\Component;

class FlashMessageModal2 extends Component
{
    public $message2;

    protected $listeners = [
        'flashActionModal2'
    ];


    public function flashActionModal2($action2, $message2)
    {
        $this->message2 = $message2;
        //  dd($action2 );
        if ($action2 == 'store') {
            session()->flash('success', $this->message2);
        } elseif ($action2 == 'edit') {
            session()->flash('info', $this->message2);
        } elseif ($action2 == 'delete') {
            session()->flash('delete', $this->message2);
        } else {
            session()->flash('error', 'Record Store/Updated Unsuccessfully');
        }
    }
    public function render()
    {
        return view('livewire.flash-message.flash-message-modal2');
    }
}
