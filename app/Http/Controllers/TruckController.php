<?php

namespace App\Http\Controllers;

use App\Models\Hauler;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Trucks List|Truck Create|Truck Edit|Truck Delete|Truck Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Truck Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Truck Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Truck Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Truck Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trucks = Truck::paginate(25);
        return view('trucks.index', compact('trucks'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $haulers = Hauler::where('active', '1')->get();
        return view('trucks.create', compact('haulers'));
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
            'truck_no' => 'required|string|unique:trucks,truck_no',
            'hauler_id' => 'required|exists:haulers,id',
        ]);
        Truck::create($input);
        return redirect(route('trucks.index'))->with(['success' => 'created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truck = Truck::find($id);
        $haulers = Hauler::where('active', '1')->get();
        return view('trucks.edit', compact('truck', 'haulers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $truck = Truck::find($id);
        $request->validate([
            'truck_no' => 'required|string|unique:trucs,truck_no,' . $id,
            'hauler_id' => 'required|exists:haulers,id',
        ]);
        $truck->update($request->all());
        return redirect(route('trucks.index'))->with(['success' => 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truck = Truck::find($id);
        $truck->delete();
        return redirect(route('trucks.index'))->with(['error' => 'truck deleted successfully']);
    }
}