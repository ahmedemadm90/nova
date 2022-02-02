<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\DVR;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Tickets List|Ticket Create|Ticket Edit|Ticket Delete|Ticket Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Tickets List', ['only' => ['index']]);
        $this->middleware('permission:Ticket Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Ticket Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Ticket Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Ticket Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::where('state', 'closed')->paginate(10);
        return view('tickets.index', compact('tickets'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cams = Camera::get();
        $dvrs = DVR::get();
        return view('tickets.create', compact('cams', 'dvrs'));
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
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}