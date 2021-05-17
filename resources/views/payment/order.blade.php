@extends('layouts.app')

@section('title', '- Pedido Realizado')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Pedido Confirmado</h1>
                <h5><a href="{{ route('home') }}">Home</a> <span>/</span> Detalhes do Pedido</h5>
            </div>

            <div class="shipment">

                <div class="row">

                    <div class="col-md-12">
                        @include('flash::message')
                    </div>

                    <div class="col-md-12">
                        <h3>Pedido <small class="text-muted"><b>{{ $order->code }}</b></small></h3>
                    </div>

                    <div class="col-md-5 col-sm-12">
    
                        <div class="card customers-info">
    
                            <div class="card-body">

                                <h5 class="card-title">Dados Pessoais</h5>
    
                                <p class="text-muted">
                                    <b>{{ $customer->firstname.' '.$customer->lastname }}</b><br>
                                    <span class="cpf">{{ $customer->cpf }}</span><br>
                                    {{ $customer->phone }}
                                </p>

                            </div>
    
                        </div>

                        <div class="card customers-info mt-3">
    
                            <div class="card-body">

                                <h5 class="card-title">Endereço de Entrega</h5>
                                
                                <p class="text-muted">{{ $customer->firstname.' '.$customer->lastname }}</p>

                                <p class="text-muted">{{ $address->logradouro.', '.$address->numero.' - '.$address->complemento}}<br>
                                {{ $address->bairro.' - '. $address->cidade .' - '. $address->uf }}</p>

                            </div>
    
                        </div>
    
                    </div>
                
                    <div class="col-md-7 col-sm-12 mt-4 mt-md-0">

                        <div class="card">
                            
                            <div class="card-body">

                                <h5 class="card-title">Resumo Do Pedido - <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small></h5>

                                @foreach ($produtos as $produto)

                                    @foreach ($placas as $placa)

                                        @if ($placa->id == $produto->placa_id)
                                            
                                        <div class="d-flex justify-content-between my-4">

                                            <div>

                                                <h6 class="my-0"> {{ $placa->title }} </h6>

                                                <small class="text-muted">
                                                    @foreach ($modelos as $modelo)
                                                        @if ($modelo->id == $produto->modelo_id)
                                                            Modelo: {{ $modelo->title }}, 
                                                        @endif
                                                    @endforeach

                                                    @foreach ($molduras as $moldura)
                                                        @if ($moldura->id == $produto->moldura_id)
                                                            Moldura: {{ $moldura->title }}
                                                        @endif
                                                    @endforeach
                                                    
                                                </small>

                                            </div>

                                            <span class="text-muted">R$ {{ number_format($produto->price, 2, ',', ' ') }}</span>

                                        </div>

                                        @endif

                                    @endforeach

                                @endforeach

                                <hr class="my-3">

                                <div class="d-flex justify-content-between my-2">
                                    
                                </div>

                                <div class="d-flex justify-content-between my-2">
                                    <span>Frete: {{ $envio->tipo .', '. $envio->prazo.' dias' }}</span>
                                    <strong>R$ {{ number_format($envio->valor, 2, ',', '') }}</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>R$ {{ number_format($order->total, 2, ',', '') }}</strong>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
    

            </div>


        </div>

    </div>

@endsection
