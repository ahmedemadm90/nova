<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Dispatch;
use App\Models\DVR;
use App\Models\Vlan;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Cameras List|Camera Create|Camera Edit|Camera Delete|Camera Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Cameras List', ['only' => ['index']]);
        $this->middleware('permission:Camera Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Camera Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Camera Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Camera Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cams = Camera::paginate(50);
        return view('cameras.index', compact('cams'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dvrs = DVR::where('active', '1')->get();
        $vlans = Vlan::where('active', '1')->get();
        $switches = Dispatch::where('active', '1')->get();
        return view('cameras.create', compact('dvrs', 'vlans', 'switches'));
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
            "code" => "required|string|max:50|unique:cameras,code",
            "region" => "required|string|max:50",
            "segment" => "required|string|max:50",
            "location" => "required|string|max:150",
            "area" => "required|string|max:50",
            "en_name" => "required|string|max:50",
            "ar_name" => "required|string|max:150",
            "is_operation" => "required|in:operation,non operation",
            "switch_id" => "required|exists:dispatches,id",
            "vlan_id" => "required|exists:vlans,id",
            "dvr_id" => "required|exists:d_v_r_s,id",
            "type" => "required|in:analog,ip fixed,ip ptz",
            "brand" => 'required|string|max:50',
            "model" => "required|string|max:50",
            "serial" => "required|string|max:50",
            "ip" => 'nullable|string|max:15',
            "username" => 'nullable|string|max:12',
            "password" => 'nullable|string|max:12',
            "resolution" => "required|numeric|max:24",
            "maintenance" =>
            "required|in:building Stairs,crane 65,factory crane,ladder,ladder indoor,
                ladder outdoor,manleft,on ground,over belt,scissor lift,tower ladder",
            "clean" =>
            "required|in:building Stairs,crane 65,factory crane,ladder,ladder indoor,
                ladder outdoor,manleft,on ground,over belt,scissor lift,tower ladder",
            "connection" => "required|in:direct connect,fiber to nvr,local,remote,UTP",
            "power" => "required|in:12 v,24 v,adapter,POE,power supply",
            "company" => "required|string|max:50",
            "year" => "required|numeric",
            "install_state" => "required|in:installed,in progress",
            "state" => "required|in:online,offline",
            "alarm" => "required|in:enabled,disabled",
        ]);
        try {
            Camera::create($input);
            return redirect()->route('cameras.index')->with(['success' => 'Camera Created Successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('cameras.index')->with(['error' => 'Something Went Wrong Please Contact Your System Admin']);
        }
    }


    public function show($id)
    {
        $cam = Camera::find($id);
        return view('cameras.show', compact('cam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cam = Camera::find($id);
        $switches = Dispatch::get();
        $vlans = Vlan::get();
        $dvrs = DVR::get();
        return view('cameras.edit', compact('cam', 'vlans', 'switches', 'dvrs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cam = Camera::find($id);
        $request->validate([
            "code" => "required|string|max:50",
            "region" => "required|string|max:50",
            "segment" => "required|string|max:50",
            "location" => "required|string|max:150",
            "area" => "required|string|max:50",
            "en_name" => "required|string|max:50",
            "ar_name" => "required|string|max:150",
            "is_operation" => "required",
            "switch_id" => "required|exists:dispatches,id",
            "vlan_id" => "required|exists:vlans,id",
            "dvr_id" => "required|exists:d_v_r_s,id",
            "type" => "required|in:analog,ip fixed,ip ptz",
            "brand" => 'required|string|max:50',
            "model" => "required|string|max:50",
            "serial" => "required|string|max:50",
            "ip" => 'nullable|string|max:15',
            "username" => 'nullable|string|max:12',
            "password" => 'nullable|string|max:12',
            "resolution" => "required|numeric|max:24",
            "maintenance" =>
            "required|in:building Stairs,crane 65,factory crane,ladder,ladder indoor,
                ladder outdoor,manleft,on ground,over belt,scissor lift,tower ladder,no need",
            "clean" =>
            "required|in:building stairs,crane 65,factory crane,ladder,ladder indoor,
                ladder outdoor,manleft,on ground,over belt,scissor lift,tower ladder,no need",
            "connection" => "required|in:direct connect,fiber to nvr,local,remote,UTP",
            "power" => "required|in:12 v,24 v,adapter,POE,power supply",
            "company" => "required|string|max:50",
            "year" => "required|numeric",
            "install_state" => "required|in:installed,in progress",
            "state" => "required|in:online,offline",
            "alarm" => "required|in:enabled,disabled",
        ]);
        $input = $request->all();
        $cam->update($input);
        return redirect()->route('cameras.index')->with(['success' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $cams = Camera::where('ar_name', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('code', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('en_name', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('region', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('area', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('segment', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('is_operation', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('ip', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('year', 'like',  "%" . $request['keywords'] . "%")
            ->orWhere('type', 'like',  "%" . $request['keywords'] . "%")->get();

        return view('cameras.search', compact('cams'));
    }
    public function destroy($id)
    {
        $cam = Camera::find($id);
        $cam->delete();
        return redirect()->route('cameras.index')->with(['success' => 'Deleted Successfully']);
    }
}