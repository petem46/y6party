<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'settings' => Setting::first(),
        ];
        return view('settings.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('settings.edit', compact('setting', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sitename'      =>  'required',
            'partydate'     =>  'required',
            'starttime'     =>  'required',
            'endtime'       =>  'required',
            'venuename'     =>  'required',
            'venuelocation' =>  'required',
            'venuemapurl'   =>  'required'
        ]);
        $setting = Setting::find($id);
        $setting->sitename = $request->get('sitename');
        $setting->partydate = $request->get('partydate');
        $setting->starttime = $request->get('starttime');
        $setting->endtime = $request->get('endtime');
        $setting->venuename = $request->get('venuename');
        $setting->venuelocation = $request->get('venuelocation');
        $setting->venuemapurl = $request->get('venuemapurl');
        $setting->save();
        return redirect('/')->with('succes','Settings Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
