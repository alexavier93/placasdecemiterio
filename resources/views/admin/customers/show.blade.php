@extends('admin.layouts.app')

@section('title', '- Clientes')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informações</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-xl-6 col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Cliente</span>
                </div>

                <div class="card-body p-5">

                        <p class="text-muted"><b>Nome:</b> {{ $customer->firstname.' '.$customer->lastname}}</p>

                        <p class="text-muted"><b>CPF:</b> <span class="cpf">{{ $customer->cpf }}</span></p>

                        <p class="text-muted"><b>Email:</b> {{ $customer->email ? $customer->email : null }}</p>

                        <p class="text-muted"><b>Telefone:</b> {{ $customer->phone }}</p>

                </div>

            </div>

        </div>

        <div class="col-xl-6 col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Endereço</span>
                </div>

                <div class="card-body p-5">

                    <p class="text-muted"><b>Rua/Avenida:</b> @if (isset($address)) {{ $address->logradouro }} @endif</p>

                    <p class="text-muted"><b>Número:</b> @if (isset($address)) {{ $address->numero }} @endif</p>

                    <p class="text-muted"><b>Bairro:</b> @if (isset($address)) {{ $address->bairro }} @endif</p>

                    <p class="text-muted"><b>Cidade:</b> @if (isset($address)) {{ $address->cidade }} @endif</p>

                    <p class="text-muted"><b>UF:</b> @if (isset($address)) {{ $address->uf }} @endif</p>

                </div>


            </div>

        </div>

    </div>

@endsection



