<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Companies List|Company Create|Company Edit|Company Delete|Company Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Companies List', ['only' => ['index']]);
        $this->middleware('permission:Company Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Company Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Company Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Company Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::paginate();
        return view('companies.index', compact('companies'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_name' => 'required|unique:companies,company_name',
            ]);
            Company::create([
                'company_name' => $request->company_name,
            ]);
            return redirect()->route('companies.index')->with(['success' => 'Company Created Successfully']);
        } catch (\Throwable $th) {
            return view('companies.index')->with(['error' => 'Something Went Wrong Try Again Later Or Contact With Your System Admin']);
        }
        return redirect()->route('companies.index')->with(['success' => 'Company Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return redirect()->route('companies.index')->with(['error' => 'Something Went Wrong Please Contact Your System Admin']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}