<?php

namespace App\Http\Livewire\JOMS;

use App\Models\CategoryList;
use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\JobOrder;
use App\Models\JobTypes;
use App\Models\ClientProfile;
use App\Models\Contact;
use App\Models\CsaType;
use App\Models\User;
use App\Models\EngineModel;
use App\Models\EngineCategory;
use App\Models\MakeList;
use App\Models\TypeOfPayment;
use App\Models\WorkOrder;

class JobOrderForm extends Component
{
    use WithFileUploads;
    public $reference_no, $jo_no, $customer_id, $contact_person, $contact_person_form;
    public $po_no, $po_date, $csa, $engine_model, $category;
    public $serial_no, $date_receive, $date_commited, $terms_of_payment;
    public $remarks, $edit_reason, $status, $payment_status_id;
    public $joborderID,$csaID,$csa_foreign_name;
    public $change_images=false, $isUploaded = false, $item_image = [];
    public $date, $clicked_work_orders;
    public $category_and_makeList_id, $makelist_id, $category_foreign_name, $makelist_foreign_name;

    protected $listeners = [
        'refreshParentContact' => '$refresh',
        'joborderID',
        'resetInputFields',
        'updateCSA',
        'countdown',
        'selectedCustomer',
        'selectedEngineModel',
        'selectedAssinedMechanic',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function selectedAssinedMechanic($id){

        if($id){
            $this->contact_person = $id;
        }else{
            $this->contact_person = 0;
        }
    }

    public function selectedCustomer($id){

        if($id){

            $this->customer_id = $id;
            $client = ClientProfile::where('id', $id)->first();
            $csa = CsaType::where('id', $client->csa_id)->first();
            $this->csa_foreign_name = $csa->csa_type;
            $this->csa = $csa->id;
        }else{

            $this->csa_foreign_name = null;
            $this->csa = null;
        }

    }

    public function selectedEngineModel($id){

        if($id == "0"){
            $this->engine_model = $id;
            $this->makelist_id = null;
            $this->category = null;

            $this->makelist_foreign_name = "";
            $this->category_foreign_name = "";
        }
        if($id){

            $this->engine_model = $id;
            $this->category_and_makeList_id = EngineModel::find($id);
            $makeList_data = MakeList::where('id', $this->category_and_makeList_id->make_id)->withTrashed()->first();
            $this->makelist_id = $makeList_data->id;
            $this->makelist_foreign_name = $makeList_data->make_name;
            $category_data = CategoryList::where('id', $this->category_and_makeList_id->category_id)->first();
            $this->category = $category_data->id;
            $this->category_foreign_name = $category_data->category;
            
        }else{
            $this->makelist_foreign_name = null;
            $this->category_foreign_name = null;
            $this->category = null;
            $this->makelist_id = null;
        }
    }

    public function hydrate(){
        $this->emit('select2');

    }
    
    public function updatedReferenceNo(){

        if(is_null($this->reference_no)){
            $this->jo_no = null;
        }

        $this->jo_no = $this->reference_no;
    }

    public function updated($propertyItemImage)
    {

        $this->validateOnly($propertyItemImage, [
            'item_image.*' => 'image|max:2000', // 1MB Max
        ]);
    }

    public function joborderID($joborderID)
    {

        $this->joborderID = $joborderID;
        $forjoborderID = JobOrder::find($joborderID); 
        $data_m = MakeList::where('id', $forjoborderID->makelist_id)->withTrashed()->first();
        $data_c = CategoryList::where('id', $forjoborderID->category)->first();
        $data_csa = CsaType::where('id', $forjoborderID->csa)->first();
        $this->reference_no = $forjoborderID->reference_no;
        $this->date = $forjoborderID->date->format("Y-m-d");
        $this->jo_no = $forjoborderID->jo_no;
        $this->customer_id = $forjoborderID->customer_id;

        if(is_null($forjoborderID->contact_person)){
            $this->contact_person = "0";
        }else{
            $this->contact_person = $forjoborderID->contact_person;
        }
        
        $this->po_no = $forjoborderID->po_no ?? "";
        $this->po_date = $forjoborderID->po_date->format("Y-m-d");

        $this->csa_foreign_name = $data_csa->csa_type;
        $this->csa = $forjoborderID->csa;

        $this->engine_model = $forjoborderID->engine_model;

        $this->makelist_foreign_name = $data_m->make_name ?? "";
        $this->makelist_id = $forjoborderID->makelist_id;

        $this->category_foreign_name = $data_c->category ?? "";
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

    public function updatedItemImage(){
        if($this->joborderID){
            $this->change_images = true;
        }

        $this->isUploaded=true;
    }

    public function addContact(){

        $this->emit('resetInputFieldsClient');
        $this->emit('openContactModal');
        
    }

    public function save()
    {
        $jo_no_validation = false;

        if($this->po_no == ""){
            $this->po_no = null;
        }

        if($this->contact_person == "0"){
            $this->contact_person = null;
        }

        if($this->engine_model == "0"){
            $this->engine_model = null;
        }

        $this->status = 1;
        $this->payment_status_id = 13;
        $paths = [];

        if (!$this->joborderID || $this->change_images) {
            
            foreach(JobOrder::all() as $jo){

                if($jo->jo_no == $this->jo_no){
    
                    $jo_no_validation = true;
                    $action = 'error';
                    $message = 'INVALID: Job Order Number already exist';
                    $this->emit('FlashMessageForJOForm', $action, $message);
                    break;
                }
            }

            $data = $this->validate([
                'reference_no' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'jo_no' => 'required',
                'customer_id' => 'required',
                'contact_person'=>'',
                'po_no' => '',
                'po_date' => 'required',
                'csa' => 'required',
                'engine_model' => '',
                'makelist_id' => '',
                'category' => '',
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
        } else {

            $data = $this->validate([
                'reference_no' => 'required',
                'date' => 'required|date_format:Y-m-d',
                'jo_no' => 'required',
                'customer_id' => 'required',
                'contact_person'=>'',
                'po_no' => '',
                'po_date' => 'required',
                'csa' => 'required',
                'engine_model' => '',
                'makelist_id' => '',
                'category' => '',
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

        if ($jo_no_validation == false) {

            $data['status'] = $this->status;
            $data['payment_status_id'] =  $this->payment_status_id;
            $data['encoder'] = auth()->user()->id;

            if (!$this->joborderID || $this->change_images) {
                if (!empty($this->item_image)) {
                    $images = $this->item_image;
        
                    foreach ($images as $img) {
                        $paths[] = $filenames = 'image_' . time() . $img->getClientOriginalName();
        
                        $img->storeAs('public/images/', $filenames);
                    }
                    $data['item_image'] = $paths;
                }
            } else {
                $data['item_image'] = $this->item_image;
            }


            try {
                if ($this->joborderID) {
                    JobOrder::find($this->joborderID)->update($data);
                    $this->emit('record_updates');
                } else {
                    JobOrder::create($data);
                    $this->emit('created_records', $data);
                }
            } catch (\Exception $e) {
                // dd($e);
                return back();
                $action = 'error';
                $this->emit('flashAction', $action);
            }

            if ($this->joborderID) {
                $action = 'edit';
                $message = 'Job Oder Successfully Updated';
                $this->emit('flashAction', $action, $message);
            } else {
                $action = 'store';
                $message = 'Job Oder Successfully Saved';
                $this->emit('flashAction', $action, $message);
            }

            $this->resetInputFields();
            $this->emit('refreshParent');
            $this->emit('closeJobOrderModal');
            return redirect()->to('/job-order');
        }
        
    }

    public function render()
    {

        // if(is_null($this->date) && is_null($this->po_date) && is_null($this->date_commited) && is_null($this->date_receive)){
        //     $this->date = date("Y-m-d");
        //     $this->po_date = date("Y-m-d");
        //     $this->date_commited = date("Y-m-d");
        //     $this->date_receive = date("Y-m-d");
        // }

        return view('livewire.j-o-m-s.job-order-form', [
            'job_types'=>JobTypes::all()->sortBy('id'),
            'client_profile'=>ClientProfile::all()->sortBy('id'),
            'users'=>User::role('Operator')->get(),
            'engine_models'=>EngineModel::all()->sortBy('id'),
            'engine_categories'=>EngineCategory::all()->sortBy('id'),
            'types_of_payments'=>TypeOfPayment::all()->sortBy('id'),
            'contacts'=>Contact::all(),
        ]);
    }

}