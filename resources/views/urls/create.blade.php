@extends('layouts.app')

@section('title', 'Cadastrar URL')

@section('content')


<div class="row mt-3 mb-3">

    <div class="col-md-2"></div>
    <div class="col-md-8">

        <div class="row">
                <div class="col-sm-1 col-md-1">
                    <div class="text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('urls.index') }}" title="Lista de url's"><i class="fas fa-list-ol" style="font-size:22px"></i></a>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 text-center">
                <strong>*</strong> Campos de preenchimento obrigatório</span>
                </div>
                <div class="col-sm-1 col-md-1">
                </div>
        </div>    

        <br />

        @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible ml-2 mr-2 mt-2" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p style="font-weight: 600">Erros no preenchimento do formulário:</p>
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 class="text-center titulo_painel">Cadastro de URL</h3>

                <br />

                <form action="{{route('urls.store')}}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf

                    <label for="url">* URL (Request): </label><br />
                    <input type="text" name="url" class="form-control" placeholder="Digite a URL"
                        value="{{old('url')}}"><br />

                    <br />

                    <label for="description">* Descrição da URL: </label><br />
                    <input type="description" name="description" class="form-control" placeholder="Descrição"
                        value="{{old('description')}}"><br />

                    <div class="float-right mb-3">
                        <button class="btn btn-dark" type="submit">Cadastrar</button>
                    </div>

                </form>

    </div>
    <div class="col-md-2"></div>
</div>


@endsection