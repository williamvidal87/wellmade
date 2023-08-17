<?php

namespace App\Http\Livewire\UMS;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;


class UserProfileForm extends Component
{
    public $name, $address, $contact_no, $email, $emergency_contact_person, $emergency_contact_address, $emergency_contact_no, $username, $password, $password_confirmation, $userProfileId;
    public $roleCheck = array();
    public $selectedRoles = [];

    public $action = '';
    public $message = '';

    protected $listeners = [
        'userProfileId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    //edit
    public function userProfileId($userProfileId)
    {
        $this->userProfileId = $userProfileId;
        $userProfile = User::find($userProfileId);
        $this->name = $userProfile->name;
        $this->address = $userProfile->address;
        $this->contact_no = $userProfile->contact_no;
        $this->email = $userProfile->email;
        $this->emergency_contact_person = $userProfile->emergency_contact_person;
        $this->emergency_contact_address = $userProfile->emergency_contact_address;
        $this->emergency_contact_no = $userProfile->emergency_contact_no;
        $this->username = $userProfile->username;
        $this->selectedRoles = $userProfile;
        // $this->selectedRoles = $this->selectedRoles->getRoleNames();
        $this->selectedRoles = json_decode(json_encode($this->selectedRoles->getRoleNames()), true);
        // $this->editRole = $userProfile->getRoleNames();
        // Fetch data into the roles which the userId ive got
    }

    function in_array_any($needles, $haystack) {
        return !empty(array_intersect($needles, $haystack));
    }


    public function store()
    {
        if(is_object($this->selectedRoles)){
            $this->selectedRoles = json_decode(json_encode($this->selectedRoles), true);
        }

        if(empty($this->roleCheck)){
            $this->roleCheck = array_map('strval', $this->selectedRoles);
        }

        $rules = [
            'name' => ['required', Rule::unique('users', 'name')->ignore($this->userProfileId)],
            'address' => 'nullable',
            'contact_no' => 'nullable',
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($this->userProfileId)],
            'emergency_contact_person' => 'nullable',
            'emergency_contact_address' => 'nullable',
            'emergency_contact_no' => 'nullable',
            'username' => ['required', Rule::unique('users', 'username')->ignore($this->userProfileId)],
        ];

        $roles = [];
        $userrole = auth()->user()->roles;

        foreach ($userrole as $key => $value) {
            $roles[] = $value->name;
        }

        if (!$this->userProfileId || ($this->password != null && $this->password_confirmation != null && $this->in_array_any(["Super Admin", "Admin"], $roles)) ) {
            $rules['password'] = 'required|same:password_confirmation|min:6';
            $rules['password_confirmation'] = 'required';
        }

        $data = $this->validate($rules);


        try {
            if ($this->userProfileId) {
                if($this->password != null && $this->password_confirmation != null && $this->in_array_any(["Super Admin", "Admin"], $roles)){
                    $data['password'] = Hash::make($this->password);
                }
                $user = User::find($this->userProfileId);
                $user->update($data);

                $user->syncRoles($this->roleCheck);
            } else {
                $data['password'] = Hash::make($this->password);
                $user = User::create($data);

                $user->assignRole($this->roleCheck);
                
            }
        } catch (\Exception $e) {
            return back();
            $action = 'error';
        }

        if ($this->userProfileId) {
            $action = 'edit';
            $message = 'User Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'User Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeUserProfileModal');
        return redirect()->to('/user-profile');
    }

    public function render()
    {
        return view('livewire.u-m-s.user-profile-form', [
            'roles' => Role::all()
        ]);
    }
}
