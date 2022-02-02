<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Types|Types List|Type Create|Type Edit|Type Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Type Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Type Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Type Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $types = Type::orderBy('type_name')->paginate(5);
        return view('types.index', compact('types'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('types.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:50',
        ]);
        Type::create([
            'type_name' => $request->type_name,
        ]);
        return redirect()->route('types.index');
    }
    public function edit($id)
    {
        $type = Type::find($id);
        return view('types.edit', [
            'type' => $type,
        ]);
    }
    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        $request->validate([
            'type_name' => 'required|string|max:50',
        ]);
        $type->update([
            'type_name' => $request->type_name,
        ]);
        return back();
    }
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();
        return back();
    }
}