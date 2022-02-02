<?php

namespace App\Http\Controllers;

use App\Models\DVR;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class DVRController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:DVRS List|DVR Create|DVR Edit|DVR Delete|DVR Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:DVRS List', ['only' => ['index']]);
        $this->middleware('permission:DVR Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:DVR Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:DVR Delete', ['only' => ['destroy']]);
        $this->middleware('permission:DVR Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dvrs = DVR::paginate(15);
        return view('dvrs.index', compact('dvrs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('dvrs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $request->validate([
            'name' => 'required|string|unique:d_v_r_s,name',
            'type' => 'required|in:NVR,DVR',
            'install_location' => 'required|string',
            'region' => 'required|string',
            'location' => 'required|string',
            'area' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'sw_ver' => 'required|string',
            'code' => 'required|string',
            'total_chs' => 'required|numeric',
            'hdd_cap' => 'required|numeric',
            'unit_cap' => 'required|numeric',
            'total_storage' => 'required|numeric',
            'qty' => 'required|numeric',
            'ip' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $input = $request->all();
        if (isset($input['active'])) {
            $request->validate([
                'active' => 'required|in:0,1'
            ]);
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        DVR::create($input);
        return redirect()->route('dvrs.index')->with(['success' => 'Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DVR  $dVR
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dvr = DVR::find($id);
        if (!$dvr) {
            return redirect()->route('dvrs.index')->with(['error' => 'Invaled Device']);
        }
        return view('dvrs.show', compact('dvr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DVR  $dVR
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dvr = DVR::find($id);
        if (!$dvr) {
            return redirect()->route('dvrs.index')->with(['error' => 'Invaled Device']);
        }
        return view('dvrs.edit', compact('dvr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DVR  $dVR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dvr = DVR::find($id);
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:NVR,DVR',
            'install_location' => 'required|string',
            'region' => 'required|string',
            'location' => 'required|string',
            'area' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'sw_ver' => 'required|string',
            'code' => 'required|string',
            'total_chs' => 'required|numeric',
            'hdd_cap' => 'required|numeric',
            'unit_cap' => 'required|numeric',
            'total_storage' => 'required|numeric',
            'qty' => 'required|numeric',
            'ip' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $input = $request->all();
        if (isset($input['active'])) {
            $request->validate([
                'active' => 'required|in:0,1'
            ]);
            $input['active'] = $request->active;
        } else {
            $input['active'] = '0';
        }
        $dvr->update($input);
        return redirect()->route('dvrs.index')->with(['success' => 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DVR  $dVR
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dvr = DVR::find($id);
        $dvr->delete();
        return redirect()->route('dvrs.index')->with(['success' => 'Deleted Successfully']);
    }
}