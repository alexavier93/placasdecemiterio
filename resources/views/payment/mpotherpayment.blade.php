@extends('layouts.app')

@section('title', '- Pagamento')

@section('content')

    <div id="payment">

        <div class="container">

            <div class="page-title-content">
                <h1>Pagamento via Mercado Pago</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="{{ route('checkout.shipment') }}">Envio</a> <span>/</span> Pagamento</h5>
            </div>

            <div class="mercadopago">

                <div class="row">

                    <div class="col-md-12">
                        @include('flash::message')

                        <div class="alert alert-warning" role="alert" style="display: none;"></div>
                    </div>

                    <div class="col-md-7 col-sm-12">

                        <div class="card mb-3">
                            <div class="card-header">Selecione uma forma de pagamento</div>

                            <div class="card-body">
                                <div class="payments-type">
                                    <div class="list-group">
                                        <a href="{{ route('payment.mercadopago') }}" class="list-group-item list-group-item-action" aria-current="true">
                                            Cartão de Crédito
                                        </a>
                                        <a href="{{ route('payment.otherpayments') }}" class="list-group-item list-group-item-action active">Boleto / Pix</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-header">Dados do Pagamento</div>

                            <div class="card-body">

                                <div class="payments-form">

                                    <form action="{{ route('payment.createOrder') }}" method="post" id="boletoPayment">
                                        @csrf
                                    
                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                                                    <option value="">Selecione uma forma de pagamento</option>
                                                    <option value="bolbradesco">Boleto</option>
                                                    <option value="pix">Pix</option>
                                                </select>
                                            </div>
                                    
                                            <div class="col-lg-4 mb-3">
                                                <label for="docType">Tipo de documento</label>
                                                <select class="form-control" name="identificationType" id="docType"></select>
                                            </div>
                                    
                                            <div class="col-lg-8 mb-3">
                                                <label>Número do documento</label>
                                                <input class="form-control" type="text" name="identificationNumber" id="identificationNumber" />
                                            </div>
                                    
                                        </div>
                                    
                                        <input type="hidden" name="MPHiddenInputAmount" id="transactionAmount" value="{{ $pedido_total }}" />
                                    
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Confirmar a compra</button>
                                        </div>
                                        
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-5 col-sm-12 mt-4 mt-md-0">

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

                                <div class="d-flex justify-content-between my-2">
                                    <span>Frete: {{ $frete['tipo'] }}</span>
                                    <strong>R$ {{ number_format($frete['valor'], 2, ',', '') }}</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>R$ {{ number_format($pedido_total, 2, ',', '') }}</strong>
                                    <input type="hidden" id="valorTotal" value="{{ number_format($pedido_total, 2) }}">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


        </div>

    </div>

@endsection
