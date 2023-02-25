<?php

namespace App\Http\Livewire\Admin\Sponsors;

use App\Models\Sponsor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class SponsorsForm extends Component
{
    use WithFileUploads;

    public Sponsor $sponsor;

    public $image;

    public function mount(Sponsor $sponsor)
    {
        $this->sponsor = $sponsor;
    }
    public function render()
    {
        return view('livewire.admin.sponsors.sponsors-form');
    }

    public function save()
    {
        $this->validate();

        $this->sponsor->save();

        if ($this->image) {
            $previousImagePath = $this->sponsor->image;
            Storage::delete($previousImagePath);

            $this->image->storeAs('images/slides', $this->sponsor->id.'.'.$this->image->extension());
            $this->slide->update(['image' => 'images/slides/'.$this->sponsor->id.'.'.$this->image->extension()]);
        };

        session()->flash('success', 'Sponsor has been created');

        return redirect()->route('admin.sponsors.index');
    }

//    protected $rules = [
//        'sponsor.name' => 'required|unique:sponsors,name|string|max:40',
//        'sponsor.link' => 'required|unique:sponsors,link|url|max:100',
//        'sponsor.image' => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048', // 1MB Max
//        'sponsor.published' => 'nullable',
//    ];

    protected function rules(): array
    {
        return [
            'sponsor.name' => [
                Rule::unique('sponsors', 'name')->ignore($this->sponsor),
                'required',
                'string',
                'max:50'
            ],
            'sponsor.link' => [
                Rule::unique('sponsors', 'link')->ignore($this->sponsor),
                'required',
                'url',
                'max:100'
            ],
            'sponsor.image' => [
                Rule::unique('sponsors', 'image')->ignore($this->sponsor),
                'required',
                'mimes:jpg,jpeg,png,svg,gif',
                'max:100'
            ],
            'sponsor.published' => [
                'nullable'
            ],
        ];
    }
}
