<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Users Index|User Create|User Edit|User Show|User Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:User Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:User Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:User Show', ['only' => ['show']]);
        $this->middleware('permission:User Delete', ['only' => ['destroy']]);
    }
    protected function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        $groups = Group::get();
        return view('users.index', compact('data', 'groups'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $groups = Group::get();
        return view('users.create', compact('roles', 'groups'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:workers,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'groups' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $groups = Group::get();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole', 'groups'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'groups' => 'required|array'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['groups'] = $request->groups;
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
