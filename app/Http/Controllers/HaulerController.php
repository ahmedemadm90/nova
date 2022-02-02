<?php

namespace App\Http\Controllers;

use App\Exports\HaulersExport;
use App\Models\Hauler;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HaulerController extends Controller
{
    /*
    Construct Function For Permissions Of Spatie Packdge
     */
    function __construct()
    {
        $this->middleware('permission:Haulers List|Hauler Create|Hauler Edit|Hauler Delete|Hauler Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Hauler Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Hauler Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Hauler Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Hauler Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $haulers = Hauler::paginate(25);
        return view('haulers.index', compact('haulers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('haulers.create');
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
            'name' => 'required|unique:haulers,name'
        ]);
        Hauler::create($input);
        return redirect()->route('haulers.index')->with(['success' => 'Created Successfullay']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hauler  $hauler
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('haulers.index')->with(['error' => 'there is nothing to see there']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hauler  $hauler
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hauler = Hauler::find($id);
        return view('haulers.edit', compact('hauler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hauler  $hauler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $hauler = Hauler::find($id);
        if (!$hauler) {
            return redirect()->route('haulers.index')->with(['error' => 'invalid hauler']);
        }
        $request->validate([
            'name' => 'required|unique:haulers,name,' . $id
        ]);
        $hauler->update($input);
        return redirect()->route('haulers.index')->with(['success' => 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hauler  $hauler
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hauler = Hauler::find($id);
        if (!$hauler) {
            return redirect()->route('haulers.index')->with(['error' => 'invalid hauler']);
        }
        $hauler->delete();
        return redirect()->route('haulers.index')->with(['success' => 'hauler deleted successfully']);
    }
    public function export()
    {
        return Excel::download(new HaulersExport("Cemex Haulers.xlsx"));
    }
    public function changestate($id)
    {
        $hauler = Hauler::find($id);
        if ($hauler->active == 1) {
            $hauler->update([
                'active' => '0',
            ]);
        } else {
            $hauler->update([
                'active' => '1',
            ]);
        }
        return redirect(route('haulers.index'));
    }
}