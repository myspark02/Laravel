<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserList extends Component
{
    protected $users = '';
    public $active = null;

    protected $listeners = [
        'userSelected' => 'userSelected',
    ];

    public function userSelected($userId) {
        $this->active = $userId;
    }

    public function render()
    {
        if ($this->active == null) {
            $this->active = Auth::user()->id;
        }

        $this->users = User::latest()->paginate(5);
        return view('livewire.user-list', ['users'=>$this->users]);
    }
}
