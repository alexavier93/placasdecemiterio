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
                    </div>

                    <div class="col-md-7 col-sm-12">

                        <div class="card">

                            <div class="card-body">

                                <form action="{{ route('payment.createOrder') }}" method="post" id="paymentForm">
                                    @csrf

                                    <div class="row">
						
                                        <div class="col-md-7 mb-3">
                                            <label for="cardNumber">Número do cartão</label>
                                            <input class="form-control" type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                                        </div>
                                        
                                        <div class="col-md-5 mb-3">
                                            <label for="">Data de vencimento</label>
                                            <div class="form-row px-1">
                                                <input class="form-control col-md-5 col-xs-5" type="text" placeholder="01" id="cardExpirationMonth" maxlength ="2" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                                                <span class="date-separator mx-3 my-2"> / </span>
                                                <input class="form-control col-md-5 col-xs-5" type="text" placeholder="20" id="cardExpirationYear" maxlength ="2" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                                            </div>
                                        </div>
            
                                        <div class="col-md-7 mb-3">
                                            <label for="cardholderName">Titular do cartão</label>
                                            <input id="cardholderName" class="form-control" data-checkout="cardholderName" type="text">
                                        </div>
                                        
                                        <div class="col-md-5 mb-3">
                                            <label for="securityCode">Código de segurança</label>
                                            <input class="form-control" id="securityCode" data-checkout="securityCode" type="text" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off>
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="docType">Tipo de documento</label>
                                            <select id="docType" class="form-control" name="docType" data-checkout="docType" type="text"></select>
                                        </div>
            
                                        <div class="col-md-5 mb-3">
                                            <label for="docNumber">Número do documento</label>
                                            <input id="docNumber" class="form-control" name="docNumber" data-checkout="docNumber" type="text" />
                                        </div>
            
                                        <div id="issuerInput" class="col-md-4 mb-3 d-none">
                                            <label for="issuer">Banco emissor</label>
                                            <select class="form-control" id="issuer" name="issuer" data-checkout="issuer"></select>
                                        </div>
            
                                        <div class="col-md-4 mb-3">
                                            <label for="installments">Parcelas</label>
                                            <select class="form-control" type="text" id="installments" name="installments"></select>
                                        </div>
            
                                        <div class="col-md-4 mb-3">
                                            <input type="hidden" name="transactionAmount" id="transactionAmount" value="{{ $pedido_total }}" />
                                            <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                                            <input type="hidden" name="description" id="description" />
                                        </div>
                                    
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Confirmar a compra</button>

                                  </form>

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
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


        </div>

    </div>

@endsection
