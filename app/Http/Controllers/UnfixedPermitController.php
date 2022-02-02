<?php

namespace App\Http\Controllers;

use App\Models\Service_Company;
use App\Models\UnfixedPermit;
use App\Models\UnfixedService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnfixedPermitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Unfixed Permits List|Unfixed Permit Store|Unfixed Permit Create|Unfixed Permit Edit|Unfixed Permit Show|Unfixed Permit Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Unfixed Permit Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Unfixed Permit Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Unfixed Permit Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Unfixed Permit Show', ['only' => ['show']]);
        $this->middleware('permission:Unfixed Permits List', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unfixed_permits = UnfixedPermit::paginate(15);
        return view('unfixed permits.index', compact('unfixed_permits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unfixed_workers = UnfixedService::orderby('en_name')->get();
        $companies = Service_Company::where('active', '1')->get();
        $groups = Auth::user()->groups;
        return view('unfixed permits.create', compact('unfixed_workers', 'companies', 'groups'));
    }
    /* public function today()
    {
        $unfixed_permits = UnfixedPermit::where('end_date', Carbon::now())->get();
        return view('unfixed permits.today', compact('unfixed_permits'));
    } */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workers_ids = [];
        $workers_names = [];
        $ar_workers_names = [];
        $request->validate([
            'company_id' => 'required|string|max:50',
            'workers_ids' => 'required|array',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $input = $request->all();
        foreach ($input['workers_ids'] as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            array_push($workers_ids, $nid);
            array_push($workers_names, $worker->en_name);
            array_push($ar_workers_names, $worker->ar_name);
        }
        $input['workers_names'] = $workers_names;
        $input['ar_workers_names'] = $ar_workers_names;
        $input['workers_ids'] = $workers_ids;
        $input['requested_by'] = Auth::user()->id;
        $new = UnfixedPermit::create($input);
        foreach ($workers_ids as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            $worker->update([
                'active' => '0',
                'permit_id' => $new->id,
                'company_id' => $request->company_id,
            ]);
        }
        return redirect()->route('unfixed.permits.index')->with(['success' => 'Permit Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permit = UnfixedPermit::find($id);
        return view('unfixed permits.show', compact('permit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $permit = UnfixedPermit::find($id);
        $workers_ids = $permit->workers_ids;
        $workers_names = $permit->workers_names;
        $data = array_combine($workers_ids, $workers_names);
        return view('unfixed permits.edit', compact('permit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permit = UnfixedPermit::find($id);
        $request->validate([
            'company' => 'required|string|max:50',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $permit->update($request->all());
    }
    /* Start Group Unfixed Permits */
    public function groupPermits()
    {
        $unfixed_permits  = UnfixedPermit::where('state', 'pending')->whereIn('group_id', auth()->user()->groups)->paginate(50);
        return view('unfixed permits.groupindex', compact('unfixed_permits'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }

    public function reject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Admin Rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Group Unfixed Permits */

    /* Start Safety Unfixed Permits */
    function safetyUnfixedindex()
    {
        $unfixed_permits = UnfixedPermit::where('state', 'like', '%Pending Safety Approve%')
            ->where('is_approved', '1')
            ->whereNull('is_safety_approved')->simplePaginate(25);
        return view('unfixed permits.safetypermits', compact('unfixed_permits'));
    }
    public function safetyApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Pending Security Approve',
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function safetyReject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Safety Rejected',
            'is_safety_approved' => '0',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Safety Unfixed Permits */

    /* Start Security Unfixed Permits */
    function securityUnfixedindex()
    {
        $unfixed_permits = UnfixedPermit::where('state', 'like', '%Pending Security Approve%')
            ->where('is_approved', '1')
            ->where('is_safety_approved', '1')
            ->whereNull('is_security_approved')->simplePaginate(25);
        return view('unfixed permits.securitypermits', compact('unfixed_permits'));
    }
    public function securityApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '1',
            'state' => 'Aproved',
            'is_security_approved' => '1',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function securityReject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Security Rejected',
            'is_security_approved' => '0',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Security Unfixed Permits */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnfixedPermit $unfixedPermit, $id)
    {
        $worker = UnfixedPermit::find($id);
        $worker->delete();
        return redirect()->route('unfixed.permits.index')->with(['success' => 'Permit Deleted Successfully']);
    }
}
