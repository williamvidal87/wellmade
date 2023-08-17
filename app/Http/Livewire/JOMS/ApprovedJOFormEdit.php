<?php

namespace App\Http\Livewire\JOMS;

use Livewire\Component;
use App\Models\JobOrder;
use App\Models\JobTypes;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\ClientProfile;
use App\Models\Contact;
use App\Models\CsaType;
use App\Models\User;
use App\Models\EngineModel;
use App\Models\EngineCategory;
use App\Models\MakeList;
use App\Models\TypeOfPayment;
use App\Models\Status;
use App\Models\WorkOrder;
use App\Models\CategoryList;
use Livewire\WithFileUploads;

class ApprovedJOFormEdit extends Component
{
    use WithFileUploads;
    public $reference_no, $jo_no, $customer_id, $contact_person, $contact_person_form;
    public $po_no, $po_date, $csa, $engine_model, $category;
    public $serial_no, $date_receive, $date_commited, $terms_of_payment;
    public $remarks, $edit_reason, $status, $payment_status_id;
    public $joborderID,$csaID,$csa_foreign_name;
    public $change_images=false, $isUploaded = false;
    public $item_image = [], $activate = false;
    public $date, $work_order_type, $is_work_group_type=false, $clicked_work_orders;
    public $category_and_makeList_id, $makelist_id, $category_foreign_name, $makelist_foreign_name;
    protected $listeners = [
        'resetInputFields',
        'updateCSA',
        'approvedJO'
    ];
    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function updatedItemImage(){
        if($this->joborderID){
            $this->change_images = true;
        }

        $this->isUploaded=true;
    }

    public function updatedReferenceNo(){
        if($this->reference_no){

            $this->jo_no = $this->reference_no;
        }
        elseif(is_null($this->reference_no)){
            $this->jo_no = null;
        }
    }
    
    public function updatedEngineModel(){
        if($this->engine_model){
            $this->category_and_makeList_id = EngineModel::find($this->engine_model); 
            $makeList_data = MakeList::where('id', $this->category_and_makeList_id->make_id)->withTrashed()->first();
            $this->makelist_id = $makeList_data->id;
            $this->makelist_foreign_name = $makeList_data->make_name;
            $category_data = CategoryList::where('id', $this->category_and_makeList_id->category_id)->first();
            $this->category = $category_data->id;
            $this->category_foreign_name = $category_data->category;
        }
        else{
            $this->makelist_foreign_name = null;
            $this->category_foreign_name = null;
        }
        
    }

    public function updatedCustomerId(){
        if($this->customer_id){

            $this->csaID = ClientProfile::find($this->customer_id);
            $csa_data = CsaType::where('id', $this->csaID->csa_id)->first();
            $this->csa_foreign_name = $csa_data->csa_type;
            $this->csa = $csa_data->id;
            $getContactPerson = Contact::where('id',$this->csaID->contact_person)->first();
            $this->contact_person_form = $getContactPerson->name;
            $this->contact_person = $this->csaID->contact_person;
        }
        else{
            $this->csa_foreign_name = null;
            $this->csa = null;
            $this->contact_person_form = null;
            $this->contact_person = null;
        }
        
    }

    public function updated($propertyItemImage)
    {

        $this->validateOnly($propertyItemImage, [
            'item_image.*' => 'image|max:2000', // 1MB Max
        ]);
    }

    public function approvedJO($joborderID)
    {
        $this->joborderID = $joborderID;
        $forjoborderID = JobOrder::find($joborderID);
        $getContactPerson = Contact::where('id',$forjoborderID->contact_person)->first();
        $data_m = MakeList::where('id', $forjoborderID->makelist_id)->withTrashed()->first();
        $data_c = CategoryList::where('id', $forjoborderID->category)->first();
        $data_csa = CsaType::where('id', $forjoborderID->csa)->first();

        $this->reference_no = $forjoborderID->reference_no;
        $this->date = $forjoborderID->date->format("Y-m-d");
        $this->jo_no = $forjoborderID->jo_no;
        $this->customer_id = $forjoborderID->customer_id;
        $this->contact_person = $forjoborderID->contact_person;
        
        $this->contact_person_form = $getContactPerson->name;
        $this->po_no = $forjoborderID->po_no;
        $this->po_date = $forjoborderID->po_date->format("Y-m-d");
        $this->csa_foreign_name = $data_csa->csa_type;
        $this->csa = $forjoborderID->csa;
        $this->engine_model = $forjoborderID->engine_model;
        $this->makelist_foreign_name = $data_m->make_name;
        $this->makelist_id = $forjoborderID->makelist_id;
        $this->category_foreign_name = $data_c->category;
        $this->category = $forjoborderID->category;
        $this->serial_no = $forjoborderID->serial_no;
        $this->date_receive = $forjoborderID->date_receive->format("Y-m-d");
        $this->date_commited = $forjoborderID->date_commited->format("Y-m-d");
        $this->terms_of_payment = $forjoborderID->terms_of_payment;
        $this->remarks = $forjoborderID->remarks;
        $this->edit_reason = $forjoborderID->edit_reason;
        $this->status = $forjoborderID->status;
        $this->payment_status_id = $forjoborderID->payment_status_id;
        $this->item_image = $forjoborderID->item_image;
    }

