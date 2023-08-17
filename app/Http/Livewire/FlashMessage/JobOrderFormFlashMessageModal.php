<?php

namespace App\Http\Livewire\FlashMessage;

use Livewire\Component;

class JobOrderFormFlashMessageModal extends Component
{
    public $message;

    protected $listeners = [

        'FlashMessageForJOForm',
    ];

    public function FlashMessageForJOForm($action, $message){

        $this->message = $message;

        if ($action == 'store') {
            session()->flash('success', $this->message);
        } elseif ($action == 'edit') {
            session()->flash('info', $this->message);
        } elseif ($action == 'delete') {
            session()->flash('delete', $this->message);
        } else {
            session()->flash('error', $this->message);
        }
    }

    public function render()
    {
        return view('livewire.flash-message.job-order-form-flash-message-modal');
    }
}
