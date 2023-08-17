<?php

namespace App\Http\Livewire\FlashMessage;

use Livewire\Component;

class FlashMessageModal1 extends Component
{
    public $message;

    protected $listeners = [
        'flashActionModal1'
    ];


    public function flashActionModal1($action, $message)
    {
        $this->message = $message;
        //  dd($action );
        if ($action == 'store') {
            session()->flash('success', $this->message);
        } elseif ($action == 'edit') {
            session()->flash('info', $this->message);
        } elseif ($action == 'delete') {
            session()->flash('delete', $this->message);
        } else {
            session()->flash('error', 'Record Store/Updated Unsuccessfully');
        }
    }
    public function render()
    {
        return view('livewire.flash-message.flash-message-modal1');
    }
}
