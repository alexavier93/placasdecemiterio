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

                @include('flash::message')

                <div class="row">

                    

                    <div class="col-md-4 col-sm-12">

                        <div class="card costumer">

                            <div class="card-header">Dados Pessoais <span class="float-right"><a href="{{ route('checkout.logout') }}">sair</a></span></div>

                            <div class="card-body">
                                <p>{{ $customer->email }}</p>
                                <p>{{ $customer->firstname .' '.$customer->lastname }}</p>
                                <p>{{ $customer->phone }}</p>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header">Endereço</div>

                            <div class="card-body">

                                <form id="formAddress" action="{{ route('checkout.createAddress') }}" method="POST">

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">CEP</label>
                                            <input type="text" id="cepConsulta" class="form-control cep" name="cep"
                                                placeholder="Digite um CEP">
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Logradouro (Ex. Rua, Aveninda)</label>
                                            <input type="text" class="form-control" name="logradouro" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Número</label>
                                            <input type="text" class="form-control" name="numero" required>
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Complemento</label>
                                            <input type="text" class="form-control" name="complemento">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Bairro</label>
                                            <input type="text" class="form-control" name="bairro" required>
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Cidade</label>
                                            <input type="text" class="form-control" name="cidade" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">UF</label>
                                            <input type="text" class="form-control" name="uf" required>
                                        </div>
                                    </div>
            

                                    <button type="submit" class="btn btn-light btn-block">Salvar endereço</button>

                                </form>

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
