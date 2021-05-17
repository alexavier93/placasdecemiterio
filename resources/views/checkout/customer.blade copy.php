@extends('layouts.app')

@section('title', '- Dados do Comprador')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Dados do Comprador</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="{{ route('checkout.index') }}">Checkout</a> <span>/</span> Dados</h5>
            </div>

            <div class="customer">

                <div class="row">

                    <div class="col-md-8 col-sm-12">
    
                        <div class="card">
    
                            <div class="card-body">

                                @include('flash::message')
    
                                <h5 class="card-title">Solicitamos apenas as informações essenciais para a realização da compra.</h5>
    
                                <form action="{{ route('checkout.createCustomer') }}" method="POST">
                                    @csrf

                                    <h4 class="mb-3">Dados Pessoais</h4>
    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="firstname" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Sobrenome</label>
                                            <input type="text" class="form-control" name="lastname" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>CPF</label>
                                            <input type="text" class="form-control cpf" name="cpf" required>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Telefone</label>
                                            <input type="text" class="form-control telefone" name="phone" required>
                                        </div>
                                    </div>
    
                                    <h4 class="mb-3">Endereço</h4>
    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>CEP</label>
                                            <input type="text" id="cepConsulta" class="form-control cep" name="cep" placeholder="Digite um CEP" required>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Rua / Avenida</label>
                                            <input type="text" class="form-control" name="logradouro" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Número</label>
                                            <input type="text" class="form-control" name="numero" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Complemento</label>
                                            <input type="text" class="form-control" name="complemento" required>
                                        </div>

                                        
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label>Bairro</label>
                                            <input type="text" class="form-control" name="bairro" required>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" name="cidade" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>UF</label>
                                            <input type="text" class="form-control" name="uf" required>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn btn-primary">Salvar Informações</button>
    
                                </form>
    
                            </div>
    
                        </div>
    
                    </div>
    
                    <div class="col-md-4 col-sm-12 mt-4 mt-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Resumo Do Pedido</h5>
    
                                @foreach ($produtos as $produto)

                                    @foreach ($placas as $placa)

                                        @if ($placa->id == $produto['size'])
                                            
                                        <div class="d-flex justify-content-between my-4">
                                            <div>
                                                <h6 class="my-0"> {{ $placa->title }} </h6>

                                                <small class="text-muted">
                                                    @foreach ($modelos as $modelo)
                                                        @if ($modelo->id == $produto['model'])
                                                            Modelo: {{ $modelo->title }}, 
                                                        @endif
                                                    @endforeach

                                                    @foreach ($molduras as $moldura)
                                                        @if ($moldura->id == $produto['design'])
                                                            Moldura: {{ $moldura->title }}
                                                        @endif
                                                    @endforeach
                                                    
                                                </small>

                                            </div>
                                            <span class="text-muted">R$ {{ number_format($produto['price'], 2, ',', ' ') }}</span>
                                        </div>

                                        @endif

                                    @endforeach

                                @endforeach

                                <hr class="my-3">
                                
                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <?php
                                        $price = 0;
                                        foreach ($produtos as $key => $value){
                                            $price += $value['price'];
                                        }
                                    ?>
                                    <strong>R$ <span class="">{{ number_format($price, 2, ',', '') }}</span></strong>
                                </div>
    
                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection
