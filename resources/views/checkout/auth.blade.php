@extends('layouts.app')

@section('title', '- Dados do Comprador')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Finalizar compra</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="{{ route('checkout.index') }}">Checkout</a> <span>/</span> Autenticação</h5>
            </div>

            <div class="customer">

                <div class="row">

                    <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-sm-12">
    
                        <div class="card">
    
                            <div class="card-body">

                                @include('flash::message')
    
                                <p class="card-title text-center mb-3">Em apenas um passo, conclua sua compra em nossa loja.<br>É RÁPIDO E SEGURO.</p>
    
                                <form id="formLogin" action="{{ route('checkout.doAuth') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-light btn-lg btn-block">Continuar</button>
    
                                </form>
    
                            </div>
    
                        </div>
    
                    </div>
    
     
                </div>
    

            </div>


        </div>

    </div>

@endsection
