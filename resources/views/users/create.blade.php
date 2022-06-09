@extends('layouts.app')

@section('title', 'Cadastro de usuários')

@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 mr-2 ml-2">

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

        <h3 style="display:block; clear: both;" class="titulo_painel mt-2 mb-3">Cadastro de usuário</h3>

        <form action="{{route('users.store')}}" method="POST" class="form-group">

            @csrf

            <label for="name">* Nome: </label><br />
            <input type="text" name="name" class="form-control" placeholder="Digite o nome" value="{{old('name')}}">
            <small>Mínimo de 4 e máximo de 70 caracteres</small><br /><br />

            <label for="email">* Email: </label><br />
            <input type="text" name="email" class="form-control" placeholder="Digite o email"
                value="{{old('email')}}"><br />

            <label for="password">* Senha: </label>
            <input type="password" name="password" class="form-control" placeholder="Digite a senha">
            <small>A senha não deve conter caracteres especiais, não pode iniciar por números e deve ter entre 6 e 20
                caracteres</small><br /><br />

            <label for="password_confirm">* Confirmar senha: </label>
            <input type="password" name="password_confirm" class="form-control" placeholder="Confirme a senha">
            <small>A senha não deve conter caracteres especiais, não pode iniciar por números e deve ter entre 6 e 20
                caracteres</small><br /><br />

            <!-- <label for="level">Perfil:</label><br />
            <select name="level" class="form-control">
                @foreach($levels as $level)
                @if($level == 2)
                <option value="{{$level}}" selected>Visitante</option>
                @elseif($level == 1)
                <option value="{{$level}}">Administrador</option>
                @endif
                @endforeach
            </select><br /> -->

            <div class="float-right mb-3">
                <button class="btn btn-primary" type="submit">Gravar</button>
                <button class="btn btn-danger" type="reset">Limpar</button>
            </div>

        </form>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection
