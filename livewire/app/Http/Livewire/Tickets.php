<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tickets extends Component
{
    public $active;

    public $userId ;
    protected $listeners = ['ticketSelected', 'userSelected'];

    public function userSelected($userId) {
        $this->userId = $userId;
        $this->emit('ticketSelected', null);
    }


    public function ticketSelected($ticketId)
    {
        $this->active = $ticketId;
    }

    public function render()
    {
        if(!$this->userId) {
            $this->userId = Auth::user()->id;
        }

        return view('livewire.tickets', ['tickets' => SupportTicket::whereUserId($this->userId)->latest()->paginate(5)]);
    }
}
