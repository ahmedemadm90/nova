<?php

namespace App\Http\Controllers;

use App\Models\UnfixedFromSupplier;
use Illuminate\Http\Request;

class UnfixedFromSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unfixed service from supplier.create');
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
            'en_name'=>'required|string|max:150',
            'ar_name'=>'required|string|max:150',
            'job'=>'required|string|max:150',
            'nid'=>'required|string|min:13|max:14',
            'phone1' => 'required|string|min:10',
            'phone2' => 'required|string|min:10',
            'address' => 'required|string|max:255',
        ]);
        //dd($input);
        $input['age'] = 'age';
        UnfixedFromSupplier::create($input);
        return back()->with(['تم الاضافة بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnfixedFromSupplier  $unfixedFromSupplier
     * @return \Illuminate\Http\Response
     */
    public function show(UnfixedFromSupplier $unfixedFromSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnfixedFromSupplier  $unfixedFromSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(UnfixedFromSupplier $unfixedFromSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnfixedFromSupplier  $unfixedFromSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnfixedFromSupplier $unfixedFromSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedFromSupplier  $unfixedFromSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnfixedFromSupplier $unfixedFromSupplier)
    {
        //
    }
}
