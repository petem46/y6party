<?php

namespace App\Http\Controllers;

use DB;
use App\Song;
use App\Kid;
use App\Vote;
use App\User;
use App\KidUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class SongsController extends Controller
{
  public function index()
  {
    if(Auth::user()->usergroup_id == 3) {
      $mykid = Kid::where('id', Auth::id())->first();
      $mykid = $mykid['id'];
    }
    else {
      $mykid = KidUser::where('user_id', Auth::id())->first();
      $mykid = $mykid->kid_id;
    }
    $data = [
      'mysongcount' =>  Kid::select('id')->withCount('songs')->where('id', $mykid)->get(),
      'songs'       =>  Song::with('kid')->withCount('votes')->orderBy('votes_count', 'desc')->orderBy('created_at')->get(),
      'songcount'   =>  Song::get()->count(),
      'artistcount' =>  Song::select('artist')->groupBy('artist')->get()->count(),
      'votecount'   =>  Vote::get()->count(),
      'mygroupid'   =>  Auth::user()->usergroup_id,
      'kid'         =>  $mykid,
    ];
    
    return view('songs.index', $data);
  }
  
  public function search()
  {
    return view('songs.searchform');
  }
  
  public function songsearch(Request $request)
  {
    // return $request->all();
    $client = new Client(); //GuzzleHttp\Client
    $result = $client->request('GET', 'https://itunes.apple.com/search', [
      'query' => [
        'term' => $request->artist . ' ' . $request->track,
        'country' => 'GB',
        'media' => 'music',
        'limit' => '6',
        'explicit' => 'No', 
      ],
      // 'debug' => true,
    ]);    
    $response = $result->getBody()->getContents();
    $response = json_decode($response);

    if(Auth::user()->usergroup_id == 3) {
      $data = [
        'kids' => Kid::where('id', Auth::id())->get(),
      ];
    }
    else {
      $data = [
        'kids' => Auth::user()->kids()->with('songs')->get(),
      ];
    }

    return view('songs.searchresults', $data, compact('response', 'response'));
    
  }

  public function create()
  {
    if(Auth::user()->usergroup_id == 3) {
      $data = [
        'kids' => Kid::where('id', Auth::id())->get(),
      ];
    }
    else {
      $data = [
        'kids' => Auth::user()->kids()->with('songs')->get(),
      ];
    }
    return view('songs.add', $data, compact('response', 'response1'));
  }
  
  public function store(Request $request)
  {
    try 
    {
      $song = Song::create([
        'artist' => $request->artist,
        'songname' => $request->songname,
        'kid_id' => $request->kid_id,
        'artist_track' => strtoupper($request->artist) . "_" .  strtoupper($request->songname),
        ]);          
      } 
      catch(\Illuminate\Database\QueryException $e) 
      {
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062')
        {
          // dd('Duplicate Entry');
          return redirect('/playlist')->with('messageDuplicateSong', 'Duplicate song! The track you submitted, `' . $request->artist . ' - ' . $request->songname . '`, is already in the playlist.');
        }
      }          
      
      $data = [
        'data' => $song,
        'status' => (bool) $song,
        'message' => $song ? 'Song choice saved' : 'Error saving song choice',
      ];
      
      return redirect('/playlist')->with('messageSongAdded', 'Your track, `' . $request->artist . ' - ' . $request->songname . '`, has been added to the playlist.');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Songs  $songs
    * @return \Illuminate\Http\Response
    */
    public function show(Songs $songs)
    {
      //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Songs  $songs
    * @return \Illuminate\Http\Response
    */
    public function edit(Songs $songs)
    {
      //
    }
    
    public function update($id)
    {
      if(Auth::user()->usergroup_id == 3) {
        $kid = Kid::where('id', Auth::id())->first();
        $kid = $kid['id'];
      }
      else {
        $kid = Auth::user()->kids()->first();
        $kid = $kid->id;
      }
      try 
      {
        DB::table('votes')->insert([
          'song_id' => $id,
          'kid_id' => $kid,
          'songkid' => $id . '-' . $kid,
          ]);
        }
        catch(\Illuminate\Database\QueryException $e) 
        {
          $errorCode = $e->errorInfo[1];
          if($errorCode == '1062')
          {
            DB::table('votes')
            ->where([
                ['song_id', $id],
                ['kid_id', $kid->id],
                ['songkid', $id . '-' . $kid->id],
            ])
            ->delete();
           
            // return redirect('/playlist')->with('messageDuplicateVote', 'Duplicate vote, you have already voted for this track!');
            return Redirect::to(URL::previous() . "#song" . $id)->with('messageDuplicateVote', 'Your vote has been removed!');
          }
        }         
        return Redirect::to(URL::previous() . "#song" . $id)->with('messageVoted', 'Your vote has been counted! Thanks!');
      }
      
      /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Songs  $songs
      * @return \Illuminate\Http\Response
      */
      public function destroy($id)
      {
        DB::table('songs')->where('id', $id)->delete();
        DB::table('votes')->where('song_id', $id)->delete();

        return Redirect::to(URL::previous())->with('messageSongDeleted', 'Your song choice has been deleted! All votes for this song have also been deleted!');
      }
    }
    