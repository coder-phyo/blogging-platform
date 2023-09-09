<?php

namespace App\Http\Livewire\Author;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;

    protected $listeners = [
        'resetForm'
    ];

    protected $rules = [
        'category_name' => 'required'
    ];

    public function addCategory()
    {
        $this->validate();
        Category::create([
            'category_name' => $this->category_name
        ]);
        $this->dispatchBrowserEvent('hide-modal');
        return redirect()->route('author#categoryPage')->with(['createSuccess' => 'Category has been Successfully Created!']);
    }

    public function editCategory($id)
    {
        $category = Category::where('category_id',$id)->first();
        $this->selected_category_id = $category->category_id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate();
            Category::where('category_id',$this->selected_category_id)->update([
                'category_name' => $this->category_name
            ]);
            $this->dispatchBrowserEvent('hide-modal');
            $this->updateCategoryMode = false;
            return redirect()->route('author#categoryPage')->with(['updateSuccess' => 'Category has been Successfully Updated!']);
        };
    }

    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();
        return redirect()->route('author#categoryPage')->with(['deleteSuccess' => 'Category has been Successfully Deleted!']);
    }

    public function resetForm()
    {
        $this->category_name = $this->selected_category_id = null;
        $this->updateCategoryMode = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.author.categories',[
            'categories' => Category::orderBy('updated_at','desc')->get()
        ]);
    }
}
