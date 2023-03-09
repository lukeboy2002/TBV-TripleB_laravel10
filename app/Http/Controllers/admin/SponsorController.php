<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sponsors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newFilename = Str::after($request->input('image'), 'tmp/');
        Storage::disk('public')->move($request->input('image'), "sponsors/$newFilename");

        Sponsor::create(array_merge($this->validateSponsor(), [
            'image' => "sponsors/$newFilename"
        ]));

        $request->session()->flash('success', 'Sponsor succesfully added');

        return redirect()->route('admin.sponsors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', [
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        if (str()->afterLast($request->input('image'), '/') !== str()->afterLast($sponsor->image, '/')) {
            Storage::disk('public')->delete($sponsor->image);
            $newFilename = Str::after($request->input('image'), 'tmp/');
            Storage::disk('public')->move($request->input('image'), "images/$newFilename");
        }

        $attributes = (array_merge($this->validateSponsor($sponsor), [
            'image' => isset($newFilename) ? "images/$newFilename" : $sponsor->image
        ]));

        $sponsor->update($attributes);

        $request->session()->flash('success', 'Sponsor succesfully changed');

        return redirect()->route('admin.sponsors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validateSponsor(?Sponsor $sponsor = null): array
    {
        $sponsor ??= new Sponsor();

        return request()->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sponsors', 'name')->ignore($sponsor)
//                Rule::unique('sponsors')->ignore($sponsor->id)
            ],
            'link' => [
                'required',
                'url',
                'max:255',
                Rule::unique('sponsors', 'link')->ignore($sponsor)

//                Rule::unique('sponsors')->ignore($sponsor->id)
            ],
            'published' => [
                'nullable'
            ],
        ]);
    }

//    public function uploadsponsor(Request $request)
//    {
//        if ($request->file('image')) {
//            $path = $request->file('image')->store('tmp', 'public');
//        }
//
//        return $path;
//    }
//
//    public function revertsponsor(Request $request)
//    {
//        Storage::disk('public')->delete($request->getContent());
//    }
}
