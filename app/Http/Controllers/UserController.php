<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $all_users = User::all();
        $users = User::orderBy('name')->paginate(10);
        $total_users = $all_users->count();

        $logged_user = auth()->user()->id;  // id do usuário logado

        // dd($logged_user);
        return view('users.index', ['users' => $users, 'all_users' => $all_users, 'total_users' => $total_users, 'logged_user' => $logged_user]);
    }

    public function create()
    {
        $levels = [0, 1, 2];
        return view('users.create', ['levels' => $levels]);
    }

    public function store(UserCreateRequest $request)
    {
        // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(10);
        $user->level = $request->level;
        $user->save();

        Session::flash('message', 'Usuário cadastrado com sucesso!');

        return redirect()->route('users.index');
    }

    public function show($id)
    {

        $user = User::find($id);

        // $quotations = $user->quotations()->get()->sortByDesc('created_at');
        // $total_quotations = $quotations->count();

        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        
        $levels = [0, 1, 2];
        $user_level = $user->level;
        $logged_user = auth()->user()->id;
        $users = User::all();

        if (auth()->user()->level == 1) {
            return view('users.edit', ['users' => $users, 'user' => $user, 'levels' => $levels, 'user_level' => $user_level]);
        } else if (auth()->user()->level == 2 && $user->id != 1) {
            return view('users.edit', ['users' => $users, 'user' => $user, 'levels' => $levels, 'user_level' => $user_level]);
        }


        Session::flash('message2', 'Você não tem permissão para realizar essa operação!');
        return redirect()->route('users.index');

    }

    public function update(UserEditRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $users = User::all();

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        };

        $user->update();

        Session::flash('message', 'Dados do usuário atualizados com sucesso!');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        // dd($user);
        
        $admin = User::where('level', 1)->get();
        $users_admin = $admin->count();

        if ($user->level != 1) {
            $user->delete();
            Session::flash('message', 'Usuário excluído com sucesso!');
        } else {
            if($user -> id == 1){
                Session::flash('message2', 'Exclusão não permitida! O administrador geral não pode ser excluído!');
            } else {
                $user->delete();
                Session::flash('message', 'Administrador excluído com sucesso!');
            }

            // if ($users_admin > 1) {
            //     $user->delete();
            //     Session::flash('message', 'Administrrador excluído com sucesso!');
            // } else {
            //     Session::flash('message2', 'Exclusão não permitida! Este é o único administrador do sistema');
            // }
        }
        
        return redirect()->route('users.index');
    }

}
