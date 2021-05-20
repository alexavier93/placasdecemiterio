@extends('layouts.app')

@section('title', '- Pedido Realizado')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Pedido Finalizado</h1>
                <h3>SEU PEDIDO FOI REALIZADO COM SUCESSO</h3>
                <p>Seu pedido é: <b class="h4">{{ $order->code }}</b></p>
            </div>

            <div class="col-md-12 text-center mb-4">
                <div class="info-payment">

                    @isset($paymentCreditCard)
                    <p>Forma de Pagamento: <br>Cartão de Crédito</p>
                    <p>Valor: {{ $paymentCreditCard->installments }}x R$ {{ number_format($paymentCreditCard->installment_amount, 2, ',', '') }}</p>

                    @endisset

                    @isset($paymentBoleto)

                    <p>Forma de Pagamento: Boleto</p>
                    <p>Valor: R$ {{ number_format($paymentBoleto->total_paid_amount, 2, ',', '') }}</p>
                    <p><b><a href="{{ $paymentBoleto->external_resource_url }}" target="_blank" download>Clique aqui para baixar o PDF</a></b></p>

                    @endisset

                    @isset($paymentPix)

                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <p>Forma de Pagamento: Pix</p>
                                <p>Valor: R$ {{ number_format($paymentPix->total_paid_amount, 2, ',', '') }}</p>
                                <p>
                                    Para fazer o pagamento basta escanear o QR Code, o código é válido por apenas por 24h. Para fazer o download do QR Code é só clicar na imagem.<br>
                                    <a href="data:image/jpeg;base64,{{ $paymentPix->qr_code_base64 }}" download="Pix_Pedido_{{ $order->code }}"><img style="width: 200px" src="data:image/jpeg;base64,{{ $paymentPix->qr_code_base64 }}" /></a>
                                </p>
                            </div>
                        </div>
                            
                    @endisset

                </div>

                <p>Você receberá uma cópia com detalhes do seu pedido por e-mail.</p>
            </div>

            <div class="shipment">

                <div class="row">

                    <div class="col-md-12">
                        @include('flash::message')
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
