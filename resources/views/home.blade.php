@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h4>Dashboard - URL's Requests Management</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                            <div class="col-sm-2 col-md-2">
                                <div class="text-center">
                                    <a class="btn btn-dark btn-sm" href="{{ route('urls.index') }}" title="Listagem de URL's"><i class="fas fa-list-ol" style="font-size:22px"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-8 text-center text-success">
                                <h5>You are logged in!</h5>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <div class="text-center">
                                    <a class="btn btn-dark bt-sm" href="{{route('urls.create')}}" title="Nova URL"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                    </div>    

                    <br />

                    <div class="row">
                        <div class="col-sm-1 col-md-1"></div>
                        <div class="col-sm-10 col-md-10 text-center">
                            <img src="{{asset('images/http.jpg')}}" width="100%" alt="Gerenciamento de URL's">
                        </div>
                        <div class="col-1 col-md-1"></div>
                    </div>
                    
<!--                     <div class="text-center">
                        <i class="fas fa-door-open" style="font-size:36px;"></i>
                    </div>
 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection