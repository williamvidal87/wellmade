<?php

namespace App\Http\Livewire\CRM;

use App\Models\ClientType;
use Livewire\Component;
use App\Models\Contact;
use App\Models\CsaType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;

class ContactForm extends Component
{
    use WithFileUploads;

    public $name, $client_types_id, $address, $contact_no, $image, $csa_type_id, $url;
    public $contactId;
    public $action = '';
    public $message = '';
    public $isUploaded = false;
    public $change_images=false;

    protected $listeners = [
        'ContactId',
        'resetInputFieldsContact',
        'setUrl',
    ];   
   
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function removeImage($id)
    {
        $contact_person = Contact::where('id', $id)->first();
        $contact_person->update([
            'image' => ''
        ]);

        return redirect()->to('/contact-person');
    }

    public function resetInputFieldsContact()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function updatedImage()
    {
        if($this->contactId){
            $this->change_images = true;
        }
    
        $this->isUploaded = true;
    }

    //edit
    public function ContactId($id)
    {
        $this->contactId = $id;
        $Contact = Contact::find($id);
        $this->client_types_id = $Contact->client_types_id;
        $this->name = $Contact->name;
        $this->address = $Contact->address;
        $this->contact_no = $Contact->contact_no;
        $this->image = $Contact->image;
        $this->csa_type_id = $Contact->csa_type_id;

    }
   
    public function storeContact()
    {

        if(!$this->contactId || $this->change_images){
            $data = $this->validate([
                'name' => ['required', Rule::unique('contacts', 'name')->ignore($this->contactId)],
                'client_types_id' => 'required',
                'address' => 'nullable',
                'contact_no' => 'nullable',
                'image' => 'nullable|image|max:2000',
                'csa_type_id' => 'required',
            ]);
        }else{
            $data = $this->validate([
                'name' => ['required', Rule::unique('contacts', 'name')->ignore($this->contactId)],
                'client_types_id' => 'required',
                'address' => 'nullable',
                'contact_no' => 'nullable',
                'image' => 'nullable|max:2000',
                'csa_type_id' => 'required',
            ]);
        }

        if(!empty($this->image)){
            if ($this->isUploaded) {
                $image = 'image.' . time() . $this->image->getClientOriginalName();

                $this->image->storeAs('public/images', $image);

                $data['image'] = $image;
            }
        }

        try {
            // dd($data);
            if ($this->contactId) {
                Contact::find($this->contactId)->update($data);
            } else {
                Contact::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->contactId) {
            $action = 'edit';
            $message = 'Contact Person Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Contact Person Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        if($this->url == 'contact-person'){
            return redirect()->to('/contact-person');
        }
        
        $this->resetInputFieldsContact();
        $this->emit('refreshParentContact');
        $this->emit('closeContactModal');
        $this->emit('select2');
    }


    public function render()
    {
        $this->url = $this->url ?? Route::current()->getName();

        return view('livewire.c-r-m.contact-form', [
            'client_types' => ClientType::with('getIndustry')->get(),
            'csa_types' => CsaType::all(),
        ]);
    }
}
