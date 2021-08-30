<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        [

            'body' => '동해물과 백두산이 마르고 닳도록 하느님이 보우하사 우리나라 만세, 무궁화 삼천리 화려강산 대한사람 대한으로 길이 보전하세',
            'created_at' => '3 min ago',
            'creator' => 'scpark'


        ]
    ];

    public $newComment;

    public function addComment()
    {
        array_unshift($this->comments,  [

            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'gdhong'


        ]);

        $this->newComment = '';
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
