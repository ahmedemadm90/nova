<?php

namespace App\Http\Controllers;

use App\Models\Safety;
use App\Models\Violation;
use Illuminate\Http\Request;

class SafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $violations = Violation::whereNull('safety_comment')->whereNotNull('area_comment')->paginate(10);
        return view('safety.index', compact('violations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function show(Safety $safety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function edit(Safety $safety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Safety $safety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Safety  $safety
     * @return \Illuminate\Http\Response
     */
    public function destroy(Safety $safety)
    {
        //
    }
}