<?php

namespace App\Http\Controllers;

use App\Models\UnfixedService;
use Illuminate\Http\Request;

class UnfixedServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unfixedEmps = UnfixedService::paginate(50);
        $total = UnfixedService::count();
        $onpermit = UnfixedService::whereNotNull('permit_id')->count();
        $free = UnfixedService::whereNull('permit_id')->count();
        return view('unfixed service.index', compact('unfixedEmps', 'total', 'free', 'onpermit'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unfixed service.create');
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
            'name' => 'required|string|max:70',
            'nid' => 'required|string|min:14|unique:unfixed_services,nid',
            'job' => 'required|in:labor,driver',
            'mobile' => 'required|numeric',
            'address' => 'required|string|max:150',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
            'licence_level' => 'nullable|in:اولى,ثانية,,ثالثة,خاصة',
        ]);
        if (isset($request->image)) {
            $img = $request->img;
            $ext = $img->extension();
            $imgname = "$request->nid" . ".$ext";
            $img->move(public_path("media/workers"), $imgname);
            $request->image = $imgname;
        }
        $input = $request->all();
        UnfixedService::create($input);
        return redirect()->route('unfixed.emps.index')->with(['success' => 'Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function show(UnfixedService $unfixedService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function edit(UnfixedService $unfixedService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = UnfixedService::find($id);
        $worker->delete();
        return redirect()->route('unfixed.emps.index')->with(['success' => 'Permit Deleted Successfully']);
    }
}