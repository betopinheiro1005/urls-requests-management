
@extends('layouts.app')

@section('title', 'Detalhes da Url')

@section('content')

    @php
        $id = $busca->id;
        $url = $busca->url;
        $description = $busca->description;

        $response = $busca->response;

        $status_code = $busca->status_code;

        if($status_code == '200'){
            $message1 = 'SUCCESS';
            $message2 = "OK";
        } else if($status_code == '301'){
            $message1 = 'REDIRECTION';
            $message2 = "Moved Permanently";
        } else if($status_code == '400') {
            $message1 = "ERROR";
            $message2 = "Bad request";
        } else if($status_code == '406') {
            $message1 = "ERROR";
            $message2 = "Not Acceptable";
        } else if($status_code == '404') {
            $message1 = "ERROR";
            $message2 = "Not Found";
        }    
        
        $consultation_date = $busca->consultation_date;
    @endphp

    <div class="container">

            <div class="row">
                <div class="col-sm-2 col-md-2">
                    <a style="float:left" class="btn btn-info btn-sm" href="{{ route('urls.index') }}" title="Lista de URL's"><i class="fas fa-list-ol" style="font-size:22px"></i></a>
                </div>
                <div class="col-sm-8 col-md-8">
                    <h3 class="text-center titulo_painel" style="display:block;">Detalhes da Requisição</h3>
                </div>
                <div class="col-sm-2 col-md-2">
                    <a style="float:right" class="btn btn-primary bt-sm" href="{{route('urls.create')}}" title="Nova URL"><i class="fas fa-plus"></i></a>
                </div>
            </div>

            <br />    

            <table class="table table-striped"> 
                <!-- <tr>
                    <td colspan="2"><h5 class="card-subtitle text-muted text-center">Informações gerais</h5></td> 
                </tr> -->
                <tr>
                    <td class="text-right" style="font-weight:bold">Id:</td>
                    <td class="text-left">{{ $id }}</td>
                </tr>    
                <tr>
                    <td class="text-right" style="font-weight:bold">URL (Request):</td>
                    <td class="text-left"> {{ $url }}</td>
                </tr>    
                <tr>
                    <td class="text-right" style="font-weight:bold">Descrição:</td>
                    <td class="text-left">{{ $description }}</td>
                </tr>
                @if($response != null)
                <tr>
                    <td class="text-right" style="font-weight:bold">Response:</td>
                    <td class="text-left"><pre>{{ print_r(json_decode($response)) }}</pre></td>
                </tr>
                @endif
                <tr>
                    <td class="text-right" style="font-weight:bold">Status Code:</td>
                    <td class="text-left">{{ $status_code }} (<span style="font-weight:bold">{{ $message1 }}</span>: {{ $message2 }})</td>
                </tr>
                <tr>
                    <td class="text-right" style="font-weight:bold">Data da consulta:</td>
                    <td class="text-left">{{ $consultation_date }}</td>
                </tr>    
            </table>
    </div>

@endsection

