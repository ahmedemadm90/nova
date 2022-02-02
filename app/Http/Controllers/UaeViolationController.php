<?php

namespace App\Http\Controllers;

use App\Exports\Uae_ViolationsExport;
use App\Models\Area;
use App\Models\Uae_Violation;
use App\Models\ViolationType;
use App\Models\Vp;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UaeViolationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Uae Violations|Uae Violations List|Uae Violation Create|Uae Violation Edit|Uae Violation Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Uae Violation Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Uae Violation Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Uae Violation Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vios = Uae_Violation::orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(50);
        return view('uae.index', compact('vios'));
    }
    public function indexDate(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $vios = Uae_Violation::whereBetween('date', [$date_from, $date_to])->orderBy('date')->simplepaginate(10);
        return view('uae.dateresults', compact('vios', 'date_from', 'date_to'));
    }
    public function indexType(Request $request)
    {
        $uaeVps = [];
        $uaeViosCount = [];
        $type = ViolationType::where('classification', $request->type)->first();
        $getuaevps = Uae_Violation::select('vp_id')
            ->where('classification', $type->id)
            ->groupBy('vp_id')->get();
        foreach ($getuaevps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Uae_Violation::where('vp_id', $vp->vp_id)
                ->where('classification', $type->id)
                ->groupBy('vp_id')->count();
            array_push($uaeVps, $find->vp_name);
            array_push($uaeViosCount, $count);
        }
        $vpsdataSet = array_combine($uaeVps, $uaeViosCount);
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
        $uaeVps = [];
        $uaeViosCount = [];
        $type = ViolationType::where('classification', $request->type)->first();
        /* Start Of Type Statics */
        $getuaevps = Uae_Violation::select('vp_id')
            ->where('classification', $type->id)
            ->whereBetween('date', [$request->date_from, $request->date_to])
            ->groupBy('vp_id')->get();
        foreach ($getuaevps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Uae_Violation::where('vp_id', $vp->vp_id)
                ->where('classification', $type->id)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->groupBy('vp_id')->count();
            array_push($uaeVps, $find->vp_name);
            array_push($uaeViosCount, $count);
        }
        $vpsdataSet = array_combine($uaeVps, $uaeViosCount);

        $OneType = app()->chartjs
            ->name('uaetype')
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
    public function exportDate(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        return Excel::download(new Uae_ViolationsExport($date_from, $date_to), "$date_from to $date_to users.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vps = Vp::whereIn('vp_name', ['al-qouz', 'j-ali', 'abu-dhabi'])->get();
        $areas = Area::where('vp_id', $request->id);
        $workers = Worker::where('country_id', '2')->get();
        $types = ViolationType::get();
        return view('uae.create', compact('vps', 'areas', 'types', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_arr = [];
        $name_arr = [];
        $gallery = [];
        $request->validate([
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'date' => 'required|string',
            'time' => 'required|string',
            'type' => 'required|string',
            'classification' => 'required',
            'description' => 'required|string',
            'action' => 'required|string',
            'involved_id' => 'nullable|array',
            'outsource_ids' => 'nullable',
            'outsource_names' => 'nullable',
            'gallery' => 'required',
            'gallery.*' => 'file',
            'video' => 'file|mimes:mp4,flv',
        ]);
        $input = $request->all();
        if (isset($input['involved_id'])) {
            foreach ($input['involved_id'] as $id) {
                array_push($id_arr, $id);
                $name = Worker::find($id);
                array_push($name_arr, $name->name);
            }
        }
        if (isset($input['outsource_ids'])) {
            foreach ($input['outsource_ids'] as $id) {
                array_push($id_arr, $id);
            }
            foreach ($input['outsource_names'] as $name) {
                array_push($name_arr, $name);
            }
        }
        $input['involved_ids'] = $id_arr;
        $input['involved_names'] = $name_arr;
        foreach ($input['gallery'] as $galleryImg) {
            $ext = $galleryImg->extension();
            $imageName = uniqid() . "." . $ext;
            array_push($gallery, $imageName);
            $galleryImg->move(public_path("media/violations/uae/images"), $imageName);
        }
        $video = $input['video'];
        $ext = $video->extension();
        $videoName = uniqid() . "." . $ext;
        $video->move(public_path("media/violations/uae/video"), $videoName);
        $input['gallery'] = $gallery;
        $input['video'] = $videoName;
        $input['register_by'] = Auth::user()->id;
        Uae_Violation::create($input);
        return redirect()->route('uae.violations.index')->with(['success' => 'Violation Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Uae_Violation  $uae_Violation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vio = Uae_Violation::find($id);
        $outsource_ids = [];
        $outsource_names = [];
        $insource_ids = [];
        $insource_names = [];
        $workers = Worker::where('country_id', '2')->orderBy('name')->get();
        foreach ($vio->involved_ids as $id) {
            $worker = Worker::find($id);
            if (!$worker) {
                array_push($outsource_ids, $id);
            } else {
                array_push($insource_ids, $id);
            }
        }
        foreach ($vio->involved_names as $name) {
            $worker = Worker::where('name', $name)->first();
            if (!$worker) {
                array_push($outsource_names, $name);
            } else {
                array_push($insource_names, $name);
            }
        }
        $outsource = array_combine($outsource_ids, $outsource_names);
        $insource = array_combine($insource_ids, $insource_names);

        return view('uae.show', compact(
            'vio',
            'outsource',
            'insource',
            'workers',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Uae_Violation  $uae_Violation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $outsource_ids = [];
        $outsource_names = [];
        $insource_ids = [];
        $insource_names = [];
        $violation = Uae_Violation::find($id);
        $vps = Vp::whereIn('vp_name', ['al-qouz', 'j-ali', 'abu-dhabi'])->get();
        $areas = Area::where('vp_id', $request->id);
        $workers = Worker::where('country_id', '2')->get();
        $types = ViolationType::get();
        foreach ($violation->involved_ids as $id) {
            $worker = Worker::find($id);
            if (!$worker) {
                array_push($outsource_ids, $id);
            } else {
                array_push($insource_ids, $id);
            }
        }
        foreach ($violation->involved_names as $name) {
            $worker = Worker::where('name', $name)->first();
            if (!$worker) {
                array_push($outsource_names, $name);
            } else {
                array_push($insource_names, $name);
            }
        }
        $outsource = array_combine($outsource_ids, $outsource_names);
        $insource = array_combine($insource_ids, $insource_names);
        return view('uae.edit', compact(
            'violation',
            'vps',
            'areas',
            'workers',
            'types',
            'outsource',
            'insource'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Uae_Violation  $uae_Violation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_id_arr = [];
        $update_name_arr = [];
        $vio = Uae_Violation::find($id);
        $input = $request->all();
        $request->validate([
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'date' => 'required|string',
            'time' => 'required|string',
            'type' => 'required|string',
            'classification' => 'required',
            'description' => 'required|string',
            'action' => 'required|string',
            'involved_id' => 'nullable|array',
            'outsource_ids' => 'nullable',
            'outsource_names' => 'nullable',
        ]);
        if (isset($input['involved_id'])) {

            foreach ($input['involved_id'] as $id) {
                array_push($update_id_arr, $id);
                $name = Worker::find($id);
                array_push($update_name_arr, $name->name);
            }
        }
        foreach ($input['outsource_ids'] as $id) {
            array_push($update_id_arr, $id);
        }
        foreach ($input['outsource_names'] as $name) {
            array_push($update_name_arr, $name);
        }
        $input['involved_ids'] = $update_id_arr;
        $input['involved_names'] = $update_name_arr;
        if ($request->hasFile('gallery')) {
            foreach ($vio->gallery as $img) {
                //unlink("media/violations/uae/images/$img");
            }
            $galleryUpdate = [];
            foreach ($input['gallery'] as $galleryImg) {
                $ext = $galleryImg->extension();
                $imageName = uniqid() . "." . $ext;
                array_push($galleryUpdate, $imageName);
                $galleryImg->move(public_path("media/violations/uae/images"), $imageName);
            }
            $input['gallery'] = $galleryUpdate;
        } else {
            $input['gallery'] = $vio->gallery;
        }
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'required|file|mimes:flv,mp4',
            ]);
            //unlink("media/violations/uae/video/$vio->video");
            $video = $input['video'];
            $ext = $video->extension();
            $videoName = uniqid() . "." . $ext;
            $video->move(public_path("media/uae/video"), $videoName);
            $input['video'] = $videoName;
        } else {
            $input['video'] = $vio->video;
        }
        $vio->update($input);
        return redirect()->route('uae.violations.index')->with(['success' => 'Violation Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Uae_Violation  $uae_Violation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vio = Uae_Violation::find($id);
        foreach ($vio->gallery as $img) {
            unlink('public/media/violations/uae/images/' . $img);
        }
        unlink('public/media/violations/uae/video/' . $vio->video);
        $vio->delete();
        return back();
    }
    public function export(Request $request)
    {
        return Excel::download(new Uae_ViolationsExport(), 'All UAE Violations.xlsx');
    }
}
