<?php

namespace App\Http\Livewire\Author;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_pass, $new_pass, $confirm_new_pass;

    protected $rules = [
        'current_pass' => 'required',
        'new_pass' => 'required|min:8|max:12',
        'confirm_new_pass' => 'same:new_pass',
    ];

    public function changePassword()
    {
        $this->validate();
        if (Hash::check($this->current_pass, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($this->new_pass)]);
            session()->flash('passwordUpdatedSuccess', 'Your password has been succefully updated!');

            $this->current_pass = $this->new_pass = $this->confirm_new_pass = null;
        } else {
            session()->flash('fail', 'The current password is incorrect');
        }
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {
        return view('livewire.author.change-password');
    }
}
