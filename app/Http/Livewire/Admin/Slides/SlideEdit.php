<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SlideEdit extends Component
{
    use WithFileUploads;

    public Slide $slide;

    public $title;

    public $subtitle;

    public $image;

    public $status;

    protected $rules = [
        'title' => 'required|string|max:40',
        'subtitle' => 'required|string|max:100',
        'image' => 'nullable|mimes:jpg,jpeg,png,svg,gif|max:2048', // 1MB Max
        'status' => 'nullable',
    ];

    protected $messages = [
        'title.max' => 'The title may not be greater than 40 characters',
        'subtitle.max' => 'The subtitle may not be greater than 100 characters',
    ];

    public function updatedTitle()
    {
        $this->validateOnly('title');
    }

    public function updatedSubtitle()
    {
        $this->validateOnly('subtitle');
    }

    public function mount(Slide $slide)
    {
        $this->title = $slide->title;
        $this->subtitle = $slide->subtitle;
        $this->status = $slide->status;
    }

    public function render()
    {
        return view('livewire.admin.slides.slide-edit');
    }

    public function save()
    {
        $this->validate();

        $this->slide->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $previousImagePath = $this->slide->image;
            Storage::delete($previousImagePath);

            $this->image->storeAs('slides', $this->slide->id.'.'.$this->image->extension());
            $this->slide->update(['image' => 'slides/'.$this->slide->id.'.'.$this->image->extension()]);
        }

        session()->flash('success', 'Slides has been changed');

        return redirect()->route('admin.slides.index');
    }
}
