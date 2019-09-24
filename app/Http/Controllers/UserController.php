<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Get a resource in the storage.
     *
     * @return App\Role $roles
     */
    public function roles()
    {
        return Role::groups()->get();
    }

    /**
     * Get a resource in the storage.
     *
     * @param String $username
     * @return App\User
     */
    public function user($username)
    {
        return User::with('companies')->where('username', $username)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roles();
        return view('users.user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'role_id' => 'required',
            'username' => 'required',
        ]);

        $user = User::create($request->except('_token'));

        session()->flash('message', 'Usuário criado com sucesso');
        return redirect()->route('users.edit', $user->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $companies = Company::orderBy('name')->get();
        $roles = $this->roles();
        $user = $this->user($username);

        return view('users.user', compact('companies', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'role_id' => 'required',
            'username' => 'required',
        ]);

        $this->user($username)->update($request->all());

        session()->flash('message', 'Usuário atualizado com sucesso');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $this->user($username)->delete();
        return User::orderBy('name')->cursor();
    }

    /**
     * Find resources based on terms
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return User::where('name', 'LIKE', "%{$request->filter}%")
            ->orWhere('username', 'LIKE', "%{$request->filter}%")
            ->orWhere('email', 'LIKE', "%{$request->filter}%")
            ->orderBy('name')
            ->cursor();
    }

    /**
     * Associates Company to User
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function associateCompanyToUser(Request $request, $username)
    {
        $user = $this->user($username);
        $user->companies()->toggle($request->company_id);

        return response()->json($user->refresh()->companies, 200);
    }

    /**
     * Attach all companies to the User
     * 
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function attachAllCompaniesToUser($username)
    {
        $companies = Company::get()->pluck('id');
        $user = $this->user($username);
        $user->companies()->attach($companies);

        return response()->json($user->refresh()->companies, 200);
    }

    /**
     * Detach all companies to the User
     * 
     * @param  String  $username
     * @return \Illuminate\Http\Response
     */
    public function detachAllCompaniesFromUser($username)
    {
        $user = $this->user($username);
        $user->companies()->detach();

        return response()->json($user->refresh()->companies, 200);
    }
}
