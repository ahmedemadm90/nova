<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Locations List|Location Create|Location Edit|Location Delete|Location Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Locations List', ['only' => ['index']]);
        $this->middleware('permission:Location Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Location Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Location Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Location Show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $locs = Location::paginate(10);
        return view('locations.index', compact('locs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);;
    }


    public function create(Request $request)
    {
        $countries = country::get();
        return view('locations.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:25|unique:locations,location_name',
            'country_id' => 'required|nullable|exists:countries,id'
        ]);
        $input = $request->all();
        try {
            Location::create($input);
            return back()->with(['success' => 'Created Successfully']);
        } catch (\Throwable $th) {
            return back()->with(['error' => 'Something Went Wrong Please Contact System Admin']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $location = Location::find($id);
        if (!$location) {
            return redirect()->route('locations.index')->with(['error' => 'Something Went Wrong Please Contact Your System Admin']);
        } else {
            return view('locations.edit', compact('location'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        if (!$location) {
            return redirect()->route('locations.index')->with(['error' => 'Something Went Wrong Please Contact Your System Admin']);
        } else {
            $request->validate([
                'location_name' => 'required|unique:locations,location_name,' . $id,
                'country_id' => 'required|numeric',
            ]);
            $input = $request->all();
            $location->update($input);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
