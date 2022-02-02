<?php

namespace App\Http\Controllers;

use App\Exports\ViolationsExport;
use App\Models\Area;
use App\Models\UnfixedService;
use App\Models\User;
use App\Models\Violation;
use App\Models\ViolationType;
use App\Models\Vp;
use App\Models\Worker;
use App\Notifications\NewViolationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class ViolationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Violations|Violations List|Violation Create|Violation Edit|User Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Violation Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Violation Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Violation Delete', ['only' => ['destroy']]);
    }

    public function selectArea(Request $request)
    {
        $areas = Area::select('id', 'area_name')->where('vp_id', $request->id)
            ->orderBy('area_name')->get();
        return response()->json($areas);
    }
    public function index()
    {
        $violations = Violation::orderBy('date')->paginate(50);
        /* $areas = Area::get();
        $vps = Vp::get(); */
        return view('violations.index', [
            "violations" => $violations,
        ]);
    }
    public function indexDate(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $vios = Violation::whereBetween('date', [$date_from, $date_to])->orderBy('date')->paginate(50);
        return view('violations.dateresults', compact('vios', 'date_from', 'date_to'));
    }
    public function indexType(Request $request)
    {
        $egyVps = [];
        $egyViosCount = [];
        $type = ViolationType::where('classification', $request->type)->first();
        /* Start Of Type Statics */
        $getuaevps = Violation::select('vp_id')
            ->where('classification', $type->id)
            ->groupBy('vp_id')->get();
        foreach ($getuaevps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Violation::where('vp_id', $vp->vp_id)
                ->where('classification', $type->id)
                ->groupBy('vp_id')->count();
            array_push($egyVps, $find->vp_name);
            array_push($egyViosCount, $count);
        }
        $vpsdataSet = array_combine($egyVps, $egyViosCount);
        /* End Of Type Statics */
        $OneType = app()->chartjs
            ->name('egytype')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($vpsdataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => ['#2B2E4A', '#0D7377', '#EA5455', '#3EC1D3'],
                    'data' => array_values($vpsdataSet),
                ]
            ])
            ->options([]);
        return view('typesdashboard', compact('OneType', 'vpsdataSet'));
    }
    public function indexDateType(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $egyVps = [];
        $egyViosCount = [];
        $type = ViolationType::where('classification', $request->type)->first();
        /* Start Of Type Statics */
        $getegyvps = Violation::select('vp_id')
            ->where('classification', $type->id)
            ->whereBetween('date', [$request->date_from, $request->date_to])
            ->groupBy('vp_id')->get();
        foreach ($getegyvps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Violation::where('vp_id', $vp->vp_id)
                ->where('classification', $type->id)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->groupBy('vp_id')->count();
            array_push($egyVps, $find->vp_name);
            array_push($egyViosCount, $count);
        }
        $vpsdataSet = array_combine($egyVps, $egyViosCount);

        $OneType = app()->chartjs
            ->name('egytype')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($vpsdataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => ['#2B2E4A', '#0D7377', '#EA5455', '#3EC1D3'],
                    'data' => array_values($vpsdataSet),
                ]
            ])
            ->options([]);
        return view('typesdashboard', compact('OneType', 'vpsdataSet'));
    }
    public function search(Request $request)
    {
        $violations = Violation::where('nearmiss', $request->keyword)->paginate(50);
        return view('violations.index', [
            "violations" => $violations,
        ]);
    }

    public function create(Request $request)
    {
        $vps = Vp::where('region_id', 1)->orderby('vp_name')->get();
        $areas = Area::where('vp_id', $request->id)->orderBy('area_name');
        $workers = Worker::select('id', 'name', 'company_id')->where('country_id', '1')->get();
        $unfixed_workers = UnfixedService::whereNotNull('permit_id')->get();
        $admins = Worker::select('id', 'name', 'title_id')->orderBy('name')->where('area_res', 1)->get();
        $types = ViolationType::get();
        return view('violations.create', [
            "vps" => $vps,
            "areas" => $areas,
            'admins' => $admins,
            'workers' => $workers,
            'unfixed_workers' => $unfixed_workers,
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $involved_ids = [];
        $involved_names = [];
        $involved_pos = [];
        $involved_comps = [];
        $involved_types = [];
        $gallery = [];
        $request->validate([
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'location' => 'required|string|max:75',
            'date' => 'required|date',
            'time' => 'required|string|max:5',
            'category' => 'required',
            'area_res_id' => 'required',
            'nearmiss' => 'required|numeric|unique:violations,nearmiss',
            'involved_ids' => 'nullable',
            'description' => 'required',
            'action' => 'required',
            'classification' => 'required|exists:violation_types,id',
            'gallery' => 'required',
            'video' => 'required',
        ]);
        if (isset($input['involved_ids'])) {
            foreach ($input['involved_ids'] as $id) {
                $worker = Worker::find($id);
                if ($worker) {
                    array_push($involved_ids, $worker->id);
                    array_push($involved_names, $worker->name);
                    array_push($involved_pos, $worker->position);
                    array_push($involved_comps, $worker->company->company_name);
                    array_push($involved_types, $worker->type->type_name);
                } else {
                    $unfixed = UnfixedService::where('nid', $id)->first();
                    array_push($involved_ids, $unfixed->id);
                    array_push($involved_names, $unfixed->name);
                    array_push($involved_pos, $unfixed->position);
                    array_push($involved_comps, $unfixed->company->company_name);
                    array_push($involved_types, 'Service');
                }
            }
        }
        foreach ($request->gallery as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/violations/egy/images"), $imageName);
        }
        $video = $input['video'];
        $ext = $video->extension();
        $videoName = uniqid() . "." . $ext;
        $video->move(public_path("media/violations/egy/video"), $videoName);
        $input['gallery'] = $gallery;
        $input['video'] = $videoName;
        $input['register_by'] = Auth::user()->id;
        $input['involved_ids'] = $involved_ids;
        $input['involved_names'] = $involved_names;
        $input['involved_pos'] = $involved_pos;
        $input['involved_comps'] = $involved_comps;
        $input['involved_types'] = $involved_types;
        $user = User::find($input['area_res_id']);
        $vio = Violation::create($input);
        //Notification::send($user, new NewViolationNotification($vio->id));
        return redirect(route('violations.index'))->with(['success' => 'created successfully']);
    }
    public function show($id)
    {
        $violation = Violation::where('id', $id)->first();
        $workers = Worker::select('id', 'name', 'company_id')->get();
        $unfixed_workers = UnfixedService::get();
        $admins = Worker::select('id', 'name', 'title_id')->where('area_res', '1')->get();
        return view('violations.show', compact('violation', 'workers', 'unfixed_workers', 'admins'));
    }
    public function edit(Request $request, $id)
    {
        $violation = Violation::find($id);
        $vps = Vp::where('region_id', 1)->orderby('vp_name')->get();
        $areas = Area::where('vp_id', $request->id)->orderBy('area_name');
        $workers = Worker::select('id', 'name', 'company_id')->get();
        $unfixed_workers = UnfixedService::whereNotNull('permit_id')->get();
        $admins = Worker::select('id', 'name', 'title_id')->where('area_res', '1')->get();
        $types = ViolationType::get();
        return view('violations.edit', [
            "vps" => $vps,
            "areas" => $areas,
            'admins' => $admins,
            'workers' => $workers,
            'unfixed_workers' => $unfixed_workers,
            'types' => $types,
            'violation' => $violation,
        ]);
    }


    public function update(Request $request, $id)
    {
        $violation = Violation::find($id);
        $input = $request->all();
        $involved_ids = [];
        $involved_names = [];
        $involved_pos = [];
        $involved_comps = [];
        $involved_types = [];
        $gallery = [];
        $request->validate([
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'location' => 'required|string|max:75',
            'date' => 'required|date',
            'time' => 'required|string|max:5',
            'category' => 'required',
            'area_res_id' => 'required',
            'nearmiss' => 'required|numeric',
            'description' => 'required',
            'action' => 'required',
            'classification' => 'required|exists:violation_types,id',
        ]);
        /* foreach ($input['involved_ids'] as $id) {
            $worker = Worker::find($id);
            if ($worker) {
                array_push($involved_ids, $worker->id);
                array_push($involved_names, $worker->name);
                array_push($involved_pos, $worker->position);
                array_push($involved_comps, $worker->company->company_name);
                array_push($involved_types, $worker->type->type_name);
            } else {
                $unfixed = UnfixedService::where('nid', $id)->first();
                array_push($involved_ids, $unfixed->nid);
                array_push($involved_names, $unfixed->name);
                array_push($involved_pos, $unfixed->position);
                array_push($involved_comps, $unfixed->company->company_name);
                array_push($involved_types, 'service');
            }
        } */
        if (isset($input['involved_ids'])) {
            foreach ($input['involved_ids'] as $id) {
                $worker = Worker::find($id);
                $unfixed = UnfixedService::where('nid', $id)->first();
                if ($worker) {
                    array_push($involved_ids, $worker->id);
                    array_push($involved_names, $worker->name);
                    array_push($involved_pos, $worker->position);
                    array_push($involved_comps, $worker->company->company_name);
                    array_push($involved_types, $worker->type->type_name);
                } elseif ($unfixed) {
                    $unfixed = UnfixedService::where('nid', $id)->first();
                    array_push($involved_ids, $unfixed->id);
                    array_push($involved_names, $unfixed->name);
                    array_push($involved_pos, $unfixed->position);
                    array_push($involved_comps, $unfixed->company->company_name);
                    array_push($involved_types, 'Service');
                }
            }
        }
        if ($request->hasFile('gallery')) {
            foreach ($violation->gallery as $img) {
                unlink('public/media/violations/egy/images/' . $img);
            }
            foreach ($request->gallery as $galleryImg) {
                $ext = $galleryImg->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($gallery, $imageName);
                $galleryImg->move(public_path("media/violations/egy/images"), $imageName);
            }
            $input['gallery'] = $gallery;
        } else {
            $input['gallery'] = $violation->gallery;
        }
        if ($request->hasFile('video')) {
            unlink('media/violations/egy/video/' . $violation->video);
            $video = $input['video'];
            $ext = $video->extension();
            $videoName = uniqid() . "." . $ext;
            $video->move(public_path("media/violations/egy/video"), $videoName);
            $input['video'] = $videoName;
        } else {
            $input['video'] = $violation->video;
        }
        $input['involved_ids'] = $involved_ids;
        $input['involved_names'] = $involved_names;
        $input['involved_pos'] = $involved_pos;
        $input['involved_comps'] = $involved_comps;
        $input['involved_types'] = $involved_types;
        $violation->update($input);
        return redirect(route('violations.index'))->with(['success' => 'created successfully']);
    }
    public function myArea(Request $request)
    {
        $violations = Violation::where('area_res_id', auth()->user()->id)->get();
        return view('violations.myarea', compact('violations'));
    }
    public function destroy($id)
    {
        $vio = Violation::find($id);
        foreach ($vio->gallery as $img) {
            unlink('public/media/violations/egy/images/' . $img);
        }
        unlink('public/media/violations/egy/video/' . $vio->video);
        $vio->delete();
        return back();
    }
    public function export(Request $request)
    {
        return Excel::download(new ViolationsExport, 'All Egypt Violations.xlsx');
    }
    public function exportDate(Request $request)
    {
        return Excel::download(new ViolationsExport($request->date_from, $request->date_to), "$request->date_from to $request->date_to users.xlsx");
    }
}
