<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Get a resource in the storage.
     *
     * @param String $login
     * @return App\User
     */
    public function user($login)
    {
        return User::where('login', $login)->first();
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
        return view('users.user');
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
            'name' => 'required',
            'login' => 'required',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'email' => 'required|email'
        ]);

        $user = User::create($request->except('_token'));

        session()->flash('message', 'Usuário criado com sucesso');
        return redirect()->route('users.edit', $user->login);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $login
     * @return \Illuminate\Http\Response
     */
    public function show($login)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $login
     * @return \Illuminate\Http\Response
     */
    public function edit($login)
    {
        $user = $this->user($login);
        return view('users.user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $login)
    {
        $request->validate([
            'name' => 'required',
            'login' => 'required',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'email' => 'required|email'
        ]);

        $this->user($login)->update($request->all());

        session()->flash('message', 'Usuário atualizado com sucesso');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy($login)
    {
        $this->user($login)->delete();
        return User::orderBy('name')->cursor();
    }

    public function search(Request $request)
    {
        return User::where('name', 'LIKE', "%{$request->filter}%")
            ->orWhere('login', 'LIKE', "%{$request->filter}%")
            ->orWhere('email', 'LIKE', "%{$request->filter}%")
            ->orderBy('name')
            ->cursor();
    }
}