    public function render()
    {
        if(is_null($this->date) && is_null($this->po_date) && is_null($this->date_commited) && is_null($this->date_receive)){
            $this->date = date("Y-m-d");
            $this->po_date = date("Y-m-d");
            $this->date_commited = date("Y-m-d");
            $this->date_receive = date("Y-m-d");
        }

        return view('livewire.j-o-m-s.approved-j-o-form-edit', [
            'client_profile'=>ClientProfile::all()->sortBy('id'),
            // 'users'=>User::role('Mechanic')->get(),
            'users'=>User::all(),
            'engine_models'=>EngineModel::all()->sortBy('id'),
            'engine_categories'=>EngineCategory::all()->sortBy('id'),
            'types_of_payments'=>TypeOfPayment::all()->sortBy('id'),

        ]);
    }
    
    public function store()
    {
    
        $this->payment_status_id = 13;
        $paths = [];
        if(!$this->joborderID || $this->change_images){
            $data = $this->validate([
                'reference_no' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'jo_no' => 'required',
                'customer_id' => 'required',
                'contact_person'=>'',
                'po_no' => '',
                'po_date' => 'required',
                'csa' => 'required',
                'engine_model' => 'required',
                'makelist_id' => 'required',
                'category' => 'required',
                'serial_no' => 'required',
                'date_receive' => 'required|date_format:Y-m-d',
                'date_commited' => 'required|date_format:Y-m-d',
                'terms_of_payment' => 'required',
                'remarks' => '',
                'edit_reason' => '',
                'status' => 'required',
                'payment_status_id' => 'required',
                'item_image.*' => 'image|max:2000', // 2MB Max
    
            ]);
        }else{
            $data = $this->validate([
                'reference_no' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'jo_no' => 'required',
                'customer_id' => 'required',
                'contact_person'=>'',
                'po_no' => '',
                'po_date' => 'required',
                'csa' => 'required',
                'engine_model' => 'required',
                'makelist_id' => 'required',
                'category' => 'required',
                'serial_no' => 'required',
                'date_receive' => 'required|date_format:Y-m-d',
                'date_commited' => 'required|date_format:Y-m-d',
                'terms_of_payment' => 'required',
                'remarks' => '',
                'edit_reason' => '',
                'status' => 'integer',
                'payment_status_id' => 'integer',

            ]);
        }
        $data['status'] = $this->status;
        $data['payment_status_id'] =  $this->payment_status_id;

        if(!$this->joborderID || $this->change_images){
            if(!empty($this->item_image)){
                $images = $this->item_image; 
    
                foreach ($images as $img) {
    
                    $paths[] = $filenames = 'image_' . time() . $img->getClientOriginalName();
    
                    $img->storeAs('public/images/', $filenames);             
                }
                $data['item_image'] = $paths;
            }
        }
        else{

            $data['item_image'] = $this->item_image;
        }
        try{

            if($this->joborderID){
                JobOrder::find($this->joborderID)->update($data);
                $this->emit('record_updates');

            }else{
                JobOrder::create($data);
                $this->emit('created_records', $data);
            }
        } catch (\Exception $e){
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if($this->joborderID){
            $action = 'edit';
            $message = 'Permission Successfully Updated';
            $this->emit('flashAction', $action, $message);
        }else{
            $action = 'store';
            $message = 'Permission Successfully Saved';
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeJobOrderModal');
    }


}
