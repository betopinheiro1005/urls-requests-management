@extends('layouts.app')

@section('title', 'Atualização de dados do usuário')

@section('content')

<div class="row mt-3 mb-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <form action="{{route('users.update', ['user' => $user->id])}}" method="POST" class="form-group">

            @csrf
            @method('PUT')


            @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible ml-2 mr-2 mt-2" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p style="font-weight: bold">Erros no preenchimento do formulário:</p>
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h2 style="background-color:#F5F5DC; padding:10px; display:block; border:1px solid #ccc; clear: both;"
                class="titulo_painel mt-2 mb-3">Atualização - usuário</h2>

            <div class="mt-3">
                <a class="btn btn-dark btn-sm" href="javascript:window.history.go(-1)" title="Voltar"><i
                        class="fas fa-arrow-left"></i></a>
                <span class="float-right"><strong>*</strong> Campos de preenchimento obrigatório</span>
            </div>

            <br />

            <form action="{{route('users.store')}}" method="POST" class="form-group">

                @csrf

                <label for="name">* Nome: </label><br />
                <input type="text" name="name" class="form-control" placeholder="Digite o nome" value="{{$user->name}}">
                <small>Mínimo de 4 e máximo de 70 caracteres</small><br /><br />

                <label for="email">* Email: </label><br />
                <input type="text" name="email" class="form-control" placeholder="Digite o email"
                    value="{{$user->email}}"><br />

                <label for="password">Senha: </label>
                <input type="password" name="password" class="form-control"
                    placeholder="Apenas letras e números (mínimo 6, máximo 20) - Não iniciar por número">
                <small class="text-danger">Para não alterar a senha, basta não digitar nada neste campo e no
                    seguinte</small><br /><br />

                <label for="password_confirm">Confirmar senha: </label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirme a senha">

                <br />

                <!-- @if($users->count()<=1)
                    
                @else
                    <label for="level">Perfil:</label><br />
                    <select name="level" class="form-control">
                        @foreach($levels as $level)
                            @if($level == 0)
                                @if($user_level == 0)
                                    <option value="0" selected>Visitante</option>
                                @else
                                    <option value="0">Visitante</option>
                                @endif
                            @elseif($level == 1)
                                @if($user_level == 1)
                                    <option value="1" selected>Administrador Geral</option>
                                @else
                                    <option value="1">Administrador Geral</option>
                                @endif
                            @elseif($level == 2)
                                @if($user_level == 2)
                                    <option value="2" selected>Administrador</option>
                                @else
                                    <option value="2">Administrador</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                @endif -->
                
                <br />

                <div class="float-right mb-3">
                    <button class="btn btn-primary" type="submit">Gravar</button>
                </div>

            </form>

    </div>
    <div class="col-md-2"></div>
</div>

@endsection
