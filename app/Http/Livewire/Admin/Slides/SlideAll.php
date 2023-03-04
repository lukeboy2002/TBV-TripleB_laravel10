<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class SlideAll extends Component
{
    use WithPagination;

    public $showModal = false;

    public $search;

    public $sortField;

    public $sortAsc = true;

    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.slides.slide-all', [
            'slides' => Slide::orderby('status')
                ->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('subtitle', 'like', '%' . $this->search . '%');
                })
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })
                ->paginate(10),
        ]);
    }

    public function deleteId($id)
    {
        $this->showModal = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        $slide = Slide::find($this->deleteId);
        $image = $slide->image;

        Storage::delete($image);
        $slide->delete();

        $this->showModal = false;

        session()->flash('success', 'Slide deleted successfully!');
    }

    public function close()
    {
        $this->showModal = false;
    }
}
