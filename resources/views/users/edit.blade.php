@extends('layouts.app')

@section('title', 'Atualização de dados do usuário')

@section('content')

<div class="row mt-3 mb-3">
    <div class="col-md-2"></div>
    <div class="col-md-8 ml-2 mr-2">

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

            <div class="mt-3">
                <a class="btn btn-dark btn-sm" href="javascript:window.history.go(-1)" title="Voltar"><i
                        class="fas fa-arrow-left"></i></a>
                <span class="float-right"><strong>*</strong> Campos de preenchimento obrigatório</span>
            </div>

            <br />

            <h3 style="display:block; clear: both;" class="titulo_painel mt-2 mb-3">Atualização - usuário</h3>

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
                <small class="text-danger">Para não alterar a senha, não digite nada neste campo e no seguinte</small><br /><br />

                <label for="password_confirm">Confirmar senha: </label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirme a senha">

                <br />


                <div class="float-right mb-3">
                    <button class="btn btn-primary" type="submit">Gravar</button>
                </div>

            </form>

    </div>
    <div class="col-md-2"></div>
</div>

@endsection
