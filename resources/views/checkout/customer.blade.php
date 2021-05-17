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

                    <div class="col-md-4 col-sm-12">

                        <div class="card costumer">

                            <div class="card-header">Dados Pessoais</div>

                            <div class="card-body">

                                <p class="card-text">Solicitamos apenas as informações essenciais para a realização da compra.</p>

                                @include('flash::message')

                                <form id="formCostumer" action="{{ route('checkout.createCustomer') }}" method="POST">

                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="firstname" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Sobrenome</label>
                                        <input type="text" class="form-control" name="lastname" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">CPF</label>
                                        <input type="text" class="form-control cpf" name="cpf" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Data de Nascimento</label>
                                        <input type="text" class="form-control data" name="birthdate" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Telefone</label>
                                        <input type="text" class="form-control telefone" name="phone" required>
                                    </div>

                                    <button type="submit" class="btn btn-light btn-block">Salvar Informações</button>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header">Endereço</div>
                            <div class="card-body">
                                <p>Aguardando o preenchimento dos dados pessoais</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-4 col-sm-12 mt-4 mt-md-0">
                        <div class="card">

                            <div class="card-header">Resumo Do Pedido</div>

                            <div class="card-body">
    
                                @foreach ($produtos as $produto)

                                    @foreach ($placas as $placa)

                                        @if ($placa->id == $produto['size'])
                                            
                                        <div class="d-flex justify-content-between my-3">
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
