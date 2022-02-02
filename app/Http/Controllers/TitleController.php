<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Titles|Titles List|Title Create|Title Edit|Title Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Title Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Title Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Title Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $titles = Title::orderBy('title_name')->paginate(8);
        return view('titles.index', compact('titles'))
            ->with('i', ($request->input('page', 1) - 1) * 8);
    }
    public function create()
    {
        return view('titles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_name' => 'required|string|max:50|unique:titles,title_name',
        ]);
        Title::create([
            'title_name' => $request->title_name,
        ]);
        return back();
    }

    public function show($id)
    {
        $title = Title::find($id);
        return view('titles.show', compact('title'));
    }


    public function edit($id)
    {
        $title = Title::find($id);
        return view('Titles.edit', [
            'title' => $title,
        ]);
    }


    public function update(Request $request, $id)
    {
        $title = Title::find($id);
        $request->validate([
            'title_name' => 'required|string',
        ]);
        $title->update([
            'title_name' => $request->title_name,
        ]);
        return back();
    }

    public function destroy($id)
    {
        $title = Title::find($id);
        $title->delete();
        return redirect(route('titles.index'));
    }
}