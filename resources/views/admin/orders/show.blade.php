@extends('admin.layouts.app')

@section('title', '- Pedidos')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Pedido #{{ $order->code }}</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedido #{{ $order->code }}</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-sm-12 col-lg-4 col-xl-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Detalhe do Cliente</span>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-user"></i>
                            {{ $customer->firstname . ' ' . $customer->lastname }}
                        </li>
                        <li class="list-group-item"><i class="fas fa-id-card"></i> {{ $customer->cpf }}</li>
                        <li class="list-group-item"><i class="fas fa-phone-alt"></i> {{ $customer->phone }}</li>
                        <li class="list-group-item"><i class="fas fa-envelope"></i> {{ $customer->email }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col-sm-12 col-lg-4 col-xl-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Detalhe do Pedido</span>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-calendar"></i>
                            {{ $order->created_at->format('d/m/Y') }}
                        </li>
                        <li class="list-group-item"><i class="fas fa-shipping-fast"></i>
                            {{ $envio->tipo . ', ' . $envio->prazo . ' dias' }}
                        </li>
                        <li class="list-group-item"><i class="fas fa-credit-card"></i> Método do pagamento</li>
                    </ul>

                </div>
            </div>
        </div>



        <!-- Content Column -->
        <div class="col-sm-12 col-lg-4 col-xl-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Endereço</span>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-user"></i>
                            {{ $customer->firstname . ' ' . $customer->lastname }}
                        </li>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i>
                            {{ $address->logradouro . ', ' . $address->numero . ' - ' .  $address->complemento }}<br>
                            {{ $address->bairro . ' - ' . $address->cidade . ' - ' . $address->uf }}
                        </li>
                    </ul>


                </div>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col-sm-12 col-lg-12 col-xl-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Placas</span>
                </div>
                <div class="card-body">

                    @foreach ($produtos as $produto)

                        @foreach ($placas as $placa)

                            @if ($placa->id == $produto->placa_id)

                                <div class="d-flex justify-content-between my-2">

                                    <div>

                                        <h6 class="my-0"><b>{{ $placa->title }}</b></h6>

                                        <small class="text-muted">
                                            @foreach ($modelos as $modelo)
                                                @if ($modelo->id == $produto->modelo_id)
                                                    <b>Modelo:</b> {{ $modelo->title }}
                                                @endif
                                            @endforeach
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            @foreach ($molduras as $moldura)
                                                @if ($moldura->id == $produto->moldura_id)
                                                    <b>Moldura:</b> {{ $moldura->title }}
                                                @endif
                                            @endforeach
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <b>Nome:</b> {{ $produto->name }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <b>Data de Nascimento:</b> {{ $produto->birthdate }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <b>Data de Falecimento:</b> {{ $produto->deathdate }}
                                        </small>
                                        @if ($produto->phrase != '')
                                            <br>
                                            <small class="text-muted">
                                                <b>Frase:</b> {{ $produto->phrase }}
                                            </small>
                                        @endif
                                        <br>
                                        <small class="text-muted">
                                            <a href="{{ asset('storage/' . $produto->image) }}" download> Imagem Original <i  class="fas fa-download"></i></a><br>
                                            <a href="{{ asset('storage/' . $produto->image_crop) }}" download> Imagem Cortada <i class="fas fa-download"></i></a>
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
                        <span>Frete</span>
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

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="py-3 m-0">Tem certeza que deseja excluir este registro?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    <form action="{{ route('admin.orders.delete') }}" method="post" class="float-right">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
