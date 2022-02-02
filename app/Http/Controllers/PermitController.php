<?php

namespace App\Http\Controllers;


use App\Models\Permit;
use App\Models\Service_Company;
use App\Models\UnfixedService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermitController extends Controller
{

    function __construct()
    {
        $this->middleware(
            'permission:Permits List|Permit Edit|Permit Delete|Request Truck Permit|
            Request Private Permit|View Permits State|Manage Private Permits|Manage vehicles Permits|
            Refused Permits List|Approved Permits List|Approve Group Permits|Reject Group Permits',
            ['only' => ['index']]
        );
        $this->middleware('permission:Manage Group Permits', ['only' => ['approve']]);
        $this->middleware('permission:Reject Group Permits', ['only' => ['refuse']]);
        $this->middleware('permission:Permit Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Permit Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Request Truck Permit', ['only' => ['truckCreate', 'truckPermitStore']]);
        $this->middleware('permission:Request Private Permit', ['only' => ['privateCreate', 'PrivatePermitStore']]);
        $this->middleware('permission:View Permits State', ['only' => ['myPermit']]);
        $this->middleware('permission:Manage Private Permits', ['only' => ['privateindex']]);
        $this->middleware('permission:Manage vehicles Permits', ['only' => ['vehicleindex']]);
        $this->middleware('permission:Refused Permits List', ['only' => ['refusedpermits']]);
        $this->middleware('permission:Approved Permits List', ['only' => ['approvedpermits']]);
        $this->middleware('permission:Safety Manage Permits', ['only' => ['safetyVehicleindex', 'safetyPrivateindex', 'safetyApprove', 'safetyReject']]);
        $this->middleware('permission:Security Manage Permits', ['only' => ['securityVehicleindex', 'securityPrivateindex', 'securityApprove', 'securityReject']]);
    }

    function index()
    {
        $permits = Permit::whereIn('state', ['refused', 'approved'])->simplePaginate(5);
        return view('permits.index', [
            'permits' => $permits
        ]);
    }
    function show($id)
    {
        $permit = Permit::find($id);
        return view('permits.show', [
            'permit' => $permit
        ]);
    }
    function refusedpermits()
    {
        $permits = Permit::where('state', 'rejected')->simplePaginate(5);
        return view('permits.refusedpermits', [
            'permits' => $permits
        ]);
    }
    /* function approvedpermits()
    {
        $permits = Permit::where('state', 'approved')->simplePaginate(5);
        return view('permits.approvedpermits', [
            'permits' => $permits
        ]);
    } */
    function privateindex()
    {
        $permits = Permit::where('vehicle_type', 'private')->where('state', '=', 'waitting')->simplePaginate(5);
        return view('permits.privateIndex', [
            'permits' => $permits
        ]);
    }
    /* Start Group Admin Functions */
    function vehicleindex()
    {
        $permits = Permit::where('vehicle_type', '!=', 'private')
            ->where('state', '=', 'waitting')->simplePaginate(5);
        return view('permits.vehicleIndex', [
            'permits' => $permits
        ]);
    }
    public function approve($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'approved',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function reject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    /* End Group Admin Functions */

    /* Start Safety Functions */
    function safetyVehicleindex()
    {
        $permits = Permit::where('vehicle_type', '!=', 'private')
            ->where('state', 'like', '%approved%')
            ->where('is_approved', '1')
            ->whereNull('is_safety_approved')->simplePaginate(25);
        return view('safety.services_permits', [
            'permits' => $permits
        ]);
    }
    public function safetyApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function safetyReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'is_safety_approved' => '0',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    function safetyPrivateindex()
    {
        $permits = Permit::where('vehicle_type', 'private')
            ->where('state', 'like', '%approved%')
            ->where('is_approved', '1')
            ->whereNull('is_safety_approved')->simplePaginate(25);
        return view('safety.services_permits', [
            'permits' => $permits
        ]);
    }
    /* End Safety Functions */


    /* Start Security Functions */
    function securityVehicleindex()
    {
        $permits = Permit::where('vehicle_type', '!=', 'private')
            ->where('state', 'like', '%approved%')
            ->where('is_approved', '1')
            ->where('is_safety_approved', '1')
            ->whereNull('is_security_approved')->simplePaginate(25);
        return view('safety.services_permits', [
            'permits' => $permits
        ]);
    }
    public function securityApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function securityReqject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'is_security_approved' => '0',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    /* End Security Functions */

    /* Start My Permit Functions */
    function myPermit()
    {
        $permits = Permit::where('permit_by', Auth::user()->id)->simplePaginate(5);
        return view('permits.mypermits', [
            'permits' => $permits
        ]);
    }
    /* End My Permit Functions */
    /* Start Requester Functions */
    function truckCreate()
    {
        $drivers = UnfixedService::where('job_title', 'like', '%driver%')->orderBy('en_name')->get();
        $groups = Auth::user()->groups;
        $service_comps = Service_Company::get();
        return view('permits.truckcreate', compact('drivers', 'groups', 'service_comps'));
    }

    function privateCreate()
    {
        return view('permits.privatecreate');
    }
    function truckPermitStore(Request $request)
    {
        $input = $request->all();
        $vehicle_drivers = [];
        $vehicle_drivers_id = [];
        $request->validate([
            'type' => 'required|max:15',
            'date_from' => 'required|string|max:10',
            'date_to' => 'required|string|max:10',
            'vehicle_num' => 'required|string|max:10',
            'vehicle_type' => 'required|string|max:10',
            'vehicle_clr' => 'required|string|max:10',
            'drivers_count' => 'required|numeric|max:4',
            'vehicle_drivers_id' => 'required',
            'vehicle_drivers_id*' => 'exists:unfixed_service,nid',
            'company_id' => 'required|string|max:50',
            'mission' => 'required|string|max:100',
            'access_gate' => 'required|array',
            'allowed_sectors' => 'required|array',
            'movement_gates' => 'required|array',
            'group_id' => 'required|exists:groups,id',
        ]);
        $input['permit_by'] = Auth::user()->id;
        $input['group_id'] = $request->group_id;
        $input['state'] = 'waitting';
        foreach ($request->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            array_push($vehicle_drivers, $driver->ar_name);
            array_push($vehicle_drivers_id, $driver->nid);
        }
        $input['vehicle_drivers_id'] = $vehicle_drivers_id;
        $permit = Permit::create($input);
        foreach ($request->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'permit_id' => $permit->id,
            ]);
        }
        return back();
    }
    function PrivatePermitStore(Request $request)
    {

        $request->validate([
            'type' => 'required|max:15',
            'date_from' => 'required|string|max:10',
            'date_to' => 'required|string|max:10',
            'vehicle_num' => 'required|string|max:10',
            'vehicle_clr' => 'required|string|max:10',
            'drivers_count' => 'required|max:4',
            'vehicle_drivers' => 'required',
            'vehicle_drivers_id' => 'required',
            'drivers_id_types' => 'required',
            'drivers_phones' => 'required',
            'company' => 'required|string|max:50',
            'access_gate' => 'required|array',
            'allowed_sectors' => 'required|array',
            'movement_gates' => 'required|array',
        ]);
        Permit::create([
            'type' => $request->type,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'vehicle_num' => $request->vehicle_num,
            'vehicle_type' => 'private',
            'vehicle_clr' => $request->vehicle_clr,
            'drivers_count' => $request->drivers_count,
            'vehicle_drivers' => $request->vehicle_drivers,
            'vehicle_drivers_id' => $request->vehicle_drivers_id,
            'drivers_id_types' => $request->drivers_id_types,
            'drivers_phones' => $request->drivers_phones,
            'company' => $request->company,
            'mission' => 'transporting',
            'access_gate' => $request->access_gate,
            'allowed_sectors' => $request->allowed_sectors,
            'movement_gates' => $request->movement_gates,
            'permit_by' => Auth::user()->id,
            'state' => 'waitting',
            'group_id' => Auth::user()->group_id,
        ]);
        return back();
    }
    /* End Requester Functions */

    /* Start Group Functions */
    public function truckmyteam()
    {
        $permits = Permit::where('vehicle_type', '!=', 'private')
            ->whereIn('group_id', Auth::user()->groups)
            ->where('state', 'like', '%waitting%')->paginate(25);

        return view('permits.trucksmyteam', compact('permits'));
    }
    public function privatemyteam()
    {
        $permits = Permit::where('vehicle_type', 'private')
            ->where('group_id', '=', Auth::user()->group_id)
            ->where('state', 'waitting')->simplePaginate(8);
        return view('permits.privatemyteam', compact('permits'));
    }
    /* Start Group Functions */


    /* Start Admin Permit Destroy Functions */
    public function destroy($id)
    {
        $permit = Permit::find($id);
        $permit->delete();
        return back();
    }
    /* End Admin Permit Destroy Functions */
}
