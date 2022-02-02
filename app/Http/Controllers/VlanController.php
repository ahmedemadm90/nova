<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Vlan;
use Illuminate\Http\Request;

class VlanController extends Controller
{
    /* function __construct()
    {
        $this->middleware('permission:Vlans List|Vlan Create|Vlan Edit|Vlan Delete|Vlan Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Vlans List', ['only' => ['index']]);
        $this->middleware('permission:Vlan Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Vlan Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Vlan Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Vlan Show', ['only' => ['show']]);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vlans = Vlan::paginate(15);
        return view('vlans.index', compact('vlans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $switches = Dispatch::get();
        return view('vlans.create', compact('switches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required|string',
            'switch_id' => 'required|exists:dispatches,id',
            'gateway' => 'required|string',
            'start_ip' => 'required|string',
            'end_ip' => 'required|string',
        ]);
        if (isset($input['active'])) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        Vlan::create($input);
        return redirect()->route('vlans.index')->with(['success' => 'Vlan Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vlan  $vlan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vlan  $vlan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $switches = Dispatch::get();
        $vlan = Vlan::find($id);
        return view('vlans.edit', compact('vlan', 'switches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vlan  $vlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vlan = Vlan::find($id);
        $input = $request->all();
        $request->validate([
            'name' => 'required|unique:vlans,id,' . $id,
            'switch_id' => 'required|exists:dispatches,id',
            'gateway' => 'required|string',
            'start_ip' => 'required|string',
            'end_ip' => 'required|string',
        ]);
        if (isset($input['active'])) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        $vlan->update($input);
        return redirect()->route('vlans.index')->with(['success' => 'Vlan Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vlan  $vlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vlan = Vlan::find($id);
        try {
            $vlan->delete();
            return redirect()->route('vlans.index')->with(['success' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('vlans.index')->with(['error' => 'Something Went Wrong Please Contact With Your System Admin']);
        }
    }
}