<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function trashed()
    {
        //
    }

    public function trashedRestore(Request $request, $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        $request->session()->flash('success', 'User has been restored');

        return back();
    }

    public function trashedDelete(Request $request, $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        $request->session()->flash('success', 'User has been completed deleted');

        return back();
    }

//    public function userOnlineStatus()
//    {
//        $users = User::all();
//        foreach ($users as $user) {
//            if (Cache::has('user-is-online-'.$user->id)) {
//                echo $user->name.' is online. Last seen: '.Carbon::parse($user->last_seen)->diffForHumans().' <br>';
//            } else {
//                echo $user->name.' is offline. Last seen: '.Carbon::parse($user->last_seen)->diffForHumans().' <br>';
//            }
//        }
//    }
}
