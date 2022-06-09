@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

<div class="container">

    <div class="row mt-3 mb-3">
        <div class="col-sm-2 col-md-4">
            @if (auth()->user()->email == "robertopinheiro7843@gmail.com" || auth()->user()->email == "administrador@gmail.com")
            <a class="btn btn-primary" title="Cadastrar" href="{{route('users.create')}}"><i
                    class="fas fa-user-plus"></i></a>
            @else        
                <a class="btn btn-dark btn-sm" href="javascript:window.history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left"></i></a>
            @endif
        </div>
        <div class="col-sm-5 col-md-4">
            <h3 style="display:block; clear: both;" class="titulo_painel text-center"> Users</h3>
        </div>
        <div class="col-sm-5 col-md-4">
            <p style="display:inline" class="float-right mt-2 mb-3">Total users: {{$total_users}}</p>
        </div>
    </div>

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible mt-3 text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            {{Session::get('message')}}
        </div>
    @endif

    @if(Session::has('message2'))
        <div class="alert alert-danger alert-dismissible mt-3 text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            {{Session::get('message2')}}
        </div>
    @endif

    @if(Session::has('erro_permission'))
        <div class="alert alert-danger alert-dismissible mt-3 text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            {{Session::get('erro_permission')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <th>Nome</th>
            <th>Email</th>
            <th class="text-center">Ações</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                {{-- <td>{{$user->id}}</td> --}}
                <td class="align-middle">{{$user->name}}</td>
                <td class="align-middle">{{$user->email}}</td>
                <td class="text-center align-middle" colspan="4">
                    <a class="btn btn-success mt-1" title="Detalhes"
                        href="{{ route('users.show', ['user' => $user->id]) }}"><i class="fas fa-user-check"></i></a>

                    @if (auth()->user()->email == "robertopinheiro7843@gmail.com" || auth()->user()->email == "administrador@gmail.com")
                    <a class="btn btn-warning mt-1" title="Atualizar"
                        href="{{ route('users.edit', ['user' => $user->id]) }}"><i class="fas fa-user-edit"></i></a>

                        @if($users->count()==1)
                            <!-- <h4 class="text-center">Você não pode excluir esse usuário!</h4> -->
                        @else
                            <form style="display:inline;" action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger mt-1" title="Excluir"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?')"><i
                                    class="fas fa-user-minus"></i></button>
                            </form>
                        @endif

                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($users!=null)
    {{$users->render()}}
    @endif

</div>

@endsection