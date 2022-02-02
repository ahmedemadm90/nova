<?php

namespace App\Http\Controllers;

use App\Models\Service_Company;
use Illuminate\Http\Request;

class ServiceCompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Service Companies List|Service Company Create|Service Company Edit|Service Company Delete|Service Company Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Service Companies List', ['only' => ['index']]);
        $this->middleware('permission:Service Company Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Service Company Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Service Company Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Service Company Show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        $companies = Service_Company::paginate(5);
        return view('service companies.index', compact('companies'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service companies.create');
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
            'company_name' => 'required|string',
            'owner' => 'required|string',
            'active' => 'in:0,1'
        ]);
        if (!isset($input['active'])) {
            $input['active'] = '0';
        } else {
            $input['active'] = '1';
        }
        Service_Company::create($input);
        return redirect()->route('service.companies.index')->with(['success' => 'Company Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service_Company  $service_Company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Service_Company::find($id);
        return view('service companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service_Company  $service_Company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Service_Company::find($id);
        if ($company) {
            return view('service companies.edit', compact('company'));
        } else {
            return redirect()->route('service.companies.index')->with(['error' => 'Something Went Wrong Please Contact Your System Admin']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service_Company  $service_Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $company = Service_Company::find($id);
        $request->validate([
            'company_name' => 'required|string',
            'owner' => 'required|string',
            'active' => 'in:0,1'
        ]);
        if (isset($input['active'])) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        $company->update($input);
        return redirect()->route('service.companies.index')->with(['success' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service_Company  $service_Company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Service_Company::find($id);
        $company->delete();
        return redirect()->route('service.companies.index')->with(['success' => 'Deleted Successfully']);
    }
}