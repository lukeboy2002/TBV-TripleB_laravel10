<?php

namespace App\Http\Livewire\Admin\Sponsors;

use App\Models\Sponsor;
use Livewire\Component;
use Livewire\WithFileUploads;

class SponsorsAdd extends Component
{
    use WithFileUploads;

    public Sponsor $sponsor;

    public $name;

    public $link;

    public $image;

    public $published;

    protected $rules = [
        'name' => 'required|unique:sponsors,name|string|max:40',
        'link' => 'required|unique:sponsors,link|url|max:100',
        'image' => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048', // 1MB Max
        'published' => 'nullable',
    ];

    public function mount(Sponsor $sponsor)
    {
        $this->sponsor = $sponsor ?? new Sponsor();
    }
    public function render()
    {
        return view('livewire.admin.sponsors.sponsors-add');
    }

    public function save()
    {
        $this->validate();

        $slide = Sponsor::create([
            'name' => $this->name,
            'link' => $this->link,
            'published' => $this->published,
        ]);

        $this->image->storeAs('sponsors', $slide->id.'.'.$this->image->extension());

        $slide->update(['image' => 'sponsors/'.$slide->id.'.'.$this->image->extension()]);

        session()->flash('success', 'Sponsor has been created');

        return redirect()->route('admin.sponsors.index');
    }
}
