@extends('layouts.app')

@section('title', '- Checkout')

@section('content')

    <div id="checkout">

        <div class="page-title-content">
            <h1>Confira mais uma vez</h1>
            <h5><a href="">Home</a> <span>/</span> <a href="{{ route('placas.index') }}">Placas</a> <span>/</span>
                Checkout</h5>
        </div>

        <div class="container">

            @include('flash::message')

            <table class="table d-none d-lg-block d-xl-block">
                <thead>
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data</th>
                        <th scope="col">Frase</th>
                        <th scope="col">Sub-total</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)

                        <tr>
                            <td style="width: 13%">
                                @foreach ($placas as $placa)

                                    @if ($placa->id == $produto['size'])

                                        <p>{{ $placa->title }}</p>

                                        <small class="text-muted">
                                            @foreach ($modelos as $modelo)
                                                @if ($modelo->id == $produto['model'])
                                                    Modelo: <br>{{ $modelo->title }}
                                                @endif
                                            @endforeach
                                            <br>
                                            @foreach ($molduras as $moldura)
                                                @if ($moldura->id == $produto['design'])
                                                    Moldura: <br>{{ $moldura->title }}
                                                @endif
                                            @endforeach

                                        </small>

                                    @endif

                                @endforeach
                            </td>
                            <td>
                                <img class="w-100" src="{{ asset('storage/' . $produto['image_crop']) }}" alt="">
                            </td>


                            <td style="width: 15%">{{ $produto['name'] }}</td>
                            <td>{{ $produto['birthdate'] }}<br>
                                {{ $produto['deathdate'] }}
                            </td>
                            <td class="w-25">{{ $produto['phrase'] }}</td>
                            <td style="width: 15%"><span class="text-muted">R$
                                    {{ number_format($produto['price'], 2, ',', ' ') }}</span></td>
                            <td><a href="{{ route('checkout.removePlaca', ['id' => $produto['id']]) }}"
                                    class="btn btn-light"><i class="fas fa-trash"></i></a></td>
                        </tr>

                    @endforeach

                </tbody>
            </table>


            <div class="card d-block d-lg-none d-xl-none">
                <div class="card-body">
                    <h5 class="card-title">Resumo Do Pedido</h5>

                    @foreach ($produtos as $produto)

                        @foreach ($placas as $placa)

                            @if ($placa->id == $produto['size'])

                                <div class="d-flex justify-content-between my-4">
                                    <div class="d-flex align-items-center">

                                        <div class="w-25 text-center">
                                            <img class="w-75" src="{{ asset('storage/' . $produto['image_crop']) }}"
                                                alt="">
                                            <a href="{{ route('checkout.removePlaca', ['id' => $produto['id']]) }}"
                                                class="btn btn-outline-secondary btn-sm mt-2">Excluir</a>
                                        </div>

                                        <div class="w-50">
                                            <div class="cart-title text-left ml-2">

                                                <h6 class="my-0"> {{ $placa->title }} </h6>

                                                <small class="text-muted">
                                                    @foreach ($modelos as $modelo)
                                                        @if ($modelo->id == $produto['model'])
                                                            Modelo: {{ $modelo->title }},
                                                        @endif
                                                    @endforeach
                                                    <br>
                                                    @foreach ($molduras as $moldura)
                                                        @if ($moldura->id == $produto['design'])
                                                            Moldura: {{ $moldura->title }}
                                                        @endif
                                                    @endforeach

                                                </small>


                                            </div>
                                        </div>

                                        <div class="w-25 text-right">
                                            <span class="text-muted">R$
                                                {{ number_format($produto['price'], 2, ',', ' ') }}</span>
                                        </div>
                                    </div>

                                </div>

                            @endif

                        @endforeach

                    @endforeach

                    <hr class="my-3">

                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <?php
                        $price = 0;
                        foreach ($produtos as $key => $value) {
                        $price += $value['price'];
                        }
                        ?>
                        <strong>R$ <span class="">{{ number_format($price, 2, ',', '') }}</span></strong>
                    </div>

                </div>

            </div>

            <div class="text-center py-3">
                <a href="{{ route('placas.index') }}" class="btn btn-default btn-finalizar">Criar Outra Placa</a>
                <a href="{{ route('checkout.auth') }}" class="btn btn-default btn-finalizar">Finalizar Pedido</a>
            </div>

        </div>

    </div>

@endsection
