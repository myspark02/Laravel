<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class EditComment extends ModalComponent
{

    use WithFileUploads;

    public $commentId;
    public $newComment;
    public $image;
    public $orgComment;

    protected $listeners = [
        'update' => 'updateComment',
        'closeMyModal' => 'closeMyModal',
    ];

    public function closeMyModal() {
        $this->closeModal();
    }

    public function updatedImage($image) {
        $this->validate(['image' => 'image']);
        if($this->getErrorBag()->get('image')) {
            $this->image = null;
        }
    }

    public function updateComment() {

        $this->validate(['newComment' => 'required|max:255']);

        $this->orgComment->body = $this->newComment;
        if ($this->image) {
            $imageFileName = $this->storeImage();
            $this->orgComment->image = $imageFileName;
        }

        $this->orgComment->save();


        $this->commentId = '';
        $this->image = '';
        $this->newComment = '';

        session()->flash('message', 'Comment updated successfully');
        $this->closeModal();
    }

    public function storeImage() {
        if (!$this->image) return null;

        //원본 데이터의 이미지를 파일시스템에서 삭제
        if ($this->orgComment == null) {
            $this->orgComment = Comment::find($this->commentId);
        }
        if($this->orgComment->image) {
            Storage::disk('public')->delete('images/'.$this->orgComment->image);
        }

        // 새로운 이미지를 파일시스템에 저장
        ImageManagerStatic::make($this->image)->encode('jpg');
        $name =  Str::random() . '.jpg';

        $this->image->storeAs('public/images', $name);

        return $name;

    }

    public function mount($commentId) {
        $this->commentId = $commentId;
        $this->orgComment = Comment::find($commentId);
        $this->newComment = $this->orgComment->body;
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
