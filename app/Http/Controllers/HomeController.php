<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Uae_Violation;
use App\Models\User;
use App\Models\Violation;
use App\Models\ViolationType;
use App\Models\Vp;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('users.create');
    }
    public function dashboard()
    {
        $egy = Violation::where('register_by',Auth::user()->id)->count();
        $uae = Uae_Violation::where('register_by',Auth::user()->id)->count();
        /* End User Egy Dashboards */
        $id = Auth::user()->id;
        $user_egyvps = [];
        $user_egyvps_count = [];
        $user_uaevps = [];
        $user_uaevps_count = [];
        $egyUserVps = Violation::select('vp_id')->where('register_by',"$id")->groupBy('vp_id')->get();
        $uaeUserVps = Uae_Violation::select('vp_id')->where('register_by',"$id")->groupBy('vp_id')->get();
        foreach ($egyUserVps as $violation) {
            $vp = Vp::where('id',$violation->vp_id)->first();
            array_push($user_egyvps,$vp->vp_name);
            $user_violation_count = Violation::where('vp_id',$vp->id)->where('register_by',"$id")->groupBy('vp_id')->count();
            array_push($user_egyvps_count,$user_violation_count);
        }
        $user_egy_dataset = array_combine($user_egyvps,$user_egyvps_count);
        foreach ($uaeUserVps as $violation) {
            $vp = Vp::where('id',$violation->vp_id)->first();
            array_push($user_uaevps,$vp->vp_name);
            $user_violation_count = Uae_Violation::where('vp_id',$vp->id)->where('register_by',"$id")->groupBy('vp_id')->count();
            array_push($user_uaevps_count,$user_violation_count);
        }
        $user_uae_dataset = array_combine($user_uaevps,$user_uaevps_count);

        $user_egy_vios_chart = app()->chartjs
            ->name('user_egy_vios_chart')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($user_egy_dataset))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($user_egy_dataset),
                ]
            ])
            ->options([
                'legend' => [
                    'display' => false,
                ]
            ]);
            $user_uae_vios_chart = app()->chartjs
            ->name('user_uae_vios_chart')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($user_uae_dataset))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($user_uae_dataset),
                ]
            ])
            ->options([
                'legend' => [
                    'display' => false,
                ]
            ]);

        /* Egy Dashboards */
        /* Start Of Data And Chart Of egy Violations By Area Chart */
        $egyareas = [];
        $egyvios_count = [];
        $egyvps = Violation::select('vp_id')->groupBy('vp_id')->get();
        foreach ($egyvps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Violation::where('vp_id', $vp->vp_id)->groupBy('vp_id')->count();
            array_push($egyareas, $find->vp_name);
            array_push($egyvios_count, $count);
        }
        $egydataSet = array_combine($egyareas, $egyvios_count);
        asort($egydataSet);
        $egyviolationsbyarea = app()->chartjs
            ->name('byAreaChart2')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($egydataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($egydataSet),
                ]
            ])
            ->options([
                'legend' => [
                    'display' => false,
                ]
            ]);
        /* End Of Data And Chart Of egy Violations By Area Chart */

        /*Start Of Data And Chart Of egy Violations By Classification Chart */
        $egytypesArr = [];
        $egytypes_count = [];
        $egytypes = Violation::select('classification')->groupBy('classification')->get();
        foreach ($egytypes as $type) {
            $type_name = ViolationType::where('id', $type->classification)->first();
            $type_count = Violation::where('classification', $type->classification)->count();
            array_push($egytypesArr, $type_name->classification);
            array_push($egytypes_count, $type_count);
        }
        $egytypesdataSet = array_combine($egytypesArr, $egytypes_count);
        asort($egytypesdataSet);
        $egyviolationsbyclassification = app()->chartjs
            ->name('egybarChart')
            ->type('bar')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($egytypesdataSet))
            ->datasets([
                [
                    "label" => ["Violation Classification Count"],
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($egytypesdataSet)
                ],
            ])
            ->options([
                'tooltips' => [
                    'display' => false,
                ]
            ]);
        /* End Egy Dashboard */
        /* Start Of Data And Chart Of UAE Violations By Area Chart */
        $areas = [];
        $vios_count = [];
        $vps = Uae_Violation::select('vp_id')->groupBy('vp_id')->get();
        foreach ($vps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Uae_Violation::where('vp_id', $vp->vp_id)->groupBy('vp_id')->count();
            array_push($areas, $find->vp_name);
            array_push($vios_count, $count);
        }
        $dataSet = array_combine($areas, $vios_count);
        asort($dataSet);

        $uaeviolationsbyarea = app()->chartjs
            ->name('egybyAreaChart')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($dataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($dataSet),
                ]
            ])
            ->options([
                'legend' => [
                    'display' => false,
                ]
            ]);
        /* End Of Data And Chart Of UAE Violations By Area Chart */
        /*Start Of Data And Chart Of UAE Violations By Classification Chart */
        $typesArr = [];
        $types_count = [];
        $types = Uae_Violation::select('classification')->groupBy('classification')->get();
        foreach ($types as $type) {
            $type_name = ViolationType::where('id', $type->classification)->first();
            $type_count = Uae_Violation::where('classification', $type->classification)->count();
            array_push($typesArr, $type_name->classification);
            array_push($types_count, $type_count);
        }
        $typesdataSet = array_combine($typesArr, $types_count);
        asort($typesdataSet);
        $uaeviolationsbyclassification = app()->chartjs
            ->name('barChartTest1')
            ->type('bar')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($typesdataSet))
            ->datasets([
                [
                    "label" => ["Violation Classification Count"],
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($typesdataSet)
                ],
            ])
            ->options([
                'tooltips' => [
                    'display' => false,
                ]
            ]);
        /*Start Of Data And Chart Of UAE Violations By Classification Chart */
        $users = User::count();
        $workers = Worker::count();
        $vps = Vp::count();
        $areas = Area::count();
        return view('dashboard', [
            'users' => $users,
            'workers' => $workers,
            'uaeviolationsbyarea' => $uaeviolationsbyarea,
            'egyviolationsbyarea' => $egyviolationsbyarea,
            'uaeviolationsbyclassification' => $uaeviolationsbyclassification,
            'egyviolationsbyclassification' => $egyviolationsbyclassification,
            'dataSet' => $dataSet,
            'egydataSet' => $egydataSet,
            'typesdataSet' => $typesdataSet,
            'egytypesdataSet' => $egytypesdataSet,
            'egy' => $egy,
            'uae' => $uae,
            'user_uae_dataset' => $user_uae_dataset,
            'user_egy_dataset' => $user_egy_dataset,
            'user_egy_vios_chart' => $user_egy_vios_chart,
            'user_uae_vios_chart' => $user_uae_vios_chart,
        ]);
    }
    public function dashboardByDate(Request $request)
    {
        /* Start Egy Date Dashboard */
        $egyareas = [];
        $egyvios_count = [];
        $vps = Violation::select('vp_id')
            ->whereBetween('date', [$request->date_from, $request->date_to])
            ->groupBy('vp_id')->get();
        foreach ($vps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Violation::where('vp_id', $vp->vp_id)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->groupBy('vp_id')->count();
            array_push($egyareas, $find->vp_name);
            array_push($egyvios_count, $count);
        }
        //dd($egyvios_count);
        $egydataSet = array_combine($egyareas, $egyvios_count);
        asort($egydataSet);
        $egyviolationsbyarea = app()->chartjs
            ->name('egyByArea')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($egydataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($egydataSet),
                ]
            ])
            ->options([]);

        $egytypesArr = [];
        $egytypes_count = [];
        $egytypes = Violation::select('classification')->groupBy('classification')
            ->whereBetween('date', [$request->date_from, $request->date_to])->get();
        foreach ($egytypes as $type) {
            $type_name = ViolationType::where('id', $type->classification)->first();
            $type_count = Violation::where('classification', $type->classification)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->count();
            array_push($egytypesArr, $type_name->classification);
            array_push($egytypes_count, $type_count);
        }
        $egytypesdataSet = array_combine($egytypesArr, $egytypes_count);
        asort($egytypesdataSet);
        $egyviolationsbyclassification = app()->chartjs
            ->name('egyByClassification')
            ->type('bar')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($egytypesdataSet))
            ->datasets([
                [
                    "label" => ["Violation Classification Count"],
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($egytypesdataSet)
                ],
            ])
            ->options([
                'tooltips' => [
                    'display' => false,
                ]
            ]);
        /* End Egy Date Dashboard */

        /* Start Of Data And Chart Of UAE Violations By Area Chart */
        $areas = [];
        $vios_count = [];
        $vps = Uae_Violation::select('vp_id')
            ->whereBetween('date', [$request->date_from, $request->date_to])
            ->groupBy('vp_id')->get();
        foreach ($vps as $vp) {
            $find = Vp::where('id', $vp->vp_id)->first();
            $count = Uae_Violation::where('vp_id', $vp->vp_id)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->groupBy('vp_id')->count();
            array_push($areas, $find->vp_name);
            array_push($vios_count, $count);
        }
        $dataSet = array_combine($areas, $vios_count);
        asort($dataSet);

        $uaeviolationsbyarea = app()->chartjs
            ->name('uaeByArea')
            ->type('pie')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($dataSet))
            ->datasets([
                [
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($dataSet),
                ]
            ])
            ->options([]);
        /* End Of Data And Chart Of UAE Violations By Area Chart */
        /*Start Of Data And Chart Of UAE Violations By Classification Chart */
        $typesArr = [];
        $types_count = [];
        $types = Uae_Violation::select('classification')->groupBy('classification')
            ->whereBetween('date', [$request->date_from, $request->date_to])->get();
        foreach ($types as $type) {
            $type_name = ViolationType::where('id', $type->classification)->first();
            $type_count = Uae_Violation::where('classification', $type->classification)
                ->whereBetween('date', [$request->date_from, $request->date_to])
                ->count();
            array_push($typesArr, $type_name->classification);
            array_push($types_count, $type_count);
        }
        $typesdataSet = array_combine($typesArr, $types_count);
        asort($typesdataSet);
        $uaeviolationsbyclassification = app()->chartjs
            ->name('uaeByClassification')
            ->type('bar')
            ->size(['width' => 200, 'height' => 200])
            ->labels(array_keys($typesdataSet))
            ->datasets([
                [
                    "label" => ["Violation Classification Count"],
                    'backgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'hoverBackgroundColor' => [
                        '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                        '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                    ],
                    'data' => array_values($typesdataSet)
                ],
            ])
            ->options([
                'tooltips' => [
                    'display' => false,
                ]
            ]);
        /*Start Of Data And Chart Of UAE Violations By Classification Chart */
        $users = User::count();
        $workers = Worker::count();
        $vps = Vp::count();
        $areas = Area::count();
        return view('dashboard_statistical', [
            'users' => $users,
            'workers' => $workers,
            'uaeviolationsbyarea' => $uaeviolationsbyarea,
            'uaeviolationsbyclassification' => $uaeviolationsbyclassification,
            'dataSet' => $dataSet,
            'typesdataSet' => $typesdataSet,
            'egyviolationsbyarea' => $egyviolationsbyarea,
            'egyviolationsbyclassification' => $egyviolationsbyclassification,
            'egydataSet' => $egydataSet,
            'egytypesdataSet' => $egytypesdataSet,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
        ]);
    }
    public function testDashboard()
    {
        $egyvps = Vp::where('region_id', 1)->get();
        $uaevps = Vp::where('region_id', 2)->get();
        return view('testdashboard', compact('egyvps', 'uaevps'));
    }
    public function replytestDashboard(Request $request)
    {
        $input = $request->all();
        $input = Arr::except($input, array('_token', 'date_from', 'date_to'));
        if (empty($input)) {
            return redirect(route('test.dashboard'))->with(['error' => 'Please Select Business Area']);
        }
        $date_from = $request->date_from;
        $date_to =  $request->date_to;
        $egyVps = [];
        $egyVpsViosCount = [];
        $uaeVps = [];
        $uaeVpsViosCount = [];
        $egySum = 0;
        $uaeSum = 0;

        if (!isset($date_from, $date_to)) {
            if (isset($request->egyvps)) {
                foreach ($request->egyvps as $vp) {
                    $vp_name = Vp::where('id', $vp)->first();
                    $viocount = Violation::where('vp_id', $vp)->count();
                    array_push($egyVps, $vp_name->vp_name);
                    array_push($egyVpsViosCount, $viocount);
                }
            }
            if (isset($request->uaevps)) {
                foreach ($request->uaevps as $vp) {
                    $vp_name = Vp::where('id', $vp)->first();
                    $viocount = Uae_Violation::where('vp_id', $vp)->count();
                    array_push($uaeVps, $vp_name->vp_name);
                    array_push($uaeVpsViosCount, $viocount);
                }
            }
            $egyDataset = array_combine($egyVps, $egyVpsViosCount);
            $uaeDataset = array_combine($uaeVps, $uaeVpsViosCount);
            $egyviolationsbyarea = app()->chartjs
                ->name('egyByVP')
                ->type('bar')
                ->size(['width' => 200, 'height' => 200])
                ->labels(array_keys($egyDataset))
                ->datasets([
                    [
                        "label" => "EGY VPs",
                        'backgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'hoverBackgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'data' => array_values($egyDataset),
                    ]
                ])
                ->options([]);
            $uaeviolationsbyarea = app()->chartjs
                ->name('uaeByVP')
                ->type('bar')
                ->size(['width' => 200, 'height' => 200])
                ->labels(array_keys($uaeDataset))
                ->datasets([
                    [
                        "label" => "UAE VPs",
                        'backgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'hoverBackgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'data' => array_values($uaeDataset),
                    ]
                ])->options([]);
            $egyvpsids = [];
            $uaevpsids = [];
            $egyTypes = [];
            $egyTypesCount = [];
            $uaeTypes = [];
            $uaeTypesCount = [];
            $egyTotal = 0;
            $uaeTotal = 0;
            if (!empty($egyVps)) {
                foreach ($egyVps as $vp_name) {
                    $vp = Vp::where('vp_name', $vp_name)->first();
                    array_push($egyvpsids, $vp->id);
                }
                foreach ($egyvpsids as $vp_id) {
                    //get classifications id and names
                    $types = Violation::select('classification')->where('vp_id', $vp_id)->groupBy('classification')->get();
                    foreach ($types as $type) {
                        array_push($egyTypes, $type->vioType->classification);
                        $type_count = Violation::where('classification', $type->classification)
                            ->whereIn('vp_id', $egyvpsids)
                            ->groupBy('classification')->count();
                        array_push($egyTypesCount, $type_count);
                    }
                }
                $egyDataset = array_combine($egyTypes, $egyTypesCount);
                //dd(array_values($egyDataset));
                for ($i = 0; $i < count($egyDataset); $i++) {
                    $egyTotal = $egyTotal + array_values($egyDataset)[$i];
                }
            }
            if (!empty($uaeVps)) {
                foreach ($uaeVps as $vp_name) {
                    $vp = Vp::where('vp_name', $vp_name)->first();
                    array_push($uaevpsids, $vp->id);
                }
                foreach ($uaevpsids as $vp_id) {
                    //get classifications id and names
                    $types = Uae_Violation::select('classification')->where('vp_id', $vp_id)->groupBy('classification')->get();
                    foreach ($types as $type) {
                        array_push($uaeTypes, $type->vioType->classification);
                        $type_count = Uae_Violation::where('classification', $type->classification)
                            ->whereIn('vp_id', $uaevpsids)->groupBy('classification')->count();
                        array_push($uaeTypesCount, $type_count);
                    }
                }
                $uaeDataset = array_combine($uaeTypes, $uaeTypesCount);

                for ($i = 0; $i < count($uaeDataset); $i++) {
                    $uaeTotal = $uaeTotal + array_values($uaeDataset)[$i];
                }
            }
            return view('replydashboard', compact(
                'egyviolationsbyarea',
                'uaeviolationsbyarea',
                'egyDataset',
                'uaeDataset',
                'egyTotal',
                'uaeTotal',
            ));
        }
        if (isset($date_from, $date_to)) {
            if (isset($request->egyvps)) {
                foreach ($request->egyvps as $vp) {
                    $vp_name = Vp::where('id', $vp)->first();
                    $viocount = Violation::where('vp_id', $vp)->whereBetween('date', [$date_from, $date_to])->count();
                    array_push($egyVps, $vp_name->vp_name);
                    array_push($egyVpsViosCount, $viocount);
                }
            }
            if (isset($request->uaevps)) {
                foreach ($request->uaevps as $vp) {
                    $vp_name = Vp::where('id', $vp)->first();
                    $viocount = Uae_Violation::where('vp_id', $vp)
                        ->whereBetween('date', [$date_from, $date_to])->count();
                    array_push($uaeVps, $vp_name->vp_name);
                    array_push($uaeVpsViosCount, $viocount);
                }
            }
            $egyDataset = array_combine($egyVps, $egyVpsViosCount);
            $uaeDataset = array_combine($uaeVps, $uaeVpsViosCount);

            $egyviolationsbyarea = app()->chartjs
                ->name('egyByVP')
                ->type('bar')
                ->size(['width' => 200, 'height' => 200])
                ->labels(array_keys($egyDataset))
                ->datasets([
                    [
                        'backgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'hoverBackgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'data' => array_values($egyDataset),
                    ]
                ])
                ->options([]);
            $uaeviolationsbyarea = app()->chartjs
                ->name('uaeByVP')
                ->type('bar')
                ->size(['width' => 200, 'height' => 200])
                ->labels(array_keys($uaeDataset))
                ->datasets([
                    [
                        "label" => "UAE VPs",
                        'backgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'hoverBackgroundColor' => [
                            '#FF2E63', '#08D9D6', '#252A34', '#F08A5D', '#F38181', '#364F6B',
                            '#E84545', '#E23E57', '#00B8A9', '#F6416C', '#14FFEC', '#EA5455',
                        ],
                        'data' => array_values($uaeDataset),
                    ]
                ])->options([]);
            /* Get Violation Types */
            $egyvpsids = [];
            $uaevpsids = [];
            $egyTypes = [];
            $egyTypesCount = [];
            $uaeTypes = [];
            $uaeTypesCount = [];
            $egyTotal = 0;
            $uaeTotal = 0;
            if (!empty($egyVps)) {
                foreach ($egyVps as $vp_name) {
                    $vp = Vp::where('vp_name', $vp_name)->first();
                    array_push($egyvpsids, $vp->id);
                }
                foreach ($egyvpsids as $vp_id) {
                    //get classifications id and names
                    $types = Violation::select('classification')->whereBetween('date', [$date_from, $date_to])->where('vp_id', $vp_id)
                        ->groupBy('classification')->get();
                    foreach ($types as $type) {
                        array_push($egyTypes, $type->vioType->classification);
                        $type_count = Violation::where('classification', $type->classification)
                            ->whereBetween('date', [$date_from, $date_to])
                            ->whereIn('vp_id', $egyvpsids)->groupBy('classification')->count();
                        array_push($egyTypesCount, $type_count);
                    }
                }
                $egyDataset = array_combine($egyTypes, $egyTypesCount);
                $egyTotal = 0;
                for ($i = 0; $i < count($egyDataset); $i++) {
                    $egyTotal = $egyTotal + array_values($egyDataset)[$i];
                }
            }

            if (!empty($uaeVps)) {
                foreach ($uaeVps as $vp_name) {
                    $vp = Vp::where('vp_name', $vp_name)->first();
                    array_push($uaevpsids, $vp->id);
                }
                foreach ($uaevpsids as $vp_id) {
                    //get classifications id and names
                    $types = Uae_Violation::select('classification')->where('vp_id', $vp_id)->groupBy('classification')->get();
                    foreach ($types as $type) {
                        array_push($uaeTypes, $type->vioType->classification);
                        $type_count = Uae_Violation::whereBetween('date', [$date_from, $date_to])
                            ->where('classification', $type->classification)
                            ->whereIn('vp_id', $uaevpsids)
                            ->groupBy('classification')->count();
                        array_push($uaeTypesCount, $type_count);
                    }
                }
                $uaeDataset = array_combine($uaeTypes, $uaeTypesCount);
                for ($i = 0; $i < count($uaeDataset); $i++) {
                    $uaeTotal = $uaeTotal + array_values($uaeDataset)[$i];
                }
            }

            /* End Violation Types */
            return view('replydashboard', compact(
                'egyviolationsbyarea',
                'uaeviolationsbyarea',
                'egyDataset',
                'uaeDataset',
                'egyTotal',
                'uaeTotal',
            ));
        }
    }
}
