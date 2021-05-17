@extends('layouts.app')

@section('title', '- Formas de Envio')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Formas de Envio</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="{{ route('checkout.index') }}">Checkout</a> <span>/</span> Envio</h5>
            </div>

            <div class="shipment">

                <div class="row">

                    <div class="col-md-12">
                        @include('flash::message')
                    </div>

                    <div class="col-md-7 col-sm-12">
    
                        <div class="card customers-info">
    
                            <div class="card-body">
                                <h5 class="card-title">Dados Pessoais <small class="float-right"><a href="{{ route('checkout.edit') }}">alterar dados</a> | <a href="{{ route('checkout.logout') }}">sair</a></small></h5>
    
                                <div class="row">

                                    <div class="col-md-6 mb-2"><span class="text-muted"><b>Nome:</b> {{ $customer->firstname.' '.$customer->lastname}}</span></div>

                                    <div class="col-md-6 mb-2"><span class="text-muted"><b>CPF:</b> <span class="cpf">{{ $customer->cpf }}</span></span></div>

                                    <div class="col-md-6 mb-2"><span class="text-muted"><b>Email:</b> {{ $customer->email }}</span></div>

                                    <div class="col-md-6 mb-2"><span class="text-muted"><b>Telefone:</b> {{ $customer->phone }}</span></div>

                                </div>
    
                                <hr class="my-3">
    
                                <h5 class="card-title">Endereço <small class="float-right"><a href="{{ route('checkout.edit') }}">alterar endereço</a></small></h5>
    
                                <div class="row">

                                    <div class="col-md-12 mb-2"><span class="text-muted"><b>Rua/Avenida:</b> {{ $address->logradouro }}</span></div>

                                    <div class="col-md-4 mb-2"><span class="text-muted"><b>Número:</b> {{ $address->numero }}</span></div>

                                    <div class="col-md-8 mb-2"><span class="text-muted"><b>Complemento:</b> {{ $address->numero }}</span></div>

                                    <div class="col-md-5 mb-2"><span class="text-muted"><b>Bairro:</b> {{ $address->bairro }}</span></div>

                                    <div class="col-md-5 mb-2"><span class="text-muted"><b>Cidade:</b> {{ $address->cidade }}</span></div>

                                    <div class="col-md-2 mb-2"><span class="text-muted"><b>UF:</b> {{ $address->uf }}</span></div>

                                </div>
    
                            </div>
    
                        </div>

                        <div class="card shipment mt-3">
    
                            <div class="card-body">

                                @error('frete')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Por favor, selecione uma forma de envio.

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror

                                <div class="row">
                                    <div class="col-5">Forma de Envio</div>
                                    <div class="col-3">Prazo</div>
                                    <div class="col-3">Valor</div>
                                </div>

                                <form id="formFrete" action="{{ route('checkout.frete') }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="valorTotal" value="">

                                    <div class="row mt-3 align-items-center">
                                        <div class="col-5">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="local" class="frete mr-3" name="frete" value="Retirada no Local, 10, 0.00">
                                                <label class="form-check-label" for="local" role="button">Retirar no Local</label>
                                            </div>
                                        </div>
                                        <div class="col-3">10 dias</div>
                                        <div class="col-3">Grátis</div>
                                    </div>

                                    @foreach ($envio as $key)

                                        <div class="row mt-3 align-items-center">
                                            <div class="col-5">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="{{$key['tipo'] }}" class="frete mr-3" name="frete" value="{{ $key['tipo'] }}, {{ $key['prazo'] }}, {{ $key['valor'] }}">
                                                    <label class="form-check-label" for="{{ $key['tipo'] }}" role="button">
                                                        <img src="{{ asset('assets/images/'.$key['tipo'].'.jpg') }}" class="w-50">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-3">{{ ($key['prazo'] + 5) }} dias</div>
                                            <div class="col-3">R$ {{ number_format($key['valor'], 2, ',', ' ') }}</div>
                                        </div>

                                    @endforeach

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
                                    <span>Frete</span>
                                    <strong>R$ <span class="valorFrete">0,00</span></strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>R$ <span class="valorTotal">0,00</span></strong>
                                </div>

                            </div>

                        </div>

                        <button type="submit" form="formFrete" class="btn btn-primary float-right mt-3">Fazer Pagamento</button>

                    </div>

                </div>
    

            </div>


        </div>

    </div>

@endsection
