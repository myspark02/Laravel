<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    // public $comments ;  // Livewire에서 collection 타입은 public 프로퍼티로 사용할 수 없다.

    public $newComment;
    public $image;
    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'delete' => 'remove',
        'ticketSelected' => 'ticketSelected'
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        // dd($imageData);
        $this->image = $imageData;
    }

    // public function mount($comments)
    // {
    //     $this->comments = $comments;
    // }

    public function addComment()
    {
        if (!auth()->user()) {
            return redirect()->to('login');
        }

        $this->validate(['newComment' => 'required|max:255']);

        $image = $this->storeImage();
        $comment = Comment::create([
            'body' => $this->newComment,
            'image' => $image,
            'user_id' => auth()->user()->id,
            'support_ticket_id' => $this->ticketId,
        ]);

        // dd($comment);

        // $this->comments->prepend($comment);

        $this->image = '';
        $this->newComment = '';
        session()->flash('message', 'Comment created successfully');
    }

    public function storeImage()
    {
        if (!$this->image) return null;

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = '/images/' . Str::random() . '.jpg';

        Storage::disk('public')->put($name, $img);

        return $name;
    }

    public function remove($id)
    {
        $comment = Comment::find($id);

        Storage::disk('public')->delete($comment->image);

        $comment->delete();

        // $this->comments = $this->comments->where('id', '!=', $id);
        // $this->comments = $this->comments->except($id);
        session()->flash('message', 'Comment deleted successfully');
    }

    // custom pagination page
    public function paginationView()
    {
        return 'livewire.pagination-links';
    }

    public function render()
    {
        // return view('livewire.comments', ['comments'=>Comment::latest()->paginate(2)]);
        return view('livewire.comments', ['comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)]);
    }
}