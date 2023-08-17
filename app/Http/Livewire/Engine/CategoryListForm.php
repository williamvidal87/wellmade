<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\CategoryList;
use App\Models\MakeList;
use App\Models\Type;

class CategoryListForm extends Component
{
    public $categoryId, $category, $type_id, $action, $message;

    protected $listeners = [
        'categoryId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
    }


    public function categoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        $lists = CategoryList::find($categoryId);
        $this->category = $lists->category;
        $this->type_id = $lists->type_id;
    }

    public function render()
    {
        return view('livewire.engine.category-list-form',[
            'types'      => Type::all(),
        ]);
    }

    public function store()
    {

        $data = $this->validate([
            'category' => 'required',
        ]);
        // dd($data);
        try {
            if ($this->categoryId) {
                CategoryList::find($this->categoryId)->update($data);
            } else {
                // dd($data);
                CategoryList::create($data);
            }
        } catch (\Exception $e) {
            // dd($e);
            return back();
            $action = 'error';
            $this->emit('flashAction', $action);
        }

        if ($this->categoryId) {
            $action = 'edit';
            $message = 'Category List Successfully Updated';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        } else {
            $action = 'store';
            $message = 'Category List Successfully Saved';
            // dd($action);
            $this->emit('flashAction', $action, $message);
        }

        $this->resetInputFields();
        $this->emit('refreshParent');
        $this->emit('closeCategoryListModal');
    }
}
