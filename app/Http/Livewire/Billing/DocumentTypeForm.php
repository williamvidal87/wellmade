<?php

namespace App\Http\Livewire\Billing;

use App\Models\DocumentType;
use Livewire\Component;

class DocumentTypeForm extends Component
{

    public $type, $documentTypeId;

    public $action = '';
    public $message = '';

    protected $listeners = [
        'documentTypeId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function documentTypeId($documentTypeId)
    {
        $this->documentTypeId = $documentTypeId;
        $documentType = DocumentType::find($documentTypeId);
        $this->type = $documentType->type;
    }

    public function store()
    {

        $data = $this->validate([
            'type' => 'required',
        ]);

        try {
            if ($this->documentTypeId) {
                DocumentType::find($this->documentTypeId)->update($data);
            } else {
                DocumentType::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->documentTypeId) {
            $action = 'edit';
            $message = 'Document Type Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Document Type Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeDocumentTypeModal');
    }

    public function render()
    {
        return view('livewire.billing.document-type-form');
    }
}
