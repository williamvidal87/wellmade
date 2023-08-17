<?php

namespace App\Http\Livewire\JOMS;

use App\Models\JobOrder;
use App\Models\UnlockAccessReason;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UnlockAccessForm extends Component
{

    protected $listeners = [
        'setUnlockAccessUser',
    ];

    public $reasons, $password, $jo_no_id;

    public function setUnlockAccessUser($id)
    {
        $this->jo_no_id = $id;
    }

    public function resetInputFields()
    {
        $this->reset();
    }

    public function store()
    {
        $data = $this->validate([
            'reasons' => 'required',
        ]);

        $data['user_id'] = Auth::id();
        if($this->jo_no_id){
            $data['jo_no_id'] = $this->jo_no_id;
        }

        try {
            $user = User::where('id', $data['user_id'])->first();

            if(Hash::check($this->password, $user->password)){
                UnlockAccessReason::create($data);

                JobOrder::where('id', $this->jo_no_id)->update([
                    'printed_incentive' => 0
                ]);
            }else{
                // Incorrect password
                Session::flash('incorrectPassword', 'Incorrect Password!');
                return url()->previous();
            }
            
        } catch (\Exception $e) {
            dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if (Hash::check($this->password, $user->password)) {
            $action = 'store';
            $message = 'Unlock Successfully';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeUnlockAccessModal');
        redirect()->to('/job-order-incentives');
    }

    public function render()
    {
        return view('livewire.j-o-m-s.unlock-access-form');
    }
}
