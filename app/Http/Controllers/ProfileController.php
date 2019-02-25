<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Kid;
use App\Song;
use App\User;
use App\Vote;
class ProfileController extends Controller
{
    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        // $request->user() returns an instance of the authenticated user...
    }

    public function show()
    {
        if (Auth::user()->usergroup_id == 3) {
            $mykid = Kid::where('id', Auth::id())->first();
            $mykid = $mykid['id'];

            $data = [
            'mysongcount' =>  Kid::select('id')->withCount('songs')->where('id', $mykid)->get(),
            'songs' =>  Song::where('kid_id', Auth::id())->get(),
            'songcount'   =>  Song::get()->count(),
            'artistcount' =>  Song::select('artist')->groupBy('artist')->get()->count(),
            'votecount'   =>  Vote::get()->count(),
            'kid'         =>  $mykid,
            'mygroupid'   =>  Auth::user()->usergroup_id,
            ];
        }
        if (Auth::user()->usergroup_id < 3) {
            $data = [
                'user' => Auth::user()->kids()->with('songs')->get(),
                'jobs' => Auth::user()->jobs()->with('users')->get(),
                'jobcount' =>Auth::user()->jobs()->with('users')->count(),
                'allkids' => Kid::with('users')->orderBy('kidname')->get(),
            ];
        }

        // dd($data);

        return view('profile', $data);
        
    }
}