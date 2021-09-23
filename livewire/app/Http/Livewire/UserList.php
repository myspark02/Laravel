<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
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
