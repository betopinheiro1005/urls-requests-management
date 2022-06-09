@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')

<div class="row">

    <div class="col-md-3"></div>
    <div class="col-md-6 mt-3 mb-3">

        @if(Session::has('erro_permission'))
        <div class="alert alert-danger alert-dismissible mt-3 text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            {{Session::get('erro_permission')}}
        </div>
        @endif

        <div class="m-3">
            <a class="btn btn-dark btn-sm" href="javascript:window.history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left"></i></a>
            
        </div>

        <h3 style="background-color:#E8E8E8; padding:10px; display:block; clear: both;"
            class="titulo_painel text-center m-3">{{$user->name}}</h3>

        <p class="m-3"><strong>Id:</strong> {{$user->id}}</p>

        <p class="m-3"><strong>Nome:</strong> {{$user->name}}</p>

        <p class="m-3"><strong>Email:</strong> {{$user->email}}</p>

            <div class="m-3">
                <strong>Data de cadastro:</strong> {{ date('d/m/Y H:i', strtotime($user->created_at)) }}
            </div>

            @if($user->updated_at != $user->created_at)
                <div class="m-3">
                <strong>Data de atualização:</strong> {{ date('d/m/Y H:i', strtotime($user->updated_at)) }}
                </div>
            @endif

    </div>
    <div class="col-md-3"></div>

</div>

@endsection
