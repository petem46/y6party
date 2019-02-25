<?php

namespace App\Http\Controllers;

use App\Job;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Job $job)
    {
        $job->addComment(request('comment'));
        $job_id = $job->id;
        $url = '/iamjob#j' . $job_id;
        // print_r($url);

        // return(compact('$job_id'));
        return Redirect::to(URL::previous() . "#j" . $job->id)->with('job_id', $job_id)->with('commentadded', 'Your comment has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $job_id = $comment->job_id;
        $comment->delete();

        $url = '/iamjob#j' . $job_id;
        // print_r($url);

        // return(compact('$job_id'));
        return Redirect::to(URL::previous() . "#j" . $job_id)->with('job_id', $job_id)->with('commentdeleted', 'Your comment has been deleted.');
    }
}
