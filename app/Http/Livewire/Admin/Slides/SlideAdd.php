<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Livewire\Component;
use Livewire\WithFileUploads;

class SlideAdd extends Component
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
        'image' => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048', // 1MB Max
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
        $this->slide = $slide ?? new Slide();
    }

    public function render()
    {
        return view('livewire.admin.slides.slide-add');
    }

    public function save()
    {
        $this->validate();

        $slide = Slide::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'status' => $this->status,
        ]);

        $this->image->storeAs('slides/', $slide->id.'.'.$this->image->extension());

        $slide->update(['image' => 'slides/'.$slide->id.'.'.$this->image->extension()]);

        session()->flash('success', 'Slides has been created');

        return redirect()->route('admin.slides.index');
    }
}
