@extends('layouts.app')

@section('title', '- Pagamento')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Pagamento</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="">Checkout</a> <span>/</span> Pagamento</h5>
            </div>

            <div class="payment">

                <div class="row">

                    <div class="col-md-12">
                        @include('flash::message')
                    </div>

                    <div class="col-md-7 col-sm-12">

                        <div class="card">



                        </div>

                        <button type="submit" form="formFrete" class="btn btn-primary float-right mt-3">Fazer
                            Pagamento</button>

                    </div>

                    <div class="col-md-5 col-sm-12 mt-4 mt-md-0">

                        <div class="card">

                            <div class="card-body">

                                <h5 class="card-title">Resumo Do Pedido</h5>

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="my-0">{{ $placa->title }}</h6>
                                        <small class="text-muted">Modelo: {{ $modelo->title }}, Moldura:
                                            {{ $moldura->title }}</small>
                                    </div>
                                    <span class="text-muted">R$ {{ number_format($placa->price, 2, ',', ' ') }}</span>
                                </div>

                                <hr class="my-3">

                                <div class="d-flex justify-content-between my-2">
                                    <span>Frete</span>
                                    <strong>R$ 20</strong>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>R$ 50</strong>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


        </div>

    </div>

@endsection
