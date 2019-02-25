<?php

namespace App\Http\Controllers;

use App\Kid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KidsController extends Controller
{
    
    protected $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kids' => Kid::with('users')->orderBy('kidname')->get(),
        ];
        return view('kids.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kids.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $kid = Kid::create([
        'kidname' => $request->kidname,
        'hoodiename' => $request->hoodiename,
    ]);
    
    $data = [
            'data' => $kid,
            'status' => (bool) $kid,
            'message' => $kid ? 'Kid saved' : 'Error saving kid',
        ];

    return redirect('/kids');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kids  $kids
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kids  $kids
     * @return \Illuminate\Http\Response
     */
    public function edit(Kids $kids)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kids  $kids
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kids $kids)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kids  $kids
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kids $kids)
    {
        //
    }
}
