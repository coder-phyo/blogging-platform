<?php

namespace App\Http\Livewire\Author;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddAuthors extends Component
{
    public $name, $email, $role, $password, $confirmPassword;

    protected $listeners = [
        'resetForm'
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8|max:12',
        'confirmPassword' => 'same:password',
        'role' => 'required',
    ];

    public function addAuthors()
    {
        $this->validate();
        $data = $this->getAuthorData();
        User::create($data);
        $this->dispatchBrowserEvent('hide-modal');
        return redirect()->route('author#authorsPage')->with(['createSuccess' => 'Created Author Successfully!']);

    }

    public function resetForm()
    {
        $this->name = $this->email = $this->role = $this->password = $this->confirmPassword = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.author.add-authors');
    }

    // get author data
    private function getAuthorData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => intval($this->role),
            'updated_at' => Carbon::now()
        ];
    }
}
