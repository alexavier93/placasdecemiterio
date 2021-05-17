@extends('layouts.app')

@section('title', '- Meus Dados')

@section('content')

    <div id="checkout">

        <div class="container">

            <div class="page-title-content">
                <h1>Meus Dados</h1>
                <h5><a href="">Home</a> <span>/</span> <a href="{{ route('checkout.index') }}">Checkout</a> <span>/</span>Meus dados</h5>
            </div>

            <div class="customer">

                <div class="row">

                    <div class="col-md-12 col-sm-12">
    
                        <div class="card">
    
                            <div class="card-body">

                                @include('flash::message')

                                <form action="{{ route('checkout.updateCustomer', ['id' => $customer->id]) }}" method="POST">
                                    @csrf
                                    @method("PUT")

                                    <h4 class="mb-3">Dados Pessoais</h4>
    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Sobrenome</label>
                                            <input type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Data de Nascimento</label>
                                            <input type="text" class="form-control data" name="birthdate" value="{{ $customer->birthdate }}" required>
                                        </div>
                                        
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>CPF</label>
                                            <input type="text" class="form-control cpf" name="cpf" value="{{ $customer->cpf }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Telefone</label>
                                            <input type="text" class="form-control telefone" name="phone" value="{{ $customer->phone }}" required>
                                        </div>
                                    </div>

                                    <hr>

                                    <h4 class="mb-3">Endereço</h4>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>CEP</label>
                                            <input type="text" id="cepConsulta" class="form-control cep" name="cep" value="{{ $address == true ? $address->cep : '' }}" placeholder="Digite um CEP" required>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Rua / Avenida</label>
                                            <input type="text" class="form-control" name="logradouro" value="{{ $address == true ? $address->logradouro : '' }}" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Número</label>
                                            <input type="text" class="form-control" name="numero" value="{{ $address == true ? $address->numero : '' }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Complemento</label>
                                            <input type="text" class="form-control" name="complemento" value="{{ $address == true ? $address->complemento : '' }}" required>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label>Bairro</label>
                                            <input type="text" class="form-control" name="bairro" value="{{ $address == true ? $address->bairro : '' }}" required>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" name="cidade" value="{{ $address == true ? $address->cidade : '' }}" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>UF</label>
                                            <input type="text" class="form-control" name="uf" value="{{ $address == true ? $address->uf : '' }}" required>
                                        </div>
                                    </div>
    
                                    <hr>
    
                                    <button type="submit" class="btn btn-primary">Salvar Informações</button>

                                    <a class="btn btn-outline-secondary" href="{{ route('checkout.shipment') }}">Voltar</a>
    
                                </form>
    
                            </div>
    
                        </div>
    
                    </div>

                </div>
    
            </div>

        </div>

    </div>

@endsection
