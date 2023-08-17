<?php

namespace App\Http\Livewire\CRM;

use App\Enums\Status;
use App\Models\Branch;
use App\Models\ClientProfile;
use App\Models\ClientType;
use App\Models\CsaType;
use App\Models\Contact;
use App\Models\DiscountPercentage;
use App\Models\InvoiceIssued;
use App\Models\PaymentType;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClientContactForm extends Component
{

    public $name, $email, $client_type, $csa_id, $branch_id, $address, $contact_no, $contact_person, $clientContactId,$jobOrderclientContactId;
    public $contact_name, $tin_no;

    public $action = '';
    public $message = '';

    public $invoice_issued_id, $discount_er, $discount_mf, $discount_spareparts, $discount_calib, $payment_type_id;
    public $contacts = [];

    protected $listeners = [
        'refreshParentContact' => '$refresh',
        'clientContactId',
        'resetInputFields',
        'jobOrderclientContactId',
        'selectedContactPerson',
        'contactSelect2',
    ];

    public function contactSelect2()
    {
        $this->contacts = Contact::where('status_id', Status::ACTIVE)->get();
    }

    public function mount()
    {
        $this->contacts = Contact::where('status_id', Status::ACTIVE)->get();
    }

    public function selectedContactPerson($id)
    {
        $this->contact_person = $id;
    }

    public function hydrate(){
        $this->emit('select2');
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function clientContactId($clientContactId)
    {
        $this->clientContactId = $clientContactId;
        $clientContact = ClientProfile::find($clientContactId);
        $this->name = $clientContact->name;
        $this->email = $clientContact->email;
        $this->client_type = $clientContact->client_type;
        $this->csa_id = $clientContact->csa_id;
        $this->branch_id = $clientContact->branch_id;
        $this->address = $clientContact->address;
        $this->contact_no = $clientContact->contact_no;
        $this->contact_person = $clientContact->contact_person;
        $this->tin_no = $clientContact->tin_no;

        $this->invoice_issued_id = $clientContact->invoice_issued_id;
        $this->discount_er = $clientContact->discount_er;
        $this->discount_mf = $clientContact->discount_mf;
        $this->discount_spareparts = $clientContact->discount_spareparts;
        $this->discount_calib = $clientContact->discount_calib;
        $this->payment_type_id = $clientContact->payment_type_id;
    }
    
    public function jobOrderclientContactId($jobOrderclientContactId)
    {
        $this->jobOrderclientContactId=$jobOrderclientContactId;
    }
    
    public function store()
    {

        $data = $this->validate([
            'name' => ['required', Rule::unique('client_profiles', 'name')->ignore($this->clientContactId)],
            'email' => ['nullable', 'email', Rule::unique('client_profiles', 'email')->ignore($this->clientContactId)],
            'client_type' => 'required',
            'csa_id' => 'required',
            'branch_id' => 'required',
            'address' => 'required',
            'contact_no' => 'nullable',
            'contact_person' => 'nullable',
            'tin_no' => 'nullable',
            'invoice_issued_id' => 'required',
            'discount_er' => 'required',
            'discount_mf' => 'required',
            'discount_spareparts' => 'required',
            'discount_calib' => 'required',
            'payment_type_id' => 'required',
        ]);
        if(empty($this->contact_person)){
            $data['contact_person'] = null;
        }

        try {
            // dd($data);
            if ($this->clientContactId) {
                ClientProfile::find($this->clientContactId)->update($data);
            } else {
                ClientProfile::create($data);
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
            $this->emit('flashAction', $action, $data);
        }

        if ($this->clientContactId) {
            $action = 'edit';
            $message = 'Client Contact Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Client Contact Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeClientContactModal');
        return redirect()->to('/client-contact');
    }



    public function render()
    {
        return view('livewire.c-r-m.client-contact-form', [
            'client_types' => ClientType::with('getIndustry')->get(),
            'csa_types' => CsaType::all(),
            'branches' => Branch::all(),
            'contacts' => $this->contactSelect2() ?? $this->contacts,
            'invoice_issueds' => InvoiceIssued::all(),
            'discount_percentages' => DiscountPercentage::all(),
            'payment_types' => PaymentType::all(),
        ]);
    }

    
    public function addContact(){
        $this->emit('resetInputFieldsClient');
        $this->emit('openContactModal');
        
    }

    
}
