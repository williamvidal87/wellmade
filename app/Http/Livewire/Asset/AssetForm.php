<?php

namespace App\Http\Livewire\Asset;

use App\Models\AssignMachineSubgroup;
use App\Models\MachineBrandName;
use App\Models\MachineConditionAquired;
use App\Models\MachineCostCenter;
use App\Models\MachineCountryMade;
use App\Models\MachineDepreciation;
use App\Models\MachineDeptLocation;
use App\Models\MachineDescription;
use App\Models\MachineGroup;
use App\Models\MachineModelName;
use App\Models\MachinePlantAssigned;
use App\Models\MachinePurchaseFrom;
use App\Models\MachinePurchaseType;
use App\Models\Machines;
use App\Models\MachineStatus;
use App\Models\MachineUnit;
use App\Models\YearMade;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssetForm extends Component
{
    use WithFileUploads;
    public  $machine_description_id,
            $machine_group_id,
            $machine_sub_group_id,
            $serial,
            $machine_brand_id,
            $machine_model_id,
            $machine_plant_assigned_id,
            $machine_dept_location_id,
            $machine_cost_center_id,
            $machine_status_id,
            $photo,
            $machine_purchase_from_id,
            $machine_purchase_type_id,
            $machine_year_made_id,
            $machine_country_made_id,
            $arrival_date,
            $machine_condition_aquired_id,
            $machine_depreciation_id,
            $capacity,
            $machine_unit_id,
            $total_motor,
            $landed_cost,
            $rehab_cost,
            $machineID,
            $change_images=false, $isUploaded = false, $item_image = [];
    public $action = '';
    public $message = '';
    
    protected $listeners = [
        'machineID',
        'resetInputFields'
    ];
    
    public function resetInputFields(){
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    
    public function updated($propertyItemImage)
    {

        $this->validateOnly($propertyItemImage, [
            'item_image.*' => 'image|max:2000', // 1MB Max
        ]);
    }
    
    public function machineID($machineID){  //FOR EDIT 
        $this->machineID = $machineID;
        $machine_data = Machines::find($machineID);
        $this->machine_description_id       =   $machine_data->machine_description_id;
        $this->machine_group_id             =   $machine_data->machine_group_id;
        $this->machine_sub_group_id         =   $machine_data->machine_sub_group_id;
        $this->serial                       =   $machine_data->serial;
        $this->machine_brand_id             =   $machine_data->machine_brand_id;
        $this->machine_model_id             =   $machine_data->machine_model_id;
        $this->machine_plant_assigned_id    =   $machine_data->machine_plant_assigned_id;
        $this->machine_dept_location_id     =   $machine_data->machine_dept_location_id;
        $this->machine_cost_center_id       =   $machine_data->machine_cost_center_id;
        $this->machine_status_id            =   $machine_data->machine_status_id;
        $this->photo                        =   $machine_data->photo;
        $this->machine_purchase_from_id     =   $machine_data->machine_purchase_from_id;
        $this->machine_purchase_type_id     =   $machine_data->machine_purchase_type_id;
        $this->machine_year_made_id         =   $machine_data->machine_year_made_id;
        $this->machine_country_made_id      =   $machine_data->machine_country_made_id;
        $this->arrival_date                 =   $machine_data->arrival_date;
        $this->machine_condition_aquired_id =   $machine_data->machine_condition_aquired_id;
        $this->machine_depreciation_id      =   $machine_data->machine_depreciation_id;
        $this->capacity                     =   $machine_data->capacity;
        $this->machine_unit_id              =   $machine_data->machine_unit_id;
        $this->total_motor                  =   $machine_data->total_motor;
        $this->landed_cost                  =   $machine_data->landed_cost;
        $this->rehab_cost                   =   $machine_data->rehab_cost;
        $this->item_image                   =   $machine_data->item_image;
    }
    
    public function updatedItemImage(){
        if($this->machineID){
            $this->change_images = true;
        }

        $this->isUploaded=true;
    }
    
    public function render()
    {
        $MachineGroup = MachineGroup::select('id','machine_group_category_id','machine_group_number_id','machine_group_name')->with('getMachineGroupCategory','getMachineGroupIdNumber')->get();
        $MachineSubGroup = AssignMachineSubgroup::select('id','machine_sub_group_id','machine_group_id')->with('getMachineSubGroup')->get();
        return view('livewire.asset.asset-form',[
            'MachineDescription' => MachineDescription::all('id','description'),
            'model_name' => MachineModelName::all('id','machine_model_name'),
            'machine_plant_assigned' => MachinePlantAssigned::all('id','machine_plant_assigned_name'),
            'machine_dept_location' => MachineDeptLocation::all('id','machine_dept_location_name'),
            'machine_cost_center' => MachineCostCenter::all('id','machine_cost_center_name'),
            'machine_status' => MachineStatus::all('id','machine_status'),
            'machine_brand' => MachineBrandName::all('id','brand_name'),
            'machine_purchased_from' => MachinePurchaseFrom::all('id','machine_purchase_from_name'),
            'machine_purchased_type' => MachinePurchaseType::all('id','machine_purchase_type_name'),
            'year_made' => YearMade::all('id','year_made'),
            'machine_country_made' => MachineCountryMade::all('id','machine_country_made_name'),
            'machine_condition_aquired' => MachineConditionAquired::all('id','machine_condition_acquired_name'),
            'machine_depreciation' => MachineDepreciation::all('id','machine_depreciation_number'),
            'machine_unit' => MachineUnit::all('id','machine_unit_name')
        ])  ->with('MachineGroup',$MachineGroup)
            ->with('MachineSubGroup',$MachineSubGroup);
    }
    public function store(){
        
        if(!$this->machineID || $this->change_images){
            $data = $this->validate([
                'machine_description_id'        =>  'required',
                'machine_group_id'              =>  'required',
                'machine_sub_group_id'          =>  '',
                'serial'                        =>  '',
                'machine_brand_id'              =>  '',
                'machine_model_id'              =>  '',
                'machine_plant_assigned_id'     =>  '',
                'machine_dept_location_id'      =>  '',
                'machine_cost_center_id'        =>  '',
                'machine_status_id'             =>  '',
                'item_image.*'                  =>  'image|max:2000', // 2MB Max
                'machine_purchase_from_id'      =>  '',
                'machine_purchase_type_id'      =>  '',
                'machine_year_made_id'          =>  '',
                'machine_country_made_id'       =>  '',
                'arrival_date'                  =>  '',
                'machine_condition_aquired_id'  =>  '',
                'machine_depreciation_id'       =>  '',
                'capacity'                      =>  '',
                'machine_unit_id'               =>  '',
                'total_motor'                   =>  '',
                'landed_cost'                   =>  '',
                'rehab_cost'                    =>  '',
    
            ]);
        }else{
            $data = $this->validate([
                'machine_description_id'        =>  'required',
                'machine_group_id'              =>  'required',
                'machine_sub_group_id'          =>  '',
                'serial'                        =>  '',
                'machine_brand_id'              =>  '',
                'machine_model_id'              =>  '',
                'machine_plant_assigned_id'     =>  '',
                'machine_dept_location_id'      =>  '',
                'machine_cost_center_id'        =>  '',
                'machine_status_id'             =>  '',
                'machine_purchase_from_id'      =>  '',
                'machine_purchase_type_id'      =>  '',
                'machine_year_made_id'          =>  '',
                'machine_country_made_id'       =>  '',
                'arrival_date'                  =>  '',
                'machine_condition_aquired_id'  =>  '',
                'machine_depreciation_id'       =>  '',
                'capacity'                      =>  '',
                'machine_unit_id'               =>  '',
                'total_motor'                   =>  '',
                'landed_cost'                   =>  '',
                'rehab_cost'                    =>  '',
            ]);
        }
        
        if(!$this->machineID || $this->change_images){
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

        try
		{
            if($this->machineID){
                Machines::find($this->machineID)->update($data);
            }else{
                Machines::create($data);
            }

		} catch (\Exception $e) {
			dd($e);
			return back();
            $action = 'error';
            $this->emit('flashAction',$action,$data);
		}

        if($this->machineID){
            $action = 'edit';
            $message = 'Asset Successfully Updated';
            // dd($action);
            $this->emit('flashAction',$action,$message);
        }
        else{
            $action = 'store';
            $message = 'Asset Successfully Saved';
            // dd($action);
            $this->emit('flashAction',$action,$message);
            
        }
        
        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeAssetModal');
    }
}
