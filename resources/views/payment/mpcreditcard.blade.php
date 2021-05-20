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
                                        <a href="{{ route('payment.mercadopago') }}" class="list-group-item list-group-item-action active" aria-current="true">
                                            Cartão de Crédito
                                        </a>
                                        <a href="{{ route('payment.otherpayments') }}" class="list-group-item list-group-item-action">Boleto / Pix</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-header">Dados do Pagamento</div>

                            <div class="card-body">

                                <input type="text" value="5031 4332 1540 6351 - 123 - 11/25" class="w-100">

                                <hr class="my-4">
                                
                                <div class="payments-form">

                                    <form id="form-checkout" action="{{ route('payment.createOrder') }}" method="post">
                                        @csrf
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-7 mb-3">
                                                <label for="cardNumber">Número do cartão</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control number" name="cardNumber" id="form-checkout__cardNumber" maxlength="16" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <img src="{{ asset('assets/images/credit-card.svg') }}" style="width: 32px;">
                                                        </span> 
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-5 mb-3">
                                                <label>Data de vencimento</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control number" name="cardExpirationMonth" id="form-checkout__cardExpirationMonth" maxlength="2">
                                                    <input type="text" class="form-control number" name="cardExpirationYear" id="form-checkout__cardExpirationYear" maxlength="2">
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-7 mb-3">
                                                <label for="cardholderName">Titular do cartão</label>
                                                <input class="form-control" type="text" name="cardholderName" id="form-checkout__cardholderName" />
                                            </div>
                                    
                                            <div class="col-md-5 mb-3">
                                                <label for="securityCode">Código de segurança</label>
                                                <input class="form-control number" type="text" name="securityCode" id="form-checkout__securityCode" maxlength="3"/>
                                            </div>
                                    
                                            <div class="col-md-4 mb-3">
                                                <label for="form-checkout__identificationType">Tipo de documento</label>
                                                <select class="form-control" name="identificationType" id="form-checkout__identificationType"></select>
                                            </div>
                                    
                                            <div class="col-md-4 mb-3">
                                                <label>Número do documento</label>
                                                <input class="form-control" type="text" name="identificationNumber" id="form-checkout__identificationNumber" maxlength="14" />
                                            </div>
                                    
                                            <div class="col-md-4 mb-3">
                                                <label for="installments">Parcelas</label>
                                                <select class="form-control" name="installments" id="form-checkout__installments"></select>
                                            </div>
                                    
                                            <select class="d-none" name="issuer" id="form-checkout__issuer"></select>
                                    
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" id="form-checkout__submit" class="btn btn-primary">Confirmar a compra</button>
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
