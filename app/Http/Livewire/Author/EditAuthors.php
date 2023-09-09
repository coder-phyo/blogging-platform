<?php

namespace App\Http\Livewire\Author;

use Livewire\Component;

class EditAuthors extends Component
{
    public function editAuthor($author)
    {
        dd($author);
    }

    public function render()
    {
        return view('livewire.author.edit-authors');
    }
}
