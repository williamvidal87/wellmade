<?php

namespace App\Http\Livewire\Engine;

use Livewire\Component;
use App\Models\CategoryList;

class CategoryListTable extends Component
{
    public $categoryId;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'deleteCategoryList',
    ];

    public function render()
    {
        $categories = CategoryList::with('getTypes')->get();
        return view('livewire.engine.category-list-table')->with('categories',$categories);
    }

    public function createCategoryList(){
        $this->emit('resetInputFields');
        $this->emit('openCategoryListModal');
       
    }

    
    public function editCategoryList($categoryId){        
        $this->categoryId = $categoryId;
        $this->emit('categoryId',$this->categoryId);
        $this->emit('openCategoryListModal');
    }

    public function deleteConfirmCategoryList($categoryId)
    {
        $this->dispatchBrowserEvent('swal:confirmCategoryListDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $categoryId
        ]);
    }

    public function deleteCategoryList($categoryId)
    {
        // dd($clientTypeId);
        CategoryList::destroy($categoryId);
        $this->reset();
    }
}
