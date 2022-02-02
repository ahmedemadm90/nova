<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $switches = Dispatch::paginate(15);
        return view('dispatches.index', compact('switches'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dispatches.create');
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
            'name' => 'required|string|unique:dispatches,name',
            'ports' => 'required|numeric',
            'type' => 'required|in:ip fixed,analog',
            'location' => 'required|string',
            'ip' => 'required',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if (isset($input['active'])) {
            $input['active'] = '1';
        }
        Dispatch::create($input);
        return redirect()->route('switches.index')->with(['success' => 'Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function show(Dispatch $dispatch, $id)
    {
        $switch = Dispatch::find($id);
        return view('dispatches.show', compact('switch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispatch $dispatch, $id)
    {
        $switch = Dispatch::find($id);
        return view('dispatches.edit', compact('switch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required|string|unique:dispatches,name,' . $id,
            'ports' => 'required|numeric',
            'type' => 'in:ip fixed,analog',
            'location' => 'required|string',
            'ip' => 'required',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $switch = Dispatch::find($id);
        if (isset($input['active'])) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        //dd($input);
        $switch->update($input);
        return redirect()->route('switches.index')->with(['success' => 'Added Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $switch = Dispatch::find($id);
        $switch->delete();
        return redirect()->route('switches.index')->with(['success' => 'Deleted Successfully']);
    }
}