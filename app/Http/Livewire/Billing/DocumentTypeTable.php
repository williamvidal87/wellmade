<?php

namespace App\Http\Livewire\Billing;

use App\Models\DocumentType;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentTypeTable extends Component
{

    use WithPagination;

    public $documentTypeId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteDocumentType',
    ];

    public function createDocumentType()
    {
        $this->emit('resetInputFields');
        $this->emit('openDocumentTypeModal');
    }


    public function editDocumentType($documentTypeId)
    {
        $this->documentTypeId = $documentTypeId;
        $this->emit('documentTypeId', $this->documentTypeId);
        $this->emit('openDocumentTypeModal');
    }

    public function deleteConfirmDocumentType($documentTypeId)
    {

        // $this->dispatchBrowserEvent(event('swal:confirmCotactDelete'));
        $this->dispatchBrowserEvent('swal:confirmDocumentTypeDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $documentTypeId
        ]);
    }

    public function deleteDocumentType($documentTypeId)
    {

        DocumentType::destroy($documentTypeId);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.billing.document-type-table', [
            'documentType' => DocumentType::all(),
        ]);
    }
}
