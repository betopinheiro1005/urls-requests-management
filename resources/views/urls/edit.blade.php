@extends('layouts.app')

@section('title', 'Alterar URL')

@section('content')


<div class="row mt-3 mb-3">

    <div class="col-md-3"></div>
    <div class="col-md-6">

        <div class="row">
                <div class="col-sm-1 col-md-1">
                    <div class="text-center">
                        <a class="btn btn-dark btn-sm" href="{{ route('urls.index') }}" title="Lista de url's"><i class="fas fa-book-reader"></i></a>
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

            <h3 class="text-center titulo_painel">Alteração da descrição da URL</h3>

                <br />

                <form action="{{ route('urls.update', $url->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="url">* URL: </label><br />
                    <input type="url" name="url" class="form-control" placeholder="Digite a URL"
                        value="{{$url->url}}"><br />

                    <br />

                    <label for="description">Descrição da URL: </label><br />
                    <input type="description" name="description" class="form-control" placeholder="Descrição"
                    value="{{$url->description}}"><br />

                    <div class="float-right mb-3">
                        <button class="btn btn-dark" type="submit">Alterar</button>
                    </div>

                </form>

    </div>
    <div class="col-md-3"></div>
</div>


@endsection