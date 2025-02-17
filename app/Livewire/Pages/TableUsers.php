<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class TableUsers extends Component
{


    public function mount()
    {

    }
    #[On('echo-private:register-channel,RegisterEvent')]
    public function render()
    {
        $users =User::query()->paginate(10);
        return view('livewire.pages.table-users', compact('users'));
    }
}
