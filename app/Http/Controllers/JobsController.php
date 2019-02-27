<?php

namespace App\Http\Controllers;

use DB;
use App\Job;
use App\Jobtype;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class JobsController extends Controller
{

    public function index()
    {
        if (Auth::user()->usergroup_id == 3) {
            return redirect('home');
        }
        $data = [
            'jobs' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('completed', 0)
                            ->orderBy('updated_at', 'desc')
                            ->orderBy('jobtype_id')
                            ->orderBy('name')
                            ->get(),
            'beforejobs' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('completed', 0)
                            ->where('jobtype_id', 5)
                            ->orderBy('name')
                            ->get(),
            'atpartyjobs' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('completed', 0)
                            ->where('jobtype_id', 2)
                            ->orderBy('name')
                            ->get(),
            'foodjobs' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('completed', 0)
                            ->where('jobtype_id', 8)
                            ->orderBy('name')
                            ->get(),
            'gamejobs' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('completed', 0)
                            ->where('jobtype_id', 9)
                            ->orderBy('name')
                            ->get(),
            'helpersrequired' => Job::with('users')
                            ->with('jobtype')
                            ->where('completed', 0)
                            ->sum('users_required'),
            'helpercount' => Job::withCount('users')
                            ->where('completed', 0)
                            ->get(),
            'completedjobs' => Job::where('completed', 1)->count(),
            'jobcount' => Job::count(),
            'types' => Jobtype::with('jobs')->get(),
        ];
        return view('jobs.index', $data);
    }

    public function create()
    {
        $data = [
            'types' => Jobtype::all(),
        ];
        return view('jobs.add', $data);
    }

    public function store(Request $request)
    {
        $job = Job::create([
            'name' => $request->name,
            'jobtype_id' => $request->jobtype_id,
            'details' => $request->details,
            'users_required' => $request->users_required,
        ]);
        
        // $job->users()->attach('1');

        $data = [
                'data' => $job,
                'status' => (bool) $job,
            ];

        return redirect('/iamjob');
    }

    public function show($job)
    {
        $data = [
            'job' => Job::with('users')
                            ->with('jobtype')
                            ->with('comments')
                            ->where('id', $job)
                            ->get(),
            'helpersrequired' => Job::with('users')
                            ->with('jobtype')
                            ->where('id', $job)
                            ->sum('users_required'),
            'helpercount' => Job::withCount('users')
                            ->where('id', $job)
                            ->get(),
        ];
        return view('jobs.show', $data);
    }

    public function edit($id)
    {
        $job = Job::find($id);
    }

    public function update($id)
    {
        $job = Job::find($id);

        DB::table('job_user')->insert([
            'job_id' => $id,
            'user_id' => Auth::id() 
        ]);


        // return redirect('/jobs');
        return Redirect::to(URL::previous() . "#j" . $id)->with('signedup', $job->name)->with('job_id', $job->id);
    }

    public function destroy($id)
    {
        $job = Job::find($id);

        DB::table('job_user')
        ->where([
            ['job_id', $id],
            ['user_id', Auth::id()],
        ])
        ->delete();

        return Redirect::to(URL::previous() . "#j" . $id)->with('cancelsignup', $job->name);
    }
}
