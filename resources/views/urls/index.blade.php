@extends('layouts.app')

@section('title', 'Urls')

@section('content')

<div >

    <div class="row">
        <div class="col-sm-1 col-md-1">
            <div class="text-center py-1">
                <a class="btn btn-primary bt-sm" href="{{route('urls.create')}}" title="Nova url"><i class="fas fa-plus"></i></a>
            </div>
            </div>
        <div class="col-sm-10 col-md-10 text-center">
            @if(auth()->user()->level == 1)
            <a class="btn btn-danger bt-sm" href="{{route('urls.truncate')}}" title="Exclui todas as URLs"><i class="fas fa-triangle-exclamation"></i></a>
            @endif
        </div>
        <div class="col-sm-1 col-md-1">
            <div class="text-center py-1">
                <a class="btn btn-dark bt-sm bt_update_all_requests" href="{{route('update.all')}}" title="Atualizar requisições"><i class="fa-solid fa-arrow-rotate-right"></i></a>
            </div>  
        </div>
    </div>    

        <h3 class="text-center titulo_painel pb-2">URL's (Requests)</h3>

        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible mt-3 text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                {!! Session::get('message') !!}
            </div>
        @endif

        <div>
            <p style="font-weight:bold; font-style:italic;" class="text-center text-danger msg_user"></p>
        </div>  

        @if($total_urls==0)
            <h4 class="text-center">Nenhuma URL cadastrada!</h4>
        @else

        <table class="table table-striped">
        <thead>
            <th class="text-center">Id</th>
            <th class="text-left">Url (Request)</th>
            <th width="20%" class="text-left">Descrição</th>
            <!-- <th>Response</th> -->
            <th class="text-center">Status code</th>
            <th class="text-center">Data de consulta</th>
            <th width="20%" class="text-center">Ações</th>
        </thead>
        <tbody>
            
            @foreach($urls as $url)
                <tr>
                    <td class="text-center">{{$url -> id}}</td>
                    <td class="text-left"><a href="{{$url -> url}}" target="_blank">{{$url -> url}}</a></td>
                    <td width="10%" class="left">{{$url -> description}}</td>
                    <!-- <td class="text-left"><pre>{{$url -> response}}</pre></td> -->
                    <td class="text-center">{{$url -> status_code}}</td>

                    @php
                        $data_consulta=date_create($url -> consultation_date);
                    @endphp

                    <td class="text-center">{{date_format($data_consulta,"d/m/Y H:i:s")}}</td>

                    <td class="text-center">
                    <a class="btn btn-success m-1"
                        href="{{ route('urls.show', ['id' => $url->id]) }}" title="Exibir detalhes"><i
                            class="fas fa-book-reader" style="font-size:14px"></i></a>


                    <a class="btn btn-dark m-1 bt_update_one_request"
                        href="{{ route('update.one', ['id' => $url->id]) }}" title="Atualizar requisição"><i class="fa-solid fa-arrow-rotate-right"></i></a>


                    <a class="btn btn-warning m-1"
                        href="{{ route('urls.edit', ['id' => $url->id]) }}" title="Editar URL"><i
                            class="fas fa-edit" style="font-size:14px"></i></a>

                    @if((auth()->user()->level == 1) || (auth()->user()->level == 2))
                    <form style="display:inline;" action="{{ route('urls.destroy', ['id' => $url->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-1 mr-1" onclick="return confirm('Tem certeza que deseja excluir esta URL?')"  title="Excluir URL"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    @endif
                </td>

                </tr>
                @endforeach
        @endif
        </tbody>
    </table>

    @if($urls != null)
        @if(isset($filters))
            {{-- {{ $urls->appends($filters)->links() }} --}}
        @else
            {{$urls -> render()}}
        @endif
    @endif

 </div>

@endsection