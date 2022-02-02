<?php

namespace App\Http\Controllers;

use App\Exports\WorkersExport;
use App\Models\Area;
use App\Models\Company;
use App\Models\Country;
use App\Models\Location;
use App\Models\Title;
use App\Models\Type;
use App\Models\Vp;
use App\Models\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class WorkerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Workers List|Worker Create|Worker Edit|Worker Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Worker Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Worker Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Worker Delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $workers = Worker::simplePaginate(15);
        return view('workers.index', [
            'workers' => $workers,
        ]);
    }


    public function create()
    {
        $vps = Vp::get();
        $areas = Area::get();
        $admins = Worker::orderBy('name')->get();
        $titles = Title::orderby('title_name')->get();
        $types = Type::orderby('type_name')->get();
        $companies = Company::orderby('company_name')->get();
        $countries = Country::orderby('country_name')->get();
        $locations = Location::orderby('location_name')->get();
        return view(
            'workers.create',
            [
                "vps" => $vps,
                "areas" => $areas,
                'admins' => $admins,
                'titles' => $titles,
                'types' => $types,
                'companies' => $companies,
                'countries' => $countries,
                'countries' => $countries,
            ]
        );
    }
    public function store(Request $request)
    {
        $input = $request->all();
        //dd($input);
        $request->validate([
            'id' => 'required|max:20|unique:workers,id',
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:25',
            'title_id' => 'required',
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'country_id' => 'required|exists:countries,id|numeric',
            'location_id' => 'required|exists:locations,id|numeric',
            'type_id' => 'required|string|max:15',
            'company_id' => 'required|exists:companies,id|numeric',
            'state' => 'required|string',
            'worker_manager_id' => 'exists:workers,id|nullable',
            'img' => 'file',
        ]);
        if (!isset($input['area_res'])) {
            $input['area_res'] = '0';
        } else {
            $input['area_res'] = '1';
        }
        $img = $request->img;
        $ext = $img->extension();
        $imgname = "$request->id-img" . ".$ext";
        $img->move(public_path("media/workers"), $imgname);
        $input['img'] = $imgname;
        Worker::create($input);
        return back();
    }


    public function show($id)
    {
        $worker = Worker::find($id);
        return view('workers.edit', [
            'worker' => $worker,
        ]);
    }

    public function edit($id)
    {
        $vps = Vp::get();
        $areas = Area::get();
        $admins = Worker::select('id', 'name', 'position')->where('area_res', 1)->get();
        $titles = Title::get();
        $worker = Worker::find($id);
        $types = Type::get();
        return view('workers.edit', [
            'worker' => $worker,
            "vps" => $vps,
            "areas" => $areas,
            'admins' => $admins,
            'titles' => $titles,
            'types' => $types,
        ]);
    }


    public function update(Request $request, $id)
    {
        $worker = Worker::find($id);
        $imgName = $worker->img;
        $request->validate([
            'name' => 'required|string|max:100',
            'job' => 'required|string|max:25',
            'title_id' => 'required',
            'vp_id' => 'required|exists:vps,id',
            'area_id' => 'required|exists:areas,id',
            'type_id' => 'required|string|max:15',
            'company' => 'required|string|max:50',
            'state' => 'required|string|max:50',
        ]);
        $input = $request->all();
        if ($request->hasFile('img')) {
            unlink(public_path("media/$worker->img"));
            $img = $request->img;
            $ext = $img->extension();
            $imgName = "$request->id-img" . ".$ext";
            $img->move(public_path("media"), $imgName);
        };
        $worker->update($input);
        return redirect(route('workers.index'))->with(['success'=>'updated successfully']);
    }


    public function destroy($id)
    {
        $worker = Worker::find($id);
        try {
            $worker->delete();
            unlink(public_path("media/$worker->img"));
        } catch (Throwable $e) {
            report($e);
        }
        return redirect(route('workers.index'));
    }
    public function export()
    {
        return Excel::download(new WorkersExport, "All Plant Workers.xlsx");
    }
}
