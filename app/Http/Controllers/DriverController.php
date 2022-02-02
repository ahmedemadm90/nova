<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\Driver_Company;
use App\Models\Service_Company;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Drivers List|Driver Create|Driver Edit|Driver Delete|Driver Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Drivers List', ['only' => ['index']]);
        $this->middleware('permission:Driver Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Driver Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Driver Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Driver Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drivers = Driver::paginate(5);
        return view('drivers.index', compact('drivers'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.create');
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
        $this->validate($request, [
            'name' => 'required|unique:drivers,name|string',
            'license_level' => 'required|string',
            'license_number' => 'required|unique:drivers,license_number|string',
            'phone_number' => 'required|unique:drivers,phone_number',
            'state' => 'required|in:allowed,blacklist',
            'img' => 'required|file|mimes:jpg,jpeg,gif,png',
        ]);
        //dd($input);
        if (!isset($request->active)) {
            $input['active'] = '0';
        } else {
            $input['active'] = '1';
        }
        $img = $input['img'];
        $ext = $img->extension();
        $imgname = $request->license_number . "." . $ext;
        $input['id_img'] = $imgname;
        $img->move(public_path("media/drivers/ids"), $imgname);
        //dd($input);
        Driver::create($input);
        return redirect()->route('drivers.index')->with(['success' => 'Driver Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return redirect()->route('drivers.index')->with(['error' => 'Something Went Wrong Contact Your System Admin']);
        }
        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return redirect()->route('drivers.index')->with(['error' => 'Something Went Wrong, Contact Your System Admin']);
        }
        unlink(public_path("media/drivers/ids/$driver->id_img"));
        $driver->delete();
        return redirect()->route('drivers.index')->with(['success' => 'Driver Deleted Successfully']);
    }
}