<?php

namespace App\Http\Controllers;

use App\Models\ViolationType;
use Illuminate\Http\Request;

class ViolationTypeController extends Controller
{
    /* function __construct()
    {
        $this->middleware('permission:Classifications List|Classification Create|Classification Edit|Classification Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Classification Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Classification Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Classification Delete', ['only' => ['destroy']]);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = ViolationType::orderBy('classification')->simplepaginate(5);
        return view('violation type.index', compact('types'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('violation type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'classification' => 'required|string|unique:violation_types,classification'
            ]);
            $input = $request->all();
            ViolationType::create($input);
            return redirect()->route('classifications.index')->with(['success' => 'A New Classification Was Created']);
        } catch (\Throwable $th) {
            return redirect()->route('classifications.index')->with(['error' => 'Something Went Wrong Please Try Again Later']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViolationType  $violationType
     * @return \Illuminate\Http\Response
     */
    public function show(ViolationType $violationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViolationType  $violationType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $type = ViolationType::find($id);
        if ($type) {
            return view('violation type.edit', compact('type'));
        } else {
            return redirect()->route('classifications.index')->with(['error' => 'Invaled Classification ID']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ViolationType  $violationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $type = ViolationType::find($id);
            $request->validate([
                'classification' => 'required|string|unique:violation_types,classification,' . $id
            ]);
            $input = $request->all();
            $type->update($input);
            return redirect()->route('classifications.index')->with(['success' => 'Classification Was Updated Successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('classifications.index')->with(['error' => 'Something Went Wrong Please Try Again Later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViolationType  $violationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViolationType $violationType)
    {
        //
    }
}